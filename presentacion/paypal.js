
paypal.Buttons({
  // Sets up the transaction when a payment button is clicked
  createOrder: (data, actions) => {
      // Obtener el valor actual del total desde carrito.php
      var totalText = document.getElementById('total').textContent.trim(); // Obtener el texto del elemento #total
      var totalAmount = parseFloat(totalText.replace('$', '')); // Eliminar el símbolo $ y convertir a número

      return actions.order.create({
          purchase_units: [{
              amount: {
                  value: totalAmount.toFixed(2) // Asegurarse de que el valor tenga 2 decimales
              }
          }]
      });
  },
  // Finalize the transaction after payer approval
  onApprove: (data, actions) => {
      return actions.order.capture().then(function(orderData) {
          alert('Transacción completada');

          // Simular un clic en el botón "Realizar Pedido"
          document.getElementById('realizar-pedido-btn').click();
      });
  }
}).render('#paypal-button-container');
