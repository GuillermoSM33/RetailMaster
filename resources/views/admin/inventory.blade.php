@extends ('layouts.app')

@section('title', 'Inventario')

@section('estilos')
@vite(['resources/css/ventas.css'])
@endsection

@section('contenido')
<!-- MENSAJE -->
@if(session('success'))
    <div id="success-alert"
        class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50"
        role="alert">
        <span class="font-medium">{{ session('success') }}</span>
    </div>

    <script>
        // Esperar 3 segundos (3000 milisegundos) y luego ocultar el mensaje
        setTimeout(function () {
            let alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.display = 'none';
            }
        }, 3000); // 3000 ms = 3 segundos
    </script>
@endif

<div class="custom-container" x-data="{ openModal: null }">
    <h1>Inventario</h1>
    @if(auth()->user()->hasrole('Administrador'))
    <div class="custom-search-bar">
        <button @click="openModal = 'add-product'">Agregar Producto</button>
    </div>
    @endif

    <!-- Modal Agregar Producto-->
    <div x-show="openModal === 'add-product'" @click.away="openModal = null" @keydown.escape.window="openModal = null"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">

        <div class="flex items-center justify-center min-h-screen px-4 text-center">
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>
            <div
                class="inline-block w-full max-w-2xl p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white rounded-lg shadow-xl">
                <!-- Contenido del Modal -->
                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Agregar Producto
                    </h3>
                    <button @click="openModal = false" type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Cerrar modal</span>
                    </button>
                </div>
                <div class="p-4">
                    @include('admin.modals.addProduct')
                </div>
            </div>
        </div>
    </div>

    <!-- TABLA -->
    <div class="tabla">
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Precio costo</th>
                    <th>Precio venta</th>
                    <th>Stock</th>
                    @if(auth()->user()->hasrole('Administrador'))
                    <th>Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                    <tr>
                        <td>{{ $producto->id_producto }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>{{ $producto->precio_costo }}</td>
                        <td>{{ $producto->precio_venta }}</td>
                        <td class="{{ $producto->stock <= 10 ? 'stock-bajo' : '' }}">
                            {{ $producto->stock }}
                         </td>
                        @if(auth()->user()->hasrole('Administrador'))
                        <td class="actions">
                            <button @click="openModal = 'edit-product-{{ $producto->id_producto }}'">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#FAE339" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </button>

                            <button type="submit" @click="openModal = {{ $producto->id_producto }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#ff5555" viewBox="0 0 24 24"
                                    fill="currentColor" class="size-6">
                                    <path fill-rule="evenodd"
                                        d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </td>
                        @endif
                    </tr>

                    <!-- Modal Eliminar Producto -->
                    <div x-show="openModal === {{ $producto->id_producto }}" @click.away="openModal = null"
                        @keydown.escape.window="openModal = null"
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
                        style="display: none;">

                        <div class="flex items-center justify-center min-h-screen px-4 text-center">
                            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>
                            <div class="relative p-4 w-full max-w-md max-h-full z-10">
                                <div class="relative bg-white rounded-lg shadow">
                                    <button @click="openModal = null" type="button"
                                        class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                                        data-modal-hide="delete-product">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Cerrar modal</span>
                                    </button>
                                    <div class="p-4 md:p-5 text-center">
                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500">¿Estás seguro de que deseas
                                            eliminar este producto?</h3>

                                        <div class="flex justify-center">
                                            <!-- Formulario de Eliminación -->
                                            <form action="{{ route('productos.destroy', $producto->id_producto) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                    Sí, eliminar
                                                </button>
                                            </form>
                                            <button @click="openModal = false" type="button"
                                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                                No, cancelar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Editar Producto -->
                    <div x-show="openModal === 'edit-product-{{ $producto->id_producto }}'" @click.away="openModal = null"
                        @keydown.escape.window="openModal = null"
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
                        style="display: none;">

                        <div class="flex items-center justify-center min-h-screen px-4 text-center">
                            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>
                            <div
                                class="inline-block w-full max-w-2xl p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white rounded-lg shadow-xl">
                                <!-- Contenido del Modal -->
                                <div class="flex items-center justify-between p-4 border-b">
                                    <h3 class="text-lg font-semibold text-gray-900">
                                        Editar Producto
                                    </h3>
                                    <button @click="openModal = false" type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Cerrar modal</span>
                                    </button>
                                </div>
                                <div class="p-4">
                                    @include('admin.modals.editProduct')
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection