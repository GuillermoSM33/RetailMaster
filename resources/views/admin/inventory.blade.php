@extends ('layouts.app')

@section('title', 'Inventario')

@section('estilos')
@vite(['resources/css/ventas.css'])
@endsection

@section('contenido')
<div class="custom-container" x-data="{ openModal: null }">
    <h1>Inventario</h1>
    <div class="custom-search-bar">
        <button @click="openModal = 'add-product'">Agregar Producto</button>
    </div>

    <!-- Modal Agregar Producto-->
    <div 
    x-show="openModal === 'add-product'" 
    @click.away="openModal = null" 
    @keydown.escape.window="openModal = null"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" 
    style="display: none;">

    <div class="flex items-center justify-center min-h-screen px-4 text-center">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>
        <div class="inline-block w-full max-w-2xl p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white rounded-lg shadow-xl">
            <!-- Contenido del Modal -->
                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Agregar Producto
                    </h3>
                    <button @click="openModal = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
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
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->id_producto }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td>{{ $producto->precio_costo }}</td>
                    <td>{{ $producto->precio_venta }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td class="actions">
                    <button @click="openModal = 'edit-product'">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#FAE339" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </button>

                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#ff5555" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Editar Producto -->
    <div 
    x-show="openModal === 'edit-product'" 
    @click.away="openModal = null" 
    @keydown.escape.window="openModal = null"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" 
    style="display: none;">

    <div class="flex items-center justify-center min-h-screen px-4 text-center">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>
        <div class="inline-block w-full max-w-2xl p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white rounded-lg shadow-xl">
            <!-- Contenido del Modal -->
                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Editar Producto
                    </h3>
                    <button @click="openModal = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
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

</div>
@endsection
