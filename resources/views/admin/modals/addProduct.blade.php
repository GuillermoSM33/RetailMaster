@extends('components.modalcom')  <!-- Esto incluye la plantilla base del modal -->

@section('modal-title', 'Crear nuevo producto')
@section('modal-content')
<form>
    <div class="grid gap-4 mb-4">
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nombre</label>
            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Ingrese el nombre del producto" required>
        </div>
        <div>
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Descripción</label>
            <input type="text" name="description" id="description" class="bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Descripción del producto" required>
        </div>
        <div>
            <label for="cost_price" class="block mb-2 text-sm font-medium text-gray-900">Precio costo</label>
            <input type="number" name="cost_price" id="cost_price" class="bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Precio de costo" required>
        </div>
        <div>
            <label for="sale_price" class="block mb-2 text-sm font-medium text-gray-900">Precio venta</label>
            <input type="number" name="sale_price" id="sale_price" class="bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Precio de venta" required>
        </div>
        <div>
            <label for="stock" class="block mb-2 text-sm font-medium text-gray-900">Stock</label>
            <input type="number" name="stock" id="stock" class="bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Cantidad en stock" required>
        </div>
    </div>
</form>
@endsection

@section('modal-button')
    <button id="cancel-button" class="text-white inline-flex items-center bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2">
        Cancelar
    </button>

    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
        Añadir Producto
    </button>
@endsection