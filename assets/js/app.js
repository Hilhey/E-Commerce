const cartToggle = document.getElementById('cartToggle');
const cartPanel = document.getElementById('cartPanel');
const closeCart = document.getElementById('closeCart');
const cartItems = document.getElementById('cartItems');
const cartTotal = document.getElementById('cartTotal');
const cartCount = document.getElementById('cartCount');
const searchInput = document.getElementById('searchInput');

const cartKey = 'bisnisDigitalCart';

const getCart = () => JSON.parse(localStorage.getItem(cartKey) || '[]');
const saveCart = (cart) => localStorage.setItem(cartKey, JSON.stringify(cart));

const formatPrice = (value) =>
    new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(value);

const updateCartUI = () => {
    if (!cartItems || !cartTotal || !cartCount) {
        return;
    }

    const cart = getCart();
    cartItems.innerHTML = '';
    let total = 0;

    cart.forEach((item) => {
        total += item.price * item.qty;
        const itemEl = document.createElement('div');
        itemEl.className = 'cart-item';
        itemEl.innerHTML = `
            <div>
                <strong>${item.name}</strong>
                <p>${formatPrice(item.price)} x ${item.qty}</p>
            </div>
            <div class="cart-actions">
                <button data-id="${item.id}" data-action="decrease">-</button>
                <button data-id="${item.id}" data-action="increase">+</button>
                <button data-id="${item.id}" data-action="remove">Hapus</button>
            </div>
        `;
        cartItems.appendChild(itemEl);
    });

    cartTotal.textContent = formatPrice(total);
    cartCount.textContent = cart.reduce((sum, item) => sum + item.qty, 0);
};

const updateCartItem = (id, action) => {
    const cart = getCart();
    const index = cart.findIndex((item) => item.id === id);

    if (index === -1) {
        return;
    }

    if (action === 'increase') {
        cart[index].qty += 1;
    }

    if (action === 'decrease') {
        cart[index].qty = Math.max(1, cart[index].qty - 1);
    }

    if (action === 'remove') {
        cart.splice(index, 1);
    }

    saveCart(cart);
    updateCartUI();
};

const addToCartButtons = document.querySelectorAll('.add-to-cart');
addToCartButtons.forEach((button) => {
    button.addEventListener('click', () => {
        const id = button.dataset.id;
        const name = button.dataset.name;
        const price = parseFloat(button.dataset.price);
        const cart = getCart();
        const existing = cart.find((item) => item.id === id);

        if (existing) {
            existing.qty += 1;
        } else {
            cart.push({ id, name, price, qty: 1 });
        }

        saveCart(cart);
        updateCartUI();
        if (cartPanel) {
            cartPanel.classList.add('open');
        }
    });
});

if (cartItems) {
    cartItems.addEventListener('click', (event) => {
        const action = event.target.dataset.action;
        const id = event.target.dataset.id;
        if (!action || !id) {
            return;
        }
        updateCartItem(id, action);
    });
}

if (cartToggle && cartPanel) {
    cartToggle.addEventListener('click', () => {
        cartPanel.classList.toggle('open');
    });
}

if (closeCart && cartPanel) {
    closeCart.addEventListener('click', () => {
        cartPanel.classList.remove('open');
    });
}

if (searchInput) {
    searchInput.addEventListener('input', (event) => {
        const query = event.target.value.toLowerCase();
        const cards = document.querySelectorAll('.product-card');
        cards.forEach((card) => {
            const name = card.dataset.name.toLowerCase();
            card.style.display = name.includes(query) ? 'flex' : 'none';
        });
    });
}

updateCartUI();
