document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('.barra-lateral .navegacion a');
    const currentLocation = window.location.href; // Obtiene la URL actual
    links.forEach(link => {
        if (link.href === currentLocation) {
            link.classList.add('active'); // Marca como activo el enlace de la página actual
        }
        link.addEventListener('click', function() {
            links.forEach(node => node.classList.remove('active')); // Remueve 'active' de todos
            this.classList.add('active'); // Añade 'active' al clickeado
        });
    });
});
