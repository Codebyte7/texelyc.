const navToggle = document.querySelector('.nav-toggle');
const navmenu = document.querySelector('.nav-menu');
navToggle.addEventListener('click', () => {
    navmenu.classList.toggle('nav-menu_visble');
    if (navmenu.classList.contains('nav-menu-visble')) {
        navToggle.setAttribute("aria-label", "cerrar menu");
    } else {
        navToggle.setAttribute("aria-label", "Abrir menu)");
    }
});