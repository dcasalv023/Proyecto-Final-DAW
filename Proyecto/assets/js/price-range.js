document.addEventListener("DOMContentLoaded", function () {
    const precioRange = document.getElementById("precio");
    const precioMinValue = document.getElementById("precio_min_value");
    const precioMaxValue = document.getElementById("precio_max_value");

    // Función para actualizar el rango de precios en la interfaz y en la URL
    function updatePriceRange() {
        const precio = precioRange.value;

        // Actualizar la etiqueta del precio máximo
        precioMaxValue.innerText = `${precio}€`;

        // Actualizar la URL con el nuevo valor
        const url = new URL(window.location.href);
        url.searchParams.set('precio', precio);
        window.history.replaceState({}, '', url);
    }

    // Inicializar el control deslizante con el valor actual
    if (precioRange) {
        const initialValue = precioRange.value;
        precioMaxValue.innerText = `${initialValue}€`;
        precioMinValue.innerText = `${precioRange.min}€`;

        // Escuchar cambios en el control deslizante
        precioRange.addEventListener("input", updatePriceRange);
    }
});
