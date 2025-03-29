// Cart state
let cartItems = [];

// Initialize cart functionality
document.addEventListener('DOMContentLoaded', function () {
    // Check if BASE_URL is defined
    if (typeof BASE_URL === 'undefined') {
        console.error('BASE_URL is not defined. Cart functionality will not work properly.');
        return;
    }

    loadCartItems();
    initializeAddToCartButtons();
});

// Initialize add to cart buttons
function initializeAddToCartButtons() {
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', () => addToCart(button));
    });
}

// Load cart items from server
async function loadCartItems() {
    try {
        const response = await fetch(`${BASE_URL}?page=cart&action=get`);
        const data = await response.json();
        cartItems = data;
        updateCartCount();
        renderCartItems();
    } catch (error) {
        console.error('Error loading cart:', error);
    }
}

// Update cart count badge
function updateCartCount() {
    const count = cartItems.reduce((total, item) => total + item.quantity, 0);
    document.querySelector('.cart-count').textContent = count;
}

// Format price in BRL
function formatPrice(price) {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    }).format(price);
}

// Update cart total
function updateCartTotal() {
    const total = cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    document.getElementById('cart-total').textContent = formatPrice(total);
}

// Render cart items
function renderCartItems() {
    const cartContainer = document.getElementById('cart-items');
    if (!cartContainer) return;

    cartContainer.innerHTML = cartItems.length === 0
        ? '<p class="text-center text-muted">Seu carrinho está vazio</p>'
        : cartItems.map(item => `
            <div class="cart-item border-bottom pb-3 mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="${BASE_URL}/assets/img/${item.image}" 
                             alt="${item.name}" 
                             class="rounded" 
                             style="width: 60px; height: 60px; object-fit: cover">
                        <div class="ms-3">
                            <h6 class="mb-0">${item.name}</h6>
                            <small class="text-muted">${formatPrice(item.price)} cada</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-sm btn-outline-secondary me-2" 
                                onclick="updateItemQuantity(${item.id}, ${item.quantity - 1})">
                            <i class="fas fa-minus"></i>
                        </button>
                        <span class="mx-2">${item.quantity}</span>
                        <button class="btn btn-sm btn-outline-secondary ms-2" 
                                onclick="updateItemQuantity(${item.id}, ${item.quantity + 1})">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger ms-3" 
                                onclick="removeFromCart(${item.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        `).join('');

    updateCartTotal();
}

// Add item to cart
async function addToCart(button) {
    const { id, name, price, image } = button.dataset;

    try {
        const response = await fetch(`${BASE_URL}?page=cart&action=add`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                produto_id: parseInt(id),
                quantidade: 1
            })
        });

        if (!response.ok) {
            throw new Error('Failed to add item to cart');
        }

        const data = await response.json();
        cartItems = data;
        updateCartCount();
        renderCartItems();

        // Show feedback
        const toastElement = document.getElementById('addToCartToast');
        if (toastElement) {
            const toast = new bootstrap.Toast(toastElement);
            toast.show();
        } else {
            console.error('Toast element not found');
        }

    } catch (error) {
        console.error('Error adding to cart:', error);
        alert('Erro ao adicionar item ao carrinho. Por favor, tente novamente.');
    }
}

// Update item quantity
async function updateItemQuantity(id, newQuantity) {
    if (newQuantity < 0) return;

    try {
        const response = await fetch(`${BASE_URL}?page=cart&action=update`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                produto_id: id,
                quantidade: newQuantity
            })
        });

        if (!response.ok) {
            throw new Error('Failed to update cart');
        }

        const data = await response.json();
        cartItems = data;
        updateCartCount();
        renderCartItems();
    } catch (error) {
        console.error('Error updating cart:', error);
        alert('Erro ao atualizar carrinho. Por favor, tente novamente.');
    }
}

// Remove item from cart
async function removeFromCart(id) {
    try {
        const response = await fetch(`${BASE_URL}?page=cart&action=remove`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                produto_id: id
            })
        });

        if (!response.ok) {
            throw new Error('Failed to remove item from cart');
        }

        const data = await response.json();
        cartItems = data;
        updateCartCount();
        renderCartItems();
    } catch (error) {
        console.error('Error removing from cart:', error);
        alert('Erro ao remover item do carrinho. Por favor, tente novamente.');
    }
}

// Handle checkout
const checkoutButton = document.getElementById('checkout-button');
if (checkoutButton) {
    checkoutButton.addEventListener('click', () => {
        if (cartItems.length === 0) {
            alert('Seu carrinho está vazio!');
            return;
        }
        window.location.href = `${BASE_URL}?page=pedidos&action=checkout`;
    });
}