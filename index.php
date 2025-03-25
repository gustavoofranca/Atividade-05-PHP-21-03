<?php
// Arquivo principal que serve como ponto de entrada para a aplicação
session_start();

// Definir constantes do sistema
define('ROOT_PATH', __DIR__);
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/Projeto');

// Incluir arquivo de configuração
require_once 'config/config.php';

// Sistema de roteamento simples
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Cabeçalho padrão
include 'views/templates/header.php';

// Carregar a página solicitada
try {
    switch ($page) {
        case 'produtos':
            require_once 'controllers/ProdutoController.php';
            $controller = new ProdutoController();
            if (method_exists($controller, $action)) {
                $controller->$action();
            } else {
                throw new Exception('Ação não encontrada');
            }
            break;
        case 'estoque':
            require_once 'controllers/EstoqueController.php';
            $controller = new EstoqueController();
            if (method_exists($controller, $action)) {
                $controller->$action();
            } else {
                throw new Exception('Ação não encontrada');
            }
            break;
        case 'pedidos':
            require_once 'controllers/PedidoController.php';
            $controller = new PedidoController();
            if (method_exists($controller, $action)) {
                $controller->$action();
            } else {
                throw new Exception('Ação não encontrada');
            }
            break;
        case 'usuarios':
            require_once 'controllers/UsuarioController.php';
            $controller = new UsuarioController();
            if (method_exists($controller, $action)) {
                $controller->$action();
            } else {
                throw new Exception('Ação não encontrada');
            }
            break;
        case 'login':
            require_once 'controllers/AuthController.php';
            $controller = new AuthController();
            if (method_exists($controller, $action)) {
                $controller->$action();
            } else {
                throw new Exception('Ação não encontrada');
            }
            break;
        case 'cart':
            require_once 'controllers/CartController.php';
            $controller = new CartController();
            if (method_exists($controller, $action)) {
                $controller->$action();
            } else {
                throw new Exception('Ação não encontrada');
            }
            break;
        case 'cardapio':
            include 'views/cardapio.php';
            break;
        case 'sobre':
            include 'views/sobre.php';
            break;
        case 'home':
            include 'views/home.php';
            break;
        default:
            throw new Exception('Página não encontrada');
    }
} catch (Exception $e) {
    // Exibir mensagem de erro amigável
    echo '<div class="alert alert-danger m-3">';
    echo '<h4 class="alert-heading">Erro!</h4>';
    echo '<p>' . $e->getMessage() . '</p>';
    echo '<hr>';
    echo '<p class="mb-0"><a href="' . BASE_URL . '" class="alert-link">Voltar para a página inicial</a></p>';
    echo '</div>';
}

// Rodapé padrão
include 'views/templates/footer.php';