<?php
/**
 * Controlador para gerenciar o estoque de produtos
 */
class EstoqueController {
    /**
     * Exibe a lista de produtos no estoque
     */
    public function index() {
        // Verificar se o usuário está logado
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . '?page=login');
            exit;
        }
        
        // Buscar todos os produtos no estoque com informações do produto
        $estoques = Estoque::listarTodos();
        
        // Exibir a view
        include 'views/estoque/index.php';
    }
    
    /**
     * Exibe o formulário para atualizar o estoque de um produto
     */
    public function atualizar() {
        // Verificar se o usuário está logado
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . '?page=login');
            exit;
        }
        
        // Verificar se o ID do produto foi fornecido
        if (!isset($_GET['id'])) {
            header('Location: ' . BASE_URL . '?page=estoque');
            exit;
        }
        
        $produto_id = (int)$_GET['id'];
        
        // Buscar o produto e seu estoque
        $produto = Produto::buscarPorId($produto_id);
        $estoque = Estoque::buscarPorProdutoId($produto_id);
        
        if (!$produto || !$estoque) {
            header('Location: ' . BASE_URL . '?page=estoque');
            exit;
        }
        
        // Verificar se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processarAtualizacao($estoque);
        }
        
        // Exibir a view
        include 'views/estoque/form.php';
    }
    
    /**
     * Processa a atualização do estoque
     */
    private function processarAtualizacao($estoque) {
        $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT);
        $quantidade_minima = filter_input(INPUT_POST, 'quantidade_minima', FILTER_VALIDATE_INT);
        $operacao = filter_input(INPUT_POST, 'operacao', FILTER_SANITIZE_STRING);
        
        if ($quantidade === false || $quantidade_minima === false) {
            $erro = 'Por favor, informe valores válidos para as quantidades.';
            return;
        }
        
        // Atualizar a quantidade mínima
        $estoque->setQuantidadeMinima($quantidade_minima);
        
        // Realizar a operação de estoque
        $sucesso = false;
        switch ($operacao) {
            case 'definir':
                if ($quantidade >= 0) {
                    $estoque->setQuantidade($quantidade);
                    $sucesso = $estoque->salvar();
                } else {
                    $erro = 'A quantidade não pode ser negativa.';
                }
                break;
                
            case 'adicionar':
                if ($quantidade > 0) {
                    $sucesso = $estoque->adicionarQuantidade($quantidade);
                } else {
                    $erro = 'A quantidade a adicionar deve ser maior que zero.';
                }
                break;
                
            case 'remover':
                if ($quantidade > 0) {
                    $sucesso = $estoque->removerQuantidade($quantidade);
                    if (!$sucesso) {
                        $erro = 'Não há quantidade suficiente em estoque para remover.';
                    }
                } else {
                    $erro = 'A quantidade a remover deve ser maior que zero.';
                }
                break;
                
            default:
                $erro = 'Operação inválida.';
                break;
        }
        
        if ($sucesso) {
            $sucesso = 'Estoque atualizado com sucesso!';
            header('Location: ' . BASE_URL . '?page=estoque&sucesso=' . urlencode($sucesso));
            exit;
        }
    }
}