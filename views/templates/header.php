<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gusta's Burguer - Sistema de Gerenciamento</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/modern-style.css">
    <!-- Angular Theme Styles -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/angular-theme.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/modern-style-angular.css">
    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap JS e Cart JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Make BASE_URL available to JavaScript
        const BASE_URL = '<?= BASE_URL ?>';
    </script>
    <script src="<?= BASE_URL ?>/assets/js/cart.js"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg sticky-top">
            <div class="container">
                <a class="navbar-brand" href="<?= BASE_URL ?>">
                    <i class="fas fa-hamburger me-2"></i>
                    Gusta's Burguer
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link <?= !isset($_GET['page']) ? 'active' : '' ?>" href="<?= BASE_URL ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] == 'cardapio' ? 'active' : '' ?>" href="<?= BASE_URL ?>?page=cardapio">Cardápio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] == 'pedidos' ? 'active' : '' ?>" href="<?= BASE_URL ?>?page=pedidos">Pedidos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] == 'sobre' ? 'active' : '' ?>" href="<?= BASE_URL ?>?page=sobre">Saiba Mais</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link position-relative" href="#" data-bs-toggle="modal" data-bs-target="#cartModal">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="badge bg-danger cart-count">0</span>
                            </a>
                        </li>
                        <?php if (isset($_SESSION['usuario'])): ?>
                            <li class="nav-item">
                                <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] == 'produtos' ? 'active' : '' ?>" href="<?= BASE_URL ?>?page=produtos">Produtos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] == 'estoque' ? 'active' : '' ?>" href="<?= BASE_URL ?>?page=estoque">Estoque</a>
                            </li>
                            <?php if ($_SESSION['usuario_tipo'] === 'admin'): ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] == 'usuarios' ? 'active' : '' ?>" href="<?= BASE_URL ?>?page=usuarios">Usuários</a>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL ?>?page=logout">
                                    <i class="fas fa-sign-out-alt"></i> Sair
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] == 'login' ? 'active' : '' ?>" href="<?= BASE_URL ?>?page=login">
                                    <i class="fas fa-sign-in-alt"></i> Login
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    
    <main class="container py-4">