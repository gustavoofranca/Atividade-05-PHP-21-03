<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="text-center mb-4">
                    <i class="fas fa-hamburger text-danger me-2"></i>
                    Bem-vindo ao Sistema de Gerenciamento Gusta's Burguer
                </h1>
                
                <?php if (!isset($_SESSION['usuario'])): ?>
                    <div class="alert alert-info">
                        <p>Por favor, faça login para acessar o sistema.</p>
                        <a href="<?= BASE_URL ?>?page=login" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt me-2"></i> Login
                        </a>
                    </div>
                <?php else: ?>
                    <div class="row text-center mt-5">
                        <div class="col-md-3 mb-4">
                            <div class="card h-100 border-primary">
                                <div class="card-body">
                                    <i class="fas fa-utensils fa-3x text-primary mb-3"></i>
                                    <h5 class="card-title">Produtos</h5>
                                    <p class="card-text">Gerenciar produtos e categorias</p>
                                    <a href="<?= BASE_URL ?>?page=produtos" class="btn btn-outline-primary">Acessar</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 mb-4">
                            <div class="card h-100 border-success">
                                <div class="card-body">
                                    <i class="fas fa-boxes fa-3x text-success mb-3"></i>
                                    <h5 class="card-title">Estoque</h5>
                                    <p class="card-text">Controlar estoque de produtos</p>
                                    <a href="<?= BASE_URL ?>?page=estoque" class="btn btn-outline-success">Acessar</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 mb-4">
                            <div class="card h-100 border-warning">
                                <div class="card-body">
                                    <i class="fas fa-clipboard-list fa-3x text-warning mb-3"></i>
                                    <h5 class="card-title">Pedidos</h5>
                                    <p class="card-text">Gerenciar pedidos de clientes</p>
                                    <a href="<?= BASE_URL ?>?page=pedidos" class="btn btn-outline-warning">Acessar</a>
                                </div>
                            </div>
                        </div>
                        
                        <?php if ($_SESSION['usuario_tipo'] === 'admin'): ?>
                            <div class="col-md-3 mb-4">
                                <div class="card h-100 border-danger">
                                    <div class="card-body">
                                        <i class="fas fa-users fa-3x text-danger mb-3"></i>
                                        <h5 class="card-title">Usuários</h5>
                                        <p class="card-text">Gerenciar usuários do sistema</p>
                                        <a href="<?= BASE_URL ?>?page=usuarios" class="btn btn-outline-danger">Acessar</a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mt-5">
                        <h4 class="mb-3">Alertas de Estoque</h4>
                        <?php 
                        $estoquesBaixos = Estoque::listarAbaixoDoMinimo();
                        if (!empty($estoquesBaixos)): 
                        ?>
                            <div class="alert alert-warning">
                                <h5><i class="fas fa-exclamation-triangle me-2"></i> Produtos com estoque abaixo do mínimo:</h5>
                                <ul>
                                    <?php foreach ($estoquesBaixos as $estoque): ?>
                                        <li>
                                            <strong><?= $estoque->produto_nome ?></strong>: 
                                            <?= $estoque->getQuantidade() ?> unidades 
                                            (mínimo: <?= $estoque->getQuantidadeMinima() ?>)
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <a href="<?= BASE_URL ?>?page=estoque" class="btn btn-sm btn-warning">Gerenciar Estoque</a>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-2"></i> Todos os produtos estão com estoque adequado.
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>