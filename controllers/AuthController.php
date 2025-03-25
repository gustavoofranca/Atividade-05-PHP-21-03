<?php
/**
 * Controlador para gerenciar autenticação de usuários
 */
class AuthController {
    /**
     * Exibe o formulário de login
     */
    public function loginForm() {
        // Se já estiver logado, redireciona para a página inicial
        if (isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL);
            exit;
        }
        
        // Verifica se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processLogin();
        }
        
        // Exibe o formulário de login
        include 'views/login.php';
    }
    
    /**
     * Processa o login do usuário
     */
    private function processLogin() {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
        
        if (empty($email) || empty($senha)) {
            $erro = 'Por favor, preencha todos os campos.';
            return;
        }
        
        $usuario = Usuario::autenticar($email, $senha);
        
        if ($usuario) {
            // Login bem-sucedido
            $_SESSION['usuario'] = $usuario->getId();
            $_SESSION['usuario_nome'] = $usuario->getNome();
            $_SESSION['usuario_tipo'] = $usuario->getTipo();
            
            header('Location: ' . BASE_URL);
            exit;
        } else {
            // Login falhou
            $erro = 'Email ou senha inválidos.';
        }
    }
    
    /**
     * Realiza o logout do usuário
     */
    public function logout() {
        // Limpa as variáveis de sessão
        unset($_SESSION['usuario']);
        unset($_SESSION['usuario_nome']);
        unset($_SESSION['usuario_tipo']);
        
        // Redireciona para a página de login
        header('Location: ' . BASE_URL . '?page=login');
        exit;
    }
}