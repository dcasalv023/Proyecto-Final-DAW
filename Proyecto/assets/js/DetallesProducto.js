document.addEventListener("DOMContentLoaded", function() {
    // Lightbox initialization (if you're using lightbox2)
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true
    });

    // Cantidad ajustable
    const increaseButton = document.getElementById('increase-quantity');
    const decreaseButton = document.getElementById('decrease-quantity');
    const quantityInput = document.getElementById('product-quantity');

    increaseButton.addEventListener('click', function() {
        if (quantityInput.value < quantityInput.max) {
            quantityInput.value = parseInt(quantityInput.value) + 1;
        }
    });

    decreaseButton.addEventListener('click', function() {
        if (quantityInput.value > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
        }
    });

    // Añadir al carrito (ahora usando el valor del atributo 'data-product-id')
    const addToCartButton = document.getElementById('add-to-cart');
    addToCartButton.addEventListener('click', function() {
        const quantity = quantityInput.value;
        const productId = addToCartButton.getAttribute('data-product-id'); // Obtenemos el ID del producto
        // Aquí puedes implementar la lógica para añadir al carrito, por ejemplo con AJAX.
        alert(`Producto añadido al carrito: ID ${productId}, Cantidad: ${quantity}`);
    });
});
