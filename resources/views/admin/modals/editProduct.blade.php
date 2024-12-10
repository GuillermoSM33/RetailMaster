<form action="{{ route('productos.update', $producto->id_producto) }}" method="POST">
    @csrf
    @method('PUT') 

    <div class="grid gap-4 mb-4">
        <div>
            <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900">Descripción</label>
            <input type="text" name="descripcion" class="bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="{{ old('descripcion', $producto->descripcion) }}" required>
        </div>
        <div>
            <label for="precio_costo" class="block mb-2 text-sm font-medium text-gray-900">Precio costo</label>
            <input type="number" step="0.01" name="precio_costo" class="bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="{{ old('precio_costo', $producto->precio_costo) }}" required>
        </div>
        <div>
            <label for="precio_venta" class="block mb-2 text-sm font-medium text-gray-900">Precio venta</label>
            <input type="number" step="0.01" name="precio_venta" class="bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="{{ old('precio_venta', $producto->precio_venta) }}" required>
        </div>
        <div>
            <label for="stock" class="block mb-2 text-sm font-medium text-gray-900">Stock</label>
            <input type="number" name="stock" class="bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="{{ old('stock', $producto->stock) }}" required>
        </div>
    </div>

    <!-- Botones del formulario -->
    <div class="flex justify-end p-4 border-t">
        <button type="button" @click="openModal = false" class="text-white inline-flex items-center bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2">
            Cancelar
        </button>
        <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
            Actualizar Producto
        </button>
    </div>
</form>