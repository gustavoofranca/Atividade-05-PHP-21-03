</main>
    
    <footer class="mt-5 py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3 mb-md-0">
                    <h5><i class="fas fa-hamburger me-2"></i> Gusta's Burguer</h5>
                    <p class="text-muted">Sabor e qualidade em cada mordida.</p>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <h5>Links Rápidos</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?= BASE_URL ?>" class="text-decoration-none">Home</a></li>
                        <li><a href="<?= BASE_URL ?>?page=cardapio" class="text-decoration-none">Cardápio</a></li>
                        <li><a href="<?= BASE_URL ?>?page=sobre" class="text-decoration-none">Saiba Mais</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Redes Sociais</h5>
                    <div class="social-icons">
                        <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4" style="border-color: #333;">
            <div class="text-center">
                <p class="mb-0">&copy; <?= date('Y') ?> Gusta's Burguer - Todos os direitos reservados</p>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Scripts personalizados -->
    <script src="<?= BASE_URL ?>/assets/js/script.js"></script>
</body>
</html>