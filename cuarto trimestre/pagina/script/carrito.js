document.addEventListener('DOMContentLoaded', () => {
    // Recuperar productos del localStorage y actualizar la vista
    carritoProductos = JSON.parse(localStorage.getItem('carrito')) || [];
    actualizarCarrito();
});

function actualizarCarrito() {
    const carritoItems = document.getElementById('carrito-items');
    let total = 0;

    carritoItems.innerHTML = '';

    carritoProductos.forEach(item => {
        const subtotal = item.precio;  // Si quieres agregar cantidad, puedes calcular subtotal * cantidad
        carritoItems.innerHTML += `
            <tr>
                <td><img src="${item.imagen}" width="100" /></td>
                <td>${item.titulo}</td>
                <td>$${item.precio.toLocaleString('es-CO')}</td>
                <td>$${subtotal.toLocaleString('es-CO')}</td>
                <td><button class="borrar" onclick="eliminarDelCarrito('${item.id}')">X</button></td>
            </tr>
        `;
        total += subtotal;
    });

    document.getElementById('total').textContent = `$${total.toLocaleString('es-CO')}`;
}

// Función para cargar el carrito en la página carrito.html
function cargarCarrito() {
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    let carritoContainer = document.getElementById('carrito-container');
    carritoContainer.innerHTML = '';

    carrito.forEach(producto => {
        let fila = document.createElement('tr');
        
        fila.innerHTML = `
            <td><img src="${producto.imagen}" alt="${producto.nombre}" style="width: 50px;"></td>
            <td>${producto.nombre}</td>
            <td>$${producto.precio}</td>
            <td>
                <button class="btn-restar" onclick="cambiarCantidad('${producto.id}', -1)">-</button>
                <span>${producto.cantidad}</span>
                <button class="btn-sumar" onclick="cambiarCantidad('${producto.id}', 1)">+</button>
            </td>
            <td>$${producto.precio * producto.cantidad}</td>
        `;

        carritoContainer.appendChild(fila);
    });

    actualizarTotalCarrito();
}

// Función para cambiar la cantidad de un producto
function cambiarCantidad(id, cambio) {
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    let producto = carrito.find(producto => producto.id === id);

    if (producto) {
        producto.cantidad += cambio;

        // Si la cantidad es 0 o menor, eliminamos el producto
        if (producto.cantidad <= 0) {
            carrito = carrito.filter(producto => producto.id !== id);
        }

        // Guardar el carrito actualizado en localStorage
        localStorage.setItem('carrito', JSON.stringify(carrito));

        // Recargar el carrito
        cargarCarrito();
    }
}

// Función para actualizar el total del carrito
function actualizarTotalCarrito() {
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    let total = carrito.reduce((sum, producto) => sum + producto.precio * producto.cantidad, 0);
    document.getElementById('carrito-total').textContent = `Total: $${total}`;
}

// Cargar el carrito al cargar la página
window.onload = cargarCarrito;


function eliminarDelCarrito(id) {
    carritoProductos = carritoProductos.filter(item => item.id !== id);
    sincronizarLocalStorage();
    actualizarCarrito();
}

function sincronizarLocalStorage() {
    localStorage.setItem('carrito', JSON.stringify(carritoProductos));
}
