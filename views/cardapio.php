<?php
// Include the image URLs file
require_once __DIR__ . '/../assets/img/image_urls.php';
?>

<div class="card shadow-sm">
    <div class="card-header">
        <h4 class="mb-0"><i class="fas fa-utensils me-2"></i>Cardápio</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="<?= getImageUrl('x_burguer') ?>" class="card-img-top" alt="Classic Burger">
                    <div class="card-body">
                        <h5 class="card-title">Classic Burger</h5>
                        <p class="card-text">Hambúrguer artesanal, queijo cheddar, alface, tomate e molho especial.</p>
                        <p class="card-text"><strong>Preço: R$ 25,90</strong></p>
                        <button class="btn add-to-cart"
                            data-id="1"
                            data-name="Classic Burger"
                            data-price="25.90"
                            data-image="x_burguer">
                            <i class="fas fa-cart-plus me-1"></i> Adicionar ao Carrinho
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="<?= getImageUrl('salad_burguer') ?>" class="card-img-top" alt="Cheese Burger">
                    <div class="card-body">
                        <h5 class="card-title">Cheese Burger</h5>
                        <p class="card-text">Hambúrguer artesanal, queijo cheddar duplo, cebola caramelizada e molho especial.</p>
                        <p class="card-text"><strong>Preço: R$ 27,90</strong></p>
                        <button class="btn add-to-cart"
                            data-id="2"
                            data-name="Cheese Burger"
                            data-price="27.90"
                            data-image="salad_burguer">
                            <i class="fas fa-cart-plus me-1"></i> Adicionar ao Carrinho
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="<?= getImageUrl('bacon_burguer') ?>" class="card-img-top" alt="Bacon Burger">
                    <div class="card-body">
                        <h5 class="card-title">Bacon Burger</h5>
                        <p class="card-text">Hambúrguer artesanal, queijo cheddar, bacon crocante, alface e molho especial.</p>
                        <p class="card-text"><strong>Preço: R$ 29,90</strong></p>
                        <button class="btn add-to-cart"
                            data-id="3"
                            data-name="Bacon Burger"
                            data-price="29.90"
                            data-image="bacon_burguer">
                            <i class="fas fa-cart-plus me-1"></i> Adicionar ao Carrinho
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Toast de Notificação -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="addToCartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Gusta's Burguer</strong>
            <button type="button" class="btn-close" data-dismiss="toast" aria-label="Fechar"></button>
        </div>
        <div class="toast-body">
            Item adicionado ao carrinho com sucesso!
        </div>
    </div>
</div>

<!-- Modal do Carrinho -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">
                    <i class="fas fa-shopping-cart me-2"></i>Carrinho de Compras
                </h5>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <div id="cart-items" class="mb-3">
                    <!-- Items do carrinho serão inseridos aqui via JavaScript -->
                </div>
                <div class="text-end border-top pt-3">
                    <h5>Total: <span id="cart-total" class="text-primary">R$ 0,00</span></h5>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Continuar Comprando</button>
                <button type="button" class="btn" id="checkout-button">
                    <i class="fas fa-check me