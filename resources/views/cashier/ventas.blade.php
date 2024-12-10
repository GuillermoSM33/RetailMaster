@extends('layouts.app')

@section('title', 'Ventas')

@section('estilos')
    @vite(['resources/css/ventas.css'])
@endsection

@section('contenido')
<div class="custom-container">
    <h1>Ventas</h1>

    <!-- Barra de búsqueda -->
    <div class="custom-search-bar">
        <input type="text" id="search" placeholder="Código de producto o nombre de producto">
        <div id="search-results" class="search-results"></div>
        <button id="add-product">Agregar producto</button>
        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Generar Corte</button>
    </div>

    <!-- Botones de pago -->
    <div class="custom-payment-buttons">
        <button class="custom-cash">
            EFECTIVO
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path d="M12 7.5a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z" />
                <path fill-rule="evenodd" d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 14.625v-9.75ZM8.25 9.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0Z" clip-rule="evenodd" />
                <path d="M2.25 18a.75.75 0 0 0 0 1.5c5.4 0 10.63.722 15.6 2.075 1.19.324 2.4-.558 2.4-1.82V18.75a.75.75 0 0 0-.75-.75H2.25Z" />
            </svg>
        </button>

        <button class="custom-card">
            TARJETA
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path d="M4.5 3.75a3 3 0 0 0-3 3v.75h21v-.75a3 3 0 0 0-3-3h-15Z" />
                <path fill-rule="evenodd" d="M22.5 9.75h-21v7.5a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3v-7.5Zm-18 3.75a.75.75 0 0 1 .75-.75h6a.75.75 0 0 1 0 1.5h-6a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</div>

<!-- Tabla de ventas -->
<div class="tabla">
    <div class="total">
        <span>Total: $0.00 MX</span>
    </div>
    <table>
        <thead>
            <tr>
                <th>Código producto</th>
                <th>Nombre producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
let total = 0;

document.getElementById('search').addEventListener('input', function () {
    const query = this.value;
    const resultsContainer = document.getElementById('search-results');

    if (query.length === 0) {
        resultsContainer.innerHTML = '';
        return;
    }

    axios.get('{{ route('productos.buscar') }}', { params: { q: query } })
        .then(response => {
            const productos = response.data;
            resultsContainer.innerHTML = '';

            if (productos.length === 0) {
                resultsContainer.innerHTML = '<p>No se encontraron productos.</p>';
                return;
            }

            productos.forEach(producto => {
                const item = document.createElement('div');
                item.className = 'result-item';
                item.textContent = `${producto.descripcion} - $${producto.precio_venta}`;
                item.dataset.id = producto.id_producto;
                item.dataset.precio = producto.precio_venta;

                item.addEventListener('dblclick', function () {
                    agregarProductoATabla(
                        producto.id_producto,
                        producto.descripcion,
                        parseFloat(producto.precio_venta)
                    );
                    resultsContainer.innerHTML = '';
                    document.getElementById('search').value = '';
                });

                resultsContainer.appendChild(item);
            });
        })
        .catch(error => console.error('Error al buscar productos:', error));
});

function agregarProductoATabla(id, descripcion, precio) {
    const cantidad = 1; // Por defecto, siempre intentamos agregar 1

    // Verificar stock antes de agregar
    axios.post('{{ route('ventas.verificarStock') }}', {
        producto_id: id,
        cantidad: cantidad,
    })
    .then(response => {
        if (response.data.success) {
            const tabla = document.querySelector('table tbody');
            let fila = [...tabla.children].find(row => row.children[0].textContent === id.toString());

            if (fila) {
                // Incrementar cantidad si la fila ya existe
                const cantidadElem = fila.querySelector('.cantidad');
                const cantidadActual = parseInt(cantidadElem.textContent);
                const nuevaCantidad = cantidadActual + cantidad;

                // Validar stock nuevamente antes de incrementar
                axios.post('{{ route('ventas.verificarStock') }}', {
                    producto_id: id,
                    cantidad: nuevaCantidad,
                })
                .then(stockResponse => {
                    if (stockResponse.data.success) {
                        cantidadElem.textContent = nuevaCantidad;
                        total += precio;
                        actualizarTotal();
                    } else {
                        alert(stockResponse.data.message);
                    }
                })
                .catch(error => {
                    console.error('Error al verificar stock dinámico:', error);
                    alert('!UPSS!, Parece que el stock del inventario es insuficiente.');
                });
            } else {
                // Crear nueva fila si no existe
                fila = document.createElement('tr');
                fila.innerHTML = `
                    <td>${id}</td>
                    <td>${descripcion}</td>
                    <td class="cantidad">${cantidad}</td>
                    <td class="precio">$${precio.toFixed(2)}</td>
                    <td>

                        <button class="bajar-producto">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#ff5555" viewBox="0 0 24 24" class="size-6">
                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm3 10.5a.75.75 0 0 0 0-1.5H9a.75.75 0 0 0 0 1.5h6Z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <button class="subir-producto">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#50fa7b" viewBox="0 0 24 24" class="size-6">
                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <button class="eliminar-producto">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#ff5555" viewBox="0 0 24 24" class="size-6">
                                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                            </svg>
                        </button>

                    </td>
                `;

                // Agregar fila a la tabla
                tabla.appendChild(fila);

                // Asociar eventos a los botones
                fila.querySelector('.bajar-producto').addEventListener('click', () => {
                    modificarCantidad(id, -1, precio, fila);
                });

                fila.querySelector('.subir-producto').addEventListener('click', () => {
                    modificarCantidad(id, 1, precio, fila);
                });

                fila.querySelector('.eliminar-producto').addEventListener('click', () => {
                    eliminarProducto(fila, precio);
                });

                // Actualizar el total
                total += precio;
                actualizarTotal();
            }
        } else {
            alert(response.data.message);
        }
    })
    .catch(error => {
        console.error('!UPSS!, Parece que el stock del inventario es insuficiente.', error);
        alert('!UPSS!, Parece que el stock del inventario es insuficiente.');
    });
}

function modificarCantidad(id, cambio, precio, fila) {
    const cantidadElem = fila.querySelector('.cantidad');
    const cantidadActual = parseInt(cantidadElem.textContent);
    const nuevaCantidad = cantidadActual + cambio;

    if (nuevaCantidad <= 0) {
        eliminarProducto(fila, precio);
        return;
    }

    // Validar stock dinámico antes de modificar la cantidad
    axios.post('{{ route('ventas.verificarStock') }}', {
        producto_id: id,
        cantidad: nuevaCantidad,
    })
    .then(response => {
        if (response.data.success) {
            cantidadElem.textContent = nuevaCantidad;
            recalcularTotal();
        } else {
            alert(response.data.message);
        }
    })
    .catch(error => {
        console.error('Error al modificar cantidad:', error);
        alert('!UPSS!, Parece que el stock del inventario es insuficiente.');
    });
}

function eliminarProducto(fila, precio) {
    fila.remove();
    recalcularTotal();
}

function recalcularTotal() {
    const tabla = document.querySelector('table tbody');
    total = 0;

    [...tabla.children].forEach(row => {
        const cantidad = parseInt(row.querySelector('.cantidad').textContent);
        const precio = parseFloat(row.querySelector('.precio').textContent.replace('$', ''));
        total += cantidad * precio;
    });

    actualizarTotal();
}

function actualizarTotal() {
    document.querySelector('.total span').textContent = `Total: $${total.toFixed(2)} MX`;
}


function eliminarProducto(fila, precio) {
    const cantidad = parseInt(fila.querySelector('.cantidad').textContent);
    total -= precio * cantidad;
    fila.remove();

    const tabla = document.querySelector('table tbody');
    if (tabla.children.length === 0) {
        total = 0; 
    }

    actualizarTotal();
}


function actualizarTotal() {
    document.querySelector('.total span').textContent = `Total: $${total.toFixed(2)} MX`;
}


function actualizarCantidad(fila, cambio, precio) {
    const cantidadElem = fila.querySelector('.cantidad');
    let cantidad = parseInt(cantidadElem.textContent);

    // Calcular la nueva cantidad
    const nuevaCantidad = cantidad + cambio;

    if (nuevaCantidad <= 0) {
        // Si la cantidad llega a 0 o menos, eliminar el producto
        eliminarProducto(fila, precio);
    } else {
        // Verificar stock dinámico
        const productoId = fila.children[0].textContent; // Suponiendo que el ID está en la primera celda
        axios.post('{{ route('ventas.verificarStock') }}', {
            producto_id: productoId,
            cantidad: nuevaCantidad,
        })
        .then(response => {
            if (response.data.success) {
                // Actualizar cantidad y total si hay suficiente stock
                cantidadElem.textContent = nuevaCantidad;
                total += cambio * precio;
                actualizarTotal();
            } else {
                // Mostrar alerta si no hay suficiente stock
                alert(response.data.message);
            }
        })
        .catch(error => {
            console.error('Error al verificar stock:', error);
            alert('!UPSS!, Parece que el stock del inventario es insuficiente.');
        });
    }
}


function eliminarProducto(fila, precio) {
    const cantidad = parseInt(fila.querySelector('.cantidad').textContent);
    total -= precio * cantidad;
    fila.remove();

    // Verificar si la tabla está vacía
    const tabla = document.querySelector('table tbody');
    if (tabla.children.length === 0) {
        total = 0; // Reiniciar el total
    }

    actualizarTotal();
}


function actualizarTotal() {
    document.querySelector('.total span').textContent = `Total: $${total.toFixed(2)} MX`;
}
</script>
@endsection
