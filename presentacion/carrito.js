let cart = [];

function showCart() {
    const cartContainer = document.getElementById('cart-container');
    cartContainer.style.display = cartContainer.style.display === 'none' ? 'block' : 'none';
}

function addToCart(product) {
    const productName = product.querySelector('.product-name')?.innerText;
    const productPrice = product.querySelector('.discount-price')?.innerText;
    const productImage = product.querySelector('img')?.src;

    if (!productName || !productPrice || !productImage) {
        console.error("Error: No se pudo obtener la información del producto");
        return;
    }

    const existingProductIndex = cart.findIndex(item => {
        return item.name === productName && item.price === productPrice && item.image === productImage;
    });

    if (existingProductIndex !== -1) {
        cart[existingProductIndex].quantity += 1;
    } else {
        const cartItem = {
            name: productName,
            price: productPrice,
            image: productImage,
            id: cart.length + 1,
            quantity: 1
        };
        cart.push(cartItem);
    }

    updateCart();
}

function updateCart() {
    const cartItems = document.getElementById('cart-items');
    cartItems.innerHTML = '';

    cart.forEach(item => {
        const cartItem = document.createElement('div');
        cartItem.style.display = 'flex';
        cartItem.style.justifyContent = 'space-between';
        cartItem.innerHTML = `
            <div style="text-align: center; margin-bottom: 10px;">
                <img src="${item.image}" alt="${item.name}" style="max-width: 50px; max-height: 50px;">
                <p>${item.name}</p>
                <p>${item.price}</p>
                <p>Cantidad: ${item.quantity}</p>
            </div>
            <button onclick="removeFromCart(${item.id})">Eliminar</button>
        `;
        cartItems.appendChild(cartItem);
    });

    updateTotal();

    // Guardar el carrito en localStorage
    saveCartToLocalStorage();
}

function removeFromCart(itemId) {
    cart = cart.filter(item => item.id !== itemId);
    updateCart();
}

function clearCart() {
    cart = [];
    updateCart();
}

function updateTotal() {
    // Implementar esta función si quieres mostrar el precio total del carrito
}

// Guardar el carrito en localStorage
function saveCartToLocalStorage() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

// Cargar el carrito desde localStorage al iniciar
document.addEventListener('DOMContentLoaded', () => {
    const savedCart = localStorage.getItem('cart');
    if (savedCart) {
        cart = JSON.parse(savedCart);
        updateCart();
    }

    // Asociar el evento click a los botones de añadir al carrito
    document.querySelectorAll('.btn-primary').forEach(button => {
        button.addEventListener('click', () => {
            addToCart(button.parentElement);
        });
    });
});

// Cuando el usuario hace clic en "Ir al Carrito"
function goToCart() {
    // Guarda el carrito en el almacenamiento local
    saveCartToLocalStorage();
    // Redirige a carrito.php
    window.location.href = 'carrito.php';
}
