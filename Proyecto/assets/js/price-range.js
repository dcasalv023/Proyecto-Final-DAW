document.addEventListener("DOMContentLoaded", function () {
    // Obtener el control deslizante de precio
    const precioRange = document.getElementById("precio");
    const precioMinValue = document.getElementById("precio_min_value");
    const precioMaxValue = document.getElementById("precio_max_value");

    // Función para actualizar los valores de los precios en el rango
    function updatePriceRange() {
        const precio = precioRange.value;

        // Actualizar los valores mostrados del precio mínimo y máximo
        precioMinValue.innerHTML = `${precio}€`;
        precioMaxValue.innerHTML = `${precio}€`;

        // Actualizar la URL con el nuevo valor de precio
        const url = new URL(window.location.href);

        // Establecemos el parámetro de precio en la URL
        url.searchParams.set('precio', precio); 

        // Realizar la redirección para filtrar los productos con el nuevo parámetro
        window.history.replaceState({}, '', url); // Esto no recarga la página pero actualiza la URL
    }

    // Establecer el valor inicial del control deslizante
    const initialValue = precioRange.value;
    precioMinValue.innerHTML = `${initialValue}€`;
    precioMaxValue.innerHTML = `${initialValue}€`;

    // Escuchar el evento de cambio en el control deslizante
    precioRange.addEventListener("input", updatePriceRange);
});
