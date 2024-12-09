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
});