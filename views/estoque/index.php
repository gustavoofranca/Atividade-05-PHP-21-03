<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="fas fa-boxes me-2"></i> Gerenciamento de Estoque</h4>
    </div>
    <div class="card-body">
        <?php if (isset($_GET['sucesso'])): ?>
            <div class="alert alert-success"><?= $_GET['sucesso'] ?></div>
        <?php endif; ?>
        
        <?php if (isset($erro)): ?>
            <div class="alert alert-danger"><?= $erro ?></div>
        <?php endif; ?>
        
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Quantidade Mínima</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($estoques)): ?>
                        <tr>
                            <td colspan="6" class="text-center">Nenhum produto no estoque.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($estoques as $estoque): ?>
                            <tr>
                                <td><?= $estoque->getId() ?></td>
                                <td><?= $estoque->produto_nome ?></td>
                                <td><?= $estoque->getQuantidade() ?></td>
                                <td><?= $estoque->getQuantidadeMinima() ?></td>
                                <td>
                                    <?php if ($estoque->estaAbaixoDoMinimo()): ?>
                                        <span class="badge bg-danger">Abaixo do mínimo</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">Normal</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= BASE_URL ?>?page=estoque&action=atualizar&id=<?= $estoque->getProdutoId() ?>" class="btn btn-sm btn-primary btn-action" title="Atualizar Estoque">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>