<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header">
                <h4 class="mb-0"><i class="fas fa-sign-in-alt me-2"></i> Login</h4>
            </div>
            <div class="card-body">
                <?php if (isset($erro)): ?>
                    <div class="alert alert-danger">
                        <?= $erro ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="<?= BASE_URL ?>?page=login">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="senha" name="senha" required>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn">
                            <i class="fas fa-sign-in-alt me-2"></i> Entrar
                        </button>
                    </div>
                </form>
                
                <div class="mt-4 text-center">
                    <p class="mb-0">Não tem uma conta? <a href="<?= BASE_URL ?>?page=cadastro">Cadastre-se</a></p>
                </div>
            </div>
        </div>
    </div>
</div>