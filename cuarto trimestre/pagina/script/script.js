const carrito = document.getElementById('carrito');
const elementos1 = document.getElementById('lista-1');
const lista = document.querySelector('#lista-carrito tbody');
const vaciarCarritoBtn = document.getElementById('vaciar-carrito');
const totalElement = document.getElementById('total');
let total = 0;

// Inicializar carrito desde localStorage
let carritoProductos = JSON.parse(localStorage.getItem('carrito')) || [];

cargarEventListeners();

function cargarEventListeners() {
    elementos1.addEventListener('click', comprarElemento);
    carrito.addEventListener('click', eliminarElemento);
    vaciarCarritoBtn.addEventListener('click', vaciarCarrito);
}

function comprarElemento(e) {
    e.preventDefault();
    if (e.target.classList.contains('agregar-carrito')) {
        const elemento = e.target.parentElement.parentElement;
        leerDatosElemento(elemento);
    }
}

function leerDatosElemento(elemento) {
    const infoElemento = {
        imagen: elemento.querySelector('img').src,
        titulo: elemento.querySelector('h3').textContent,
        precio: parseFloat(elemento.querySelector('.precio').textContent.replace('$', '').replace('.', '')),
        id: elemento.querySelector('a').getAttribute('data-id')
    };

    // Añadir producto al carrito y sincronizar localStorage
    carritoProductos.push(infoElemento);
    sincronizarLocalStorage();
    insertarCarrito(infoElemento);
}

function insertarCarrito(elemento) {
    const row = document.createElement('tr');
    row.innerHTML = `
    <td>
        <img src="${elemento.imagen}" width=100 />
    </td>
    <td>
        ${elemento.titulo}
    </td>
    <td>
        $${elemento.precio.toLocaleString('es-CO')}
    </td>
    <td>
        <a href="#" class="borrar" data-id="${elemento.id}">x</a>
    </td>

    `;
    lista.appendChild(row);
    actualizarTotal(elemento.precio);
}

function eliminarElemento(e) {
    // Verificar si el clic proviene del botón de "Pagar"
    if (e.target.classList.contains('pagar')) {
        return; // Salir de la función sin hacer nada
    }

    e.preventDefault(); // Solo se previene si no es el botón de "Pagar"
    
    if (e.target.classList.contains('borrar')) {
        const elemento = e.target.parentElement.parentElement;
        const precio = parseFloat(elemento.querySelector('td:nth-child(3)').textContent.replace('$', '').replace('.', ''));
        elemento.remove();
        actualizarTotal(-precio);

        // Eliminar del carrito y sincronizar localStorage
        const id = e.target.getAttribute('data-id');
        carritoProductos = carritoProductos.filter(item => item.id !== id);
        sincronizarLocalStorage();
    }
}

function vaciarCarrito() {
    while (lista.firstChild) {
        lista.removeChild(lista.firstChild);
    }
    total = 0;
    actualizarTotal(0);

    // Vaciar carrito en localStorage
    carritoProductos = [];
    sincronizarLocalStorage();
}

function actualizarTotal(cantidad) {
    total += cantidad;
    totalElement.textContent = `${total.toLocaleString('es-CO')}`;
}

function sincronizarLocalStorage() {
    localStorage.setItem('carrito', JSON.stringify(carritoProductos));
}

document.addEventListener('DOMContentLoaded', () => {
    // Al cargar el carrito, recuperar los productos del localStorage
    carritoProductos = JSON.parse(localStorage.getItem('carrito')) || [];
    carritoProductos.forEach(item => insertarCarrito(item));
    actualizarTotal(carritoProductos.reduce((acc, item) => acc + item.precio, 0));
});
