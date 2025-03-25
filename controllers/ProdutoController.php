<?php
/**
 * Controlador para gerenciar produtos
 */
class ProdutoController {
    /**
     * Exibe a lista de produtos
     */
    public function index() {
        // Verificar se o usuário está logado
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . '?page=login');
            exit;
        }
        
        // Buscar todas as categorias e produtos
        $categorias = Categoria::listarTodas();
        $produtos = Produto::listarTodos();
        
        // Exibir a view
        include 'views/produtos/index.php';
    }
    
    /**
     * Exibe o formulário para adicionar um novo produto
     */
    public function adicionar() {
        // Verificar se o usuário está logado
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . '?page=login');
            exit;
        }
        
        // Buscar todas as categorias para o formulário
        $categorias = Categoria::listarTodas();
        
        // Verificar se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->salvar();
        }
        
        // Exibir a view
        include 'views/produtos/form.php';
    }
    
    /**
     * Exibe o formulário para editar um produto existente
     */
    public function editar() {
        // Verificar se o usuário está logado
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . '?page=login');
            exit;
        }
        
        // Verificar se o ID foi informado
        if (!isset($_GET['id'])) {
            header('Location: ' . BASE_URL . '?page=produtos');
            exit;
        }
        
        // Buscar o produto pelo ID
        $id = (int) $_GET['id'];
        $produto = Produto::buscarPorId($id);
        
        if (!$produto) {
            header('Location: ' . BASE_URL . '?page=produtos');
            exit;
        }
        
        // Buscar todas as categorias para o formulário
        $categorias = Categoria::listarTodas();
        
        // Verificar se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->salvar();
        }
        
        // Exibir a view
        include 'views/produtos/form.php';
    }
    
    /**
     * Salva os dados do produto no banco de dados
     */
    private function salvar() {
        // Obter os dados do formulário
        $id = isset($_POST['id']) ? (int) $_POST['id'] : null;
        $categoria_id = (int) $_POST['categoria_id'];
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
        $preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $disponivel = isset($_POST['disponivel']) ? 1 : 0;
        
        // Validar os dados
        if (empty($nome) || empty($categoria_id) || empty($preco)) {
            $erro = 'Por favor, preencha todos os campos obrigatórios.';
            return;
        }
        
        // Processar upload de imagem, se houver
        $imagem = null;
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $imagem = $this->processarUploadImagem($_FILES['imagem']);
        } elseif ($id) {
            // Manter a imagem atual se estiver editando
            $produtoAtual = Produto::buscarPorId($id);
            $imagem = $produtoAtual->getImagem();
        }
        
        // Criar ou atualizar o produto
        $produto = new Produto($id, $categoria_id, $nome, $descricao, $preco, $imagem, $disponivel);
        $produto->salvar();
        
        // Redirecionar para a lista de produtos
        header('Location: ' . BASE_URL . '?page=produtos');
        exit;
    }
    
    /**
     * Processa o upload de uma imagem
     */
    private function processarUploadImagem($arquivo) {
        $diretorio = ROOT_PATH . '/assets/img/produtos/';
        
        // Criar o diretório se não existir
        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0755, true);
        }
        
        // Gerar um nome único para o arquivo
        $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
        $nome_arquivo = uniqid('produto_') . '.' . $extensao;
        $caminho_completo = $diretorio . $nome_arquivo;
        
        // Mover o arquivo para o diretório de destino
        if (move_uploaded_file($arquivo['tmp_name'], $caminho_completo)) {
            return 'assets/img/produtos/' . $nome_arquivo;
        }
        
        return null;
    }
    
    /**
     * Exclui um produto
     */
    public function excluir() {
        // Verificar se o usuário está logado
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . '?page=login');
            exit;
        }
        
        // Verificar se o ID foi informado
        if (!isset($_GET['id'])) {
            header('Location: ' . BASE_URL . '?page=produtos');
            exit;
        }
        
        // Excluir o produto
        $id = (int) $_GET['id'];
        Produto::excluir($id);
        
        // Redirecionar para a lista de produtos
        header('Location: ' . BASE_URL . '?page=produtos');
        exit;
    }
}