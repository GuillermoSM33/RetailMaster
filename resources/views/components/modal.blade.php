<!--Estilos-->
@yield('modal-estilos')

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    @yield('modal-title', 'Título Predeterminado')  <!-- Aquí se pasa dinámicamente el título -->
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                @yield('modal-content', 'Contenido Predeterminado')  <!-- Aquí se pasa dinámicamente el contenido -->
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                @yield('modal-footer')  <!-- Aquí se pasa dinámicamente el contenido del pie de modal, como el botón -->
            </div>
        </div>
    </div>
</div>
