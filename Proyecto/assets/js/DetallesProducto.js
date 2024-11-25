document.addEventListener("DOMContentLoaded", function () {
    const increaseButton = document.getElementById('increase-quantity');
    const decreaseButton = document.getElementById('decrease-quantity');
    const quantityInput = document.getElementById('product-quantity');
    const priceDisplay = document.getElementById('product-price');
    const basePrice = parseFloat(priceDisplay.getAttribute('data-base-price')); // Precio base del producto
    const addToCartButton = document.getElementById('add-to-cart');

    // Función para actualizar el precio total
    const updatePrice = () => {
        const quantity = parseInt(quantityInput.value, 10) || 1; // Obtiene la cantidad seleccionada
        const totalPrice = (basePrice * quantity).toFixed(2); // Calcula el precio total
        priceDisplay.textContent = `${totalPrice}€`; // Actualiza el precio mostrado
    };

    // Incrementar cantidad
    increaseButton.addEventListener('click', function () {
        const currentQuantity = parseInt(quantityInput.value, 10);
        const maxStock = parseInt(quantityInput.max, 10);

        if (currentQuantity < maxStock) {
            quantityInput.value = currentQuantity + 1;
            updatePrice(); // Actualiza el precio
        }
    });

    // Decrementar cantidad
    decreaseButton.addEventListener('click', function () {
        const currentQuantity = parseInt(quantityInput.value, 10);

        if (currentQuantity > 1) {
            quantityInput.value = currentQuantity - 1;
            updatePrice(); // Actualiza el precio
        }
    });

    // Actualizar el precio al cambiar la cantidad manualmente
    quantityInput.addEventListener('input', function () {
        let currentQuantity = parseInt(quantityInput.value, 10);

        // Validar la cantidad dentro de los límites
        if (isNaN(currentQuantity) || currentQuantity < 1) {
            currentQuantity = 1; // Restablece al mínimo
        } else if (currentQuantity > parseInt(quantityInput.max, 10)) {
            currentQuantity = parseInt(quantityInput.max, 10); // Límite máximo
        }

        quantityInput.value = currentQuantity; // Ajusta el valor del input
        updatePrice(); // Actualiza el precio
    });

    // Lógica de añadir al carrito
    addToCartButton.addEventListener('click', function () {
        const quantity = parseInt(quantityInput.value, 10);
        const productId = addToCartButton.getAttribute('data-product-id');

        // Aquí puedes hacer algo con la cantidad y el ID del producto,
        // como enviarlo a un servidor o agregarlo a un carrito en el cliente.
        
        // Ejemplo de una alerta para ver los valores:
        alert(`Producto añadido al carrito:\nID: ${productId}\nCantidad: ${quantity}`);

        // Aquí podrías realizar una solicitud AJAX a tu servidor para añadir el producto al carrito
        // o guardar los datos en el almacenamiento local del navegador.
    });

    // Inicializa el precio con la cantidad por defecto
    updatePrice();
});
