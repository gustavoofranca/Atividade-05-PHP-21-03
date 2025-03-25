<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="fas fa-utensils me-2"></i> Produtos</h4>
        <a href="<?= BASE_URL ?>?page=produtos&action=adicionar" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Novo Produto
        </a>
    </div>
    <div class="card-body">
        <?php if (isset($erro)): ?>
            <div class="alert alert-danger"><?= $erro ?></div>
        <?php endif; ?>
        
        <?php if (isset($sucesso)): ?>
            <div class="alert alert-success"><?= $sucesso ?></div>
        <?php endif; ?>
        
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Preço</th>
                        <th>Disponível</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($produtos)): ?>
                        <tr>
                            <td colspan="7" class="text-center">Nenhum produto cadastrado.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($produtos as $produto): ?>
                            <tr>
                                <td><?= $produto->getId() ?></td>
                                <td>
                                    <?php if ($produto->getImagem()): ?>
                                        <img src="<?= BASE_URL ?>/<?= $produto->getImagem() ?>" alt="<?= $produto->getNome() ?>" class="produto-img" width="50">
                                    <?php else: ?>
                                        <span class="text-muted">Sem imagem</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= $produto->getNome() ?></td>
                                <td><?= $produto->categoria_nome ?></td>
                                <td><?= $produto->getPrecoFormatado() ?></td>
                                <td>
                                    <?php if ($produto->getDisponivel()): ?>
                                        <span class="badge bg-success">Sim</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Não</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= BASE_URL ?>?page=produtos&action=editar&id=<?= $produto->getId() ?>" class="btn btn-sm btn-primary btn-action" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" onclick="return confirmarExclusao('Deseja realmente excluir este produto?', '<?= BASE_URL ?>?page=produtos&action=excluir&id=<?= $produto->getId() ?>')" class="btn btn-sm btn-danger btn-action" title="Excluir">
                                        <i class="fas fa-trash"></i>
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