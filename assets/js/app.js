const cartToggle = document.getElementById('cartToggle');
const cartPanel = document.getElementById('cartPanel');
const closeCart = document.getElementById('closeCart');
const cartItems = document.getElementById('cartItems');
const cartTotal = document.getElementById('cartTotal');
const cartCount = document.getElementById('cartCount');
const searchInput = document.getElementById('searchInput');
const productGrid = document.getElementById('productGrid');
const dbNotice = document.getElementById('dbNotice');
const productDetail = document.getElementById('productDetail');

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

const wireAddToCartButtons = () => {
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
};

const renderProducts = (products) => {
    if (!productGrid) {
        return;
    }

    productGrid.innerHTML = '';

    if (!products.length) {
        const emptyState = document.createElement('div');
        emptyState.className = 'empty-state';
        emptyState.textContent = 'Belum ada produk di database. Jalankan file SQL untuk menambahkan data contoh.';
        productGrid.appendChild(emptyState);
        return;
    }

    products.forEach((product) => {
        const card = document.createElement('article');
        card.className = 'product-card';
        card.dataset.name = product.nama_produk;

        const imageWrap = document.createElement('div');
        imageWrap.className = 'product-image';

        const image = document.createElement('img');
        image.src = product.gambar || 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80';
        image.alt = product.nama_produk;

        const tag = document.createElement('span');
        tag.className = 'tag';
        tag.textContent = product.kategori || 'Digital';

        imageWrap.appendChild(image);
        imageWrap.appendChild(tag);

        const info = document.createElement('div');
        info.className = 'product-info';

        const title = document.createElement('h3');
        title.textContent = product.nama_produk;

        const description = document.createElement('p');
        description.textContent = product.deskripsi;

        const meta = document.createElement('div');
        meta.className = 'product-meta';

        const price = document.createElement('span');
        price.className = 'price';
        price.textContent = `Rp ${Number(product.harga).toLocaleString('id-ID')}`;

        const actions = document.createElement('div');
        actions.className = 'actions';

        const detailLink = document.createElement('a');
        detailLink.className = 'ghost-btn';
        detailLink.href = `product.html?id=${product.id}`;
        detailLink.textContent = 'Detail';

        const addButton = document.createElement('button');
        addButton.className = 'primary-btn add-to-cart';
        addButton.dataset.id = product.id;
        addButton.dataset.name = product.nama_produk;
        addButton.dataset.price = product.harga;
        addButton.textContent = 'Tambah';

        actions.appendChild(detailLink);
        actions.appendChild(addButton);

        meta.appendChild(price);
        meta.appendChild(actions);

        info.appendChild(title);
        info.appendChild(description);
        info.appendChild(meta);

        card.appendChild(imageWrap);
        card.appendChild(info);

        productGrid.appendChild(card);
    });

    wireAddToCartButtons();
};

const loadProducts = async () => {
    if (!productGrid) {
        return;
    }

    try {
        const response = await fetch('api/products.php');
        const data = await response.json();

        if (data.error && dbNotice) {
            dbNotice.hidden = false;
            dbNotice.textContent = data.error;
        }

        renderProducts(data.products || []);
    } catch (error) {
        if (dbNotice) {
            dbNotice.hidden = false;
            dbNotice.textContent = 'Gagal memuat data produk. Coba lagi nanti.';
        }
    }
};

const loadProductDetail = async () => {
    if (!productDetail) {
        return;
    }

    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');

    if (!id) {
        productDetail.innerHTML = '<p>Produk tidak ditemukan.</p>';
        return;
    }

    try {
        const response = await fetch(`api/product.php?id=${id}`);
        const data = await response.json();

        if (data.error) {
            productDetail.innerHTML = `<p>${data.error}</p>`;
            return;
        }

        const product = data.product;
        document.title = `${product.nama_produk} - Bisnis Digital Store`;

        const image = document.getElementById('productImage');
        const category = document.getElementById('productCategory');
        const name = document.getElementById('productName');
        const description = document.getElementById('productDescription');
        const price = document.getElementById('productPrice');
        const addButton = document.getElementById('productAdd');

        image.src = product.gambar || 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80';
        image.alt = product.nama_produk;
        category.textContent = product.kategori || 'Digital';
        name.textContent = product.nama_produk;
        description.textContent = product.deskripsi;
        price.textContent = `Rp ${Number(product.harga).toLocaleString('id-ID')}`;

        addButton.dataset.id = product.id;
        addButton.dataset.name = product.nama_produk;
        addButton.dataset.price = product.harga;

        wireAddToCartButtons();
    } catch (error) {
        productDetail.innerHTML = '<p>Gagal memuat detail produk.</p>';
    }
};

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
loadProducts();
loadProductDetail();
