function openTab(event, tabName){

    const tabs = document.querySelectorAll ('.tab'); //Obtener elemento(s) con clase ('.tab') y guardarlo en la variable

    tabs.forEach(tab=>{ //se aplica sobre cada elemento con clase tab
        
        tab.classList.add('tab-hide'); //Aplica la clase tab-hide a los elementos que itera 

    });
    
    event.currentTarget.classList.remove('tab-hide'); //Elimina la clase 'tab-hide' del botón que fue seleccionado

/*
    const tabContent = document.querySelectorAll ('.tabContent');

    tabContent.forEach(tabContent=>{
        
        tabContent.classList.add('tabContent-hide')
A
    });
*/


}

const openModalBtn = document.getElementById('openModalBtn');
const modal = document.getElementById('modal');
const closeModalBtn = document.getElementById('closeModalBtn');

// Función para abrir el modal
openModalBtn.addEventListener('click', () => {
    modal.style.display = 'flex'; // Mostrar el modal
});

// Función para cerrar el modal
closeModalBtn.addEventListener('click', () => {
    modal.style.display = 'none'; // Ocultar el modal
});

// Cerrar el modal si se hace clic fuera del contenido
window.addEventListener('click', (e) => {
    if (e.target === modal) {
        modal.style.display = 'none'; // Ocultar el modal
    }
});