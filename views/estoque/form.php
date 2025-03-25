<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="fas fa-boxes me-2"></i> Atualizar Estoque</h4>
        <a href="<?= BASE_URL ?>?page=estoque" class="btn btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Voltar
        </a>
    </div>
    <div class="card-body">
        <?php if (isset($erro)): ?>
            <div class="alert alert-danger"><?= $erro ?></div>
        <?php endif; ?>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Informações do Produto</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Nome:</strong> <?= $produto->getNome() ?></p>
                        <p><strong>Descrição:</strong> <?= $produto->getDescricao() ?></p>
                        <p><strong>Preço:</strong> <?= $produto->getPrecoFormatado() ?></p>
                        <p><strong>Quantidade Atual:</strong> <span class="badge bg-primary"><?= $estoque->getQuantidade() ?></span></p>
                        <p><strong>Quantidade Mínima:</strong> <span class="badge bg-secondary"><?= $estoque->getQuantidadeMinima() ?></span></p>
                        <p>
                            <strong>Status:</strong>
                            <?php if ($estoque->estaAbaixoDoMinimo()): ?>
                                <span class="badge bg-danger">Abaixo do mínimo</span>
                            <?php else: ?>
                                <span class="badge bg-success">Normal</span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Atualizar Estoque</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?= BASE_URL ?>?page=estoque&action=atualizar&id=<?= $produto->getId() ?>">
                            <div class="mb-3">
                                <label for="quantidade_minima" class="form-label">Quantidade Mínima:</label>
                                <input type="number" class="form-control" id="quantidade_minima" name="quantidade_minima" value="<?= $estoque->getQuantidadeMinima() ?>" min="0" required>
                                <div class="form-text">Quantidade mínima para alertas de estoque baixo.</div>
                            </div>

                            <div class="mb-3">
                                <label for="operacao" class="form-label">Operação:</label>
                                <select class="form-select" id="operacao" name="operacao" required>
                                    <option value="definir">Definir quantidade exata</option>
                                    <option value="adicionar">Adicionar ao estoque</option>
                                    <option value="remover">Remover do estoque</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="quantidade" class="form-label">Quantidade:</label>
                                <input type="number" class="form-control" id="quantidade" name="quantidade" min="0" required>
                                <div class="form-text" id="quantidade-help">Informe a quantidade para a operação selecionada.</div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn">
                                    <i class="fas fa-save me-1"></i> Salvar Alterações
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Atualizar texto de ajuda conforme a operação selecionada
    document.getElementById('operacao').addEventListener('change', function() {
        const operacao = this.value;
        const helpText = document.getElementById('quantidade-help');
        const quantidadeInput = document.getElementById('quantidade');

        switch (operacao) {
            case 'definir':
                helpText.textContent = 'Informe a nova quantidade total do produto no estoque.';
                break;
            case 'adicionar':
                helpText.textContent = 'Informe a quantidade a ser adicionada ao estoque atual.';
                break;
            case 'remover':
                helpText.textContent = 'Informe a quantidade a ser removida do estoque atual.';
                break;
        }
    });
</script>