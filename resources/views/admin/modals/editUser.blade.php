<form action="{{ route('usuarios.update', $user->id) }}" method="POST" class="grid gap-4 mb-4">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="name-{{ $user->id }}" class="block mb-2 text-sm font-medium text-gray-900">Nombre:</label>
        <input type="text" name="name" id="name-{{ $user->id }}" value="{{ old('name', $user->name) }}" required
            class="bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
    </div>

    <div class="mb-4">
        <label for="email-{{ $user->id }}" class="block mb-2 text-sm font-medium text-gray-900">Email:</label>
        <input type="email" name="email" id="email-{{ $user->id }}" value="{{ old('email', $user->email) }}" required
            class="bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
    </div>

    <div class="mb-4">
        <label for="roles-{{ $user->id }}" class="block mb-2 text-sm font-medium text-gray-900">Roles:</label>
        <select name="roles[]" id="roles-{{ $user->id }}" multiple required
            class="shadow border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
            @foreach ($roles as $role)
                <option value="{{ $role->name }}" {{ $user->roles->contains('name', $role->name) ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="flex justify-end p-4 border-t">
        <button type="button" @click="openModal = false"
            class="text-white inline-flex items-center bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2">
            Cancelar
        </button>
        <button type="submit"
            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
            Editar Usuario
        </button>
    </div>
</form>