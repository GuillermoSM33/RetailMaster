document.addEventListener('DOMContentLoaded', () => {
    // Mostrar el modal (abrir)
    document.querySelectorAll('[data-modal-toggle="crud-modal"]').forEach(button => {
        button.addEventListener('click', () => {
            const modal = document.getElementById('crud-modal');
            modal.classList.toggle('hidden');
        });
    });

    // Cerrar el modal al hacer clic fuera de él
    document.querySelector('#crud-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });

    // Cerrar el modal al hacer clic en el botón de cancelar
    document.querySelector('#cancel-button').addEventListener('click', () => {
        const modal = document.getElementById('crud-modal');
        modal.classList.add('hidden');
    });

    
    // Modal de eliminacion
    // Mostrar el modal de eliminación (popup-modal)
    document.querySelectorAll('[data-modal-toggle="popup-modal"]').forEach(button => {
        button.addEventListener('click', () => {
            const modal = document.getElementById('popup-modal');
            modal.classList.remove('hidden'); // Mostrar el modal
        });
    });

    // Cerrar el modal de eliminación al hacer clic fuera de él
    document.querySelector('#popup-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });

    // Cerrar el modal de eliminación al hacer clic en el botón de cancelar
    document.querySelectorAll('[data-modal-hide="popup-modal"]').forEach(button => {
        button.addEventListener('click', () => {
            const modal = document.getElementById('popup-modal');
            modal.classList.add('hidden'); // Ocultar el modal
        });
    });
});