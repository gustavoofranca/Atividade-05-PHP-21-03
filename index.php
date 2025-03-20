<?php
require_once 'classes/Estoque.php';

// Initialize or load the stock
session_start();

if (!isset($_SESSION['estoque'])) {
    $_SESSION['estoque'] = new Estoque();
}

$estoque = $_SESSION['estoque'];
$mensagem = '';
$erro = '';

// Process form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add product
    if (isset($_POST['adicionar'])) {
        $nome = trim($_POST['nome']);
        $preco = floatval($_POST['preco']);
        $quantidade = intval($_POST['quantidade']);
        $categoria = trim($_POST['categoria']);
        
        if (!empty($nome) && $preco > 0 && $quantidade >= 0) {
            $produto = new Produto($nome, $preco, $quantidade, $categoria);
            $estoque->adicionarProduto($produto);
            $mensagem = "Produto '$nome' adicionado com sucesso!";
        } else {
            $erro = 'Por favor, preencha todos os campos corretamente.';
        }
    }
    
    // Remove product
    if (isset($_POST['remover']) && isset($_POST['index'])) {
        $index = intval($_POST['index']);
        if ($estoque->removerProduto($index)) {
            $mensagem = 'Produto removido com sucesso!';
        } else {
            $erro = 'Não foi possível remover o produto.';
        }
    }
    
    // Apply discount
    if (isset($_POST['aplicar_desconto']) && isset($_POST['index']) && isset($_POST['desconto'])) {
        $index = intval($_POST['index']);
        $desconto = floatval($_POST['desconto']);
        $produtos = $estoque->listarProdutos();
        
        if (isset($produtos[$index]) && $desconto > 0 && $desconto <= 100) {
            $produtos[$index]->aplicarDesconto($desconto);
            $mensagem = "Desconto de {$desconto}% aplicado com sucesso!";
        } else {
            $erro = 'Não foi possível aplicar o desconto.';
        }
    }
    
    // Update quantity
    if (isset($_POST['atualizar_quantidade']) && isset($_POST['index']) && isset($_POST['nova_quantidade'])) {
        $index = intval($_POST['index']);
        $novaQuantidade = intval($_POST['nova_quantidade']);
        $produtos = $estoque->listarProdutos();
        
        if (isset($produtos[$index]) && $novaQuantidade >= 0) {
            $produtos[$index]->atualizarQuantidade($novaQuantidade);
            $mensagem = "Quantidade atualizada com sucesso!";
        } else {
            $erro = 'Não foi possível atualizar a quantidade.';
        }
    }
    
    // Save the updated stock back to the session
    $_SESSION['estoque'] = $estoque;
}

// Get filter parameters
$categoriaFiltro = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$produtos = $categoriaFiltro ? $estoque->listarProdutosPorCategoria($categoriaFiltro) : $estoque->listarProdutos();

// Get unique categories for the filter dropdown
$categorias = [];
foreach ($estoque->listarProdutos() as $produto) {
    $categorias[$produto->getCategoria()] = true;
}
$categorias = array_keys($categorias);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão de Produtos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Sistema de Gestão de Produtos</h1>
            <p>Valor Total do Estoque: R$ <?= number_format($estoque->calcularValorTotal(), 2, ',', '.') ?></p>
            <p>Total de Produtos: <?= $estoque->contarProdutos() ?></p>
        </header>
        
        <?php if (!empty($mensagem)): ?>
            <div class="mensagem sucesso"><?= $mensagem ?></div>
        <?php endif; ?>
        
        <?php if (!empty($erro)): ?>
            <div class="mensagem erro"><?= $erro ?></div>
        <?php endif; ?>
        
        <div class="content">
            <section class="form-section">
                <h2>Adicionar Novo Produto</h2>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="preco">Preço (R$):</label>
                        <input type="number" id="preco" name="preco" step="0.01" min="0" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="quantidade">Quantidade:</label>
                        <input type="number" id="quantidade" name="quantidade" min="0" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="categoria">Categoria:</label>
                        <input type="text" id="categoria" name="categoria" value="Geral">
                    </div>
                    
                    <button type="submit" name="adicionar" class="btn">Adicionar Produto</button>
                </form>
            </section>
            
            <section class="produtos-section">
                <h2>Produtos em Estoque</h2>
                
                <div class="filtro">
                    <form method="get" action="">
                        <label for="categoria-filtro">Filtrar por Categoria:</label>
                        <select id="categoria-filtro" name="categoria" onchange="this.form.submit()">
                            <option value="">Todas as Categorias</option>
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= $categoria ?>" <?= $categoriaFiltro === $categoria ? 'selected' : '' ?>>
                                    <?= $categoria ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                </div>
                
                <?php if (empty($produtos)): ?>
                    <p class="no-products">Nenhum produto encontrado.</p>
                <?php else: ?>
                    <div class="produtos-grid">
                        <?php foreach ($produtos as $index => $produto): ?>
                            <?php $info = $produto->exibirInformacoes(); ?>
                            <div class="produto-card">
                                <h3><?= $info['nome'] ?></h3>
                                <p><strong>Preço:</strong> R$ <?= number_format($info['preco'], 2, ',', '.') ?></p>
                                <p><strong>Quantidade:</strong> <?= $info['quantidade'] ?></p>
                                <p><strong>Categoria:</strong> <?= $info['categoria'] ?></p>
                                <p><strong>Valor Total:</strong> R$ <?= number_format($info['preco'] * $info['quantidade'], 2, ',', '.') ?></p>
                                
                                <div class="produto-acoes">
                                    <button class="btn-small" onclick="toggleForm('desconto-form-<?= $index ?>')">Aplicar Desconto</button>
                                    <button class="btn-small" onclick="toggleForm('quantidade-form-<?= $index ?>')">Atualizar Quantidade</button>
                                    
                                    <form method="post" action="" class="inline-form">
                                        <input type="hidden" name="index" value="<?= $index ?>">
                                        <button type="submit" name="remover" class="btn-small danger">Remover</button>
                                    </form>
                                </div>
                                
                                <form id="desconto-form-<?= $index ?>" method="post" action="" class="hidden-form">
                                    <input type="hidden" name="index" value="<?= $index ?>">
                                    <div class="form-group">
                                        <label for="desconto-<?= $index ?>">Desconto (%):</label>
                                        <input type="number" id="desconto-<?= $index ?>" name="desconto" min="1" max="100" required>
                                    </div>
                                    <button type="submit" name="aplicar_desconto" class="btn-small">Aplicar</button>
                                </form>
                                
                                <form id="quantidade-form-<?= $index ?>" method="post" action="" class="hidden-form">
                                    <input type="hidden" name="index" value="<?= $index ?>">
                                    <div class="form-group">
                                        <label for="nova-quantidade-<?= $index ?>">Nova Quantidade:</label>
                                        <input type="number" id="nova-quantidade-<?= $index ?>" name="nova_quantidade" min="0" required>
                                    </div>
                                    <button type="submit" name="atualizar_quantidade" class="btn-small">Atualizar</button>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </section>
        </div>
    </div>
    
    <script>
        function toggleForm(formId) {
            const form = document.getElementById(formId);
            if (form.classList.contains('hidden-form')) {
                // Hide all other forms first
                document.querySelectorAll('.hidden-form').forEach(f => {
                    if (f.id !== formId) {
                        f.classList.add('hidden-form');
                    }
                });
                form.classList.remove('hidden-form');
            } else {
                form.classList.add('hidden-form');
            }
        }
    </script>
</body>
</html>