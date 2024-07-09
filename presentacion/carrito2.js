window.onload = function() {
    renderCart();
    // Agrega un evento de clic al botón "Actualizar Carro"
    document.getElementById('actualizar-carro-btn').addEventListener('click', function() {
        updateTotal();
    });
}

function renderCart() {
    // Recupera el carrito del almacenamiento local
    var cart = JSON.parse(localStorage.getItem('cart'));
    // Accede al cuerpo de la tabla en el DOM
    var tableBody = document.getElementById('cart-table-body');
    // Limpia cualquier contenido previo de la tabla
    tableBody.innerHTML = '';
    // Verifica si hay elementos en el carrito
    if (cart && cart.length > 0) {
        // Itera sobre los productos en el carrito y agrega filas a la tabla
        cart.forEach(function(item) {
            var row = '<tr>' +
                '<td class="product-thumbnail"><img src="' + item.image + '" alt="' + item.name + '"></td>' +
                '<td class="product-name">' + item.name + '</td>' +
                '<td class="product-price">' + item.price + '</td>' +
                '<td class="product-quantity">' +
                '<div class="input-group mb-3" style="max-width: 120px;">' +
                '<div class="input-group-prepend">' +
                '<button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>' +
                '</div>' +
                '<input type="text" class="form-control text-center quantity-input" value="' + item.quantity + '" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">' +
                '<div class="input-group-append">' +
                '<button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>' +
                '</div>' +
                '</div>' +
                '</td>' +
                '<td class="product-total">' + (item.price * item.quantity).toFixed(2) + '</td>' +
                '<td class="product-remove"><button onclick="removeFromCart(' + item.id + ')">Eliminar</button></td>' +
                '</tr>';
            tableBody.innerHTML += row;
        });

        // Después de agregar las filas, agregamos los event listeners a los botones
        var decrementButtons = document.querySelectorAll('.js-btn-minus');
        var incrementButtons = document.querySelectorAll('.js-btn-plus');

        decrementButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var input = button.parentElement.parentElement.querySelector('.quantity-input');
                updateQuantity(input, -1);
                updateSubtotal();
            });
        });

        incrementButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var input = button.parentElement.parentElement.querySelector('.quantity-input');
                updateQuantity(input, 1);
                updateSubtotal();
            });
        });

    } else {
        // Si el carrito está vacío, muestra un mensaje
        tableBody.innerHTML = '<tr><td colspan="6">No hay productos en el carrito.</td></tr>';
    }
}

// Función para actualizar el subtotal y el total
function updateSubtotal() {
    // Recupera todos los elementos de fila en la tabla del carrito
    var rows = document.querySelectorAll('#cart-table-body tr');
    var subtotal = 0;
    // Itera sobre cada fila y actualiza el subtotal
    rows.forEach(function(row) {
        // Recupera el precio y la cantidad del producto en esta fila
        var price = parseFloat(row.querySelector('.product-price').innerText);
        var quantity = parseInt(row.querySelector('.quantity-input').value);
        // Calcula el subtotal de este producto y agrégalo al subtotal total
        subtotal += price * quantity;
        // Actualiza el valor del subtotal en esta fila
        row.querySelector('.product-total').innerText = (price * quantity).toFixed(2);
    });

    // Actualiza los elementos de subtotal y total en el DOM
    document.getElementById('subtotal').innerText = subtotal.toFixed(2);
    document.getElementById('total').innerText = subtotal.toFixed(2);
}

function updateQuantity(button, increment) {
    const input = button.parentElement.parentElement.querySelector('.quantity-input');
    let value = parseInt(input.value);
    value += increment;
    if (value < 1) value = 1;  // Asegura que la cantidad no sea menor que 1
    input.value = value;
    updateSubtotal(); // Actualiza el subtotal después de cambiar la cantidad
}

function removeFromCart(productId) {
    // Recupera el carrito del almacenamiento local
    var cart = JSON.parse(localStorage.getItem('cart'));
    // Encuentra el índice del producto con el ID dado en el carrito
    var index = cart.findIndex(function(item) {
        return item.id === productId;
    });
    // Si se encuentra el producto en el carrito, elimínalo
    if (index !== -1) {
        cart.splice(index, 1);
        // Actualiza el carrito en el almacenamiento local
        localStorage.setItem('cart', JSON.stringify(cart));
        // Vuelve a renderizar el carrito
        renderCart();
    }
}

function updateTotal() {
    // Recupera todos los elementos de fila en la tabla del carrito
    var rows = document.querySelectorAll('#cart-table-body tr');
    var subtotal = 0;
    var cart = []; // Aquí se almacenará el carrito como un array de objetos

    // Itera sobre cada fila y actualiza el subtotal
    rows.forEach(function(row) {
        var price = parseFloat(row.querySelector('.product-price').textContent);
        var quantity = parseInt(row.querySelector('.quantity-input').value);
        var total = price * quantity;

        subtotal += total;

        // Construye un objeto para cada producto en el carrito
        var item = {
            nombre_producto: row.querySelector('.product-name').textContent, // Enviar el nombre del producto
            cantidad: quantity,
            precio: total
        };

        // Agrega el objeto al carrito
        cart.push(item);
    });

    // Actualiza los valores de subtotal y total en el DOM
    document.getElementById('subtotal').textContent = subtotal.toFixed(2);
    document.getElementById('total').textContent = subtotal.toFixed(2);

    // Actualiza el valor del carrito en un campo oculto para enviarlo al servidor
    document.getElementById('cart-input').value = JSON.stringify(cart);
}

function procesarPedido(event) {
    event.preventDefault(); // Evitar el envío normal del formulario

    // Obtener el nombre de usuario desde el Navbar (asumiendo que está disponible como texto plano)
    var username = document.querySelector('.user-name').textContent.trim();

    // Obtener los datos del formulario
    var formData = new FormData(document.getElementById("pedido-form"));

    // Agregar el nombre de usuario al FormData
    formData.append('username', username);

    // Realizar la solicitud AJAX
    fetch('procesar_pedido.php', {
        method: 'POST',
        body: formData
    }).then(response => response.json()) // Asumiendo que el servidor responde con JSON
      .then(data => {
          if (data.success) {
              document.getElementById("success-message").style.display = 'block'; // Mostrar mensaje de éxito
              
              // Abrir una nueva pestaña con el comprobante
              window.open('comprobante/index.php?pedido_id=' + data.pedido_id, '_blank');
          } else {
              alert("Hubo un error al procesar el pedido: " + data.error);
          }
      }).catch(error => {
          console.error('Error en la solicitud:', error);
          alert("Error técnico al procesar el pedido.");
      });
}
