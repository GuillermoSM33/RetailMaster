<nav x-data="{ open: false }" class="navbar">
    <!-- Primary Navigation Menu -->
    <div class="flex justify-between items-center w-full h-16">
        <!-- Logo -->
        <div class="flex items-center">
            <a href="{{ route('dashboard') }}">
                <img class="logo" alt="Retail Master Logo" src="{{ asset('images/LOGORETAIL.png') }}">
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="nav-links">

            <x-nav-link 
                :href="auth()->user()->hasRole('Administrador') ? route('usuarios.index') : route('ventas')" 
                :active="auth()->user()->hasRole('Administrador') ? request()->routeIs('usuarios.index') : request()->routeIs('ventas')">
                {{ auth()->user()->hasRole('Administrador') ? 'Usuarios' : 'Ventas' }}
            </x-nav-link>
            <x-nav-link :href="route('productos.index')" :active="request()->routeIs('productos.index')">
                Inventario
            </x-nav-link>
            <x-nav-link :href="route('users.pdf')" :active="request()->routeIs('users.pdf')">
                Reporte
            </x-nav-link>
        

        <!-- Settings Dropdown -->
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <!-- Imagen de perfil -->
                    <img class="perfil" src="{{ asset('images/user.png') }}" alt="Perfil">
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Mi perfil') }}
                    </x-dropdown-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Cerrar sesión') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>

        <!-- Hamburger Menu -->
        <div class="-mr-2 flex items-center sm:hidden">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
           <x-responsive-nav-link 
                :href="auth()->user()->hasRole('Administrador') ? route('usuarios.index') : route('ventas')" 
                :active="auth()->user()->hasRole('Administrador') ? request()->routeIs('usuarios.index') : request()->routeIs('ventas')">
                {{ auth()->user()->hasRole('Administrador') ? 'Usuarios' : 'Ventas' }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('productos.index')" :active="request()->routeIs('productos.index')">
                Inventario
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('users.pdf')" :active="request()->routeIs('users.pdf')">
                Reporte
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Mi perfil') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                                           onclick="event.preventDefault();
                                                  this.closest('form').submit();">
                        {{ __('Cerrar sesión') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
