document.addEventListener('DOMContentLoaded', () => {
    // Mostrar el modal de agregar producto
    document.querySelectorAll('[data-modal-toggle="add-product-modal"]').forEach(button => {
    button.addEventListener('click', () => {
        const modal = document.getElementById('add-product-modal'); // Asegúrate de que este ID sea correcto
        modal.classList.remove('hidden'); // Mostrar el modal
    });
    });

    // Cerrar el modal al hacer clic fuera de él
    document.querySelector('#add-product-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden'); // Ocultar el modal
        }
    });
    
    // Cerrar el modal al hacer clic en el botón de cancelar
    document.querySelector('#cancel-button').addEventListener('click', () => {
        const modal = document.getElementById('add-product-modal'); // Asegúrate de que este ID sea correcto
        modal.classList.add('hidden'); // Ocultar el modal
    });


    // Mostrar el modal de editar producto
    document.querySelectorAll('[data-modal-toggle="edit-product-modal"]').forEach(button => {
        button.addEventListener('click', () => {
            const modal = document.getElementById('edit-product-modal'); // Asegúrate de que este ID sea correcto
            modal.classList.remove('hidden'); // Mostrar el modal
        });
        });
    
        // Cerrar el modal al hacer clic fuera de él
        document.querySelector('#edit-product-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden'); // Ocultar el modal
            }
        });
        
        // Cerrar el modal al hacer clic en el botón de cancelar
        document.querySelector('#cancel-button1').addEventListener('click', () => {
            const modal = document.getElementById('edit-product-modal'); // Asegúrate de que este ID sea correcto
            modal.classList.add('hidden'); // Ocultar el modal
        });

        // Mostrar el modal de eliminar producto
        document.querySelectorAll('[data-modal-toggle="delete-product"]').forEach(button => {
        button.addEventListener('click', () => {
            const modal = document.getElementById('delete-product'); // Asegúrate de que este ID sea correcto
            modal.classList.remove('hidden'); // Mostrar el modal
        });
        });
    
        // Cerrar el modal al hacer clic en el botón de cancelar
        document.querySelector('#cancel').addEventListener('click', () => {
            const modal = document.getElementById('delete-product'); // Asegúrate de que este ID sea correcto
            modal.classList.add('hidden'); // Ocultar el modal
        });

            // Abrir el modal de editar usuario
    document.querySelectorAll('[data-modal-toggle="edit-user-modal"]').forEach(button => {
        button.addEventListener('click', () => {
            const modal = document.getElementById('edit-user-modal'); // Selecciona el modal por ID
            if (modal) {
                modal.classList.remove('hidden'); // Muestra el modal
            }
        });
    });

    // Cerrar el modal al hacer clic fuera de él
    const editUserModal = document.getElementById('edit-user-modal');
    if (editUserModal) {
        editUserModal.addEventListener('click', function (e) {
            if (e.target === this) {
                this.classList.add('hidden'); // Oculta el modal
            }
        });
    }

    // Cerrar el modal al hacer clic en el botón "Cancelar"
    const cancelButton = document.getElementById('cancel-button');
    if (cancelButton) {
        cancelButton.addEventListener('click', () => {
            const modal = document.getElementById('edit-user-modal'); // Selecciona el modal por ID
            if (modal) {
                modal.classList.add('hidden'); // Oculta el modal
            }
        });
    }
});
