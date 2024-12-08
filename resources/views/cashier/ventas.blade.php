@extends('layouts.app')

@section('titulo', 'Ventas')

@section('estilos')
    @vite(['resources/css/ventas.css'])
@endsection

@section('contenido')
<div class="custom-container">
        <h1>Ventas</h1>
        <div class="custom-search-bar">
            <input type="text" placeholder="Código de producto o nombre de producto">
            <button>Agregar producto</button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Buscar</button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Generar Corte</button>
        </div>
        <div class="custom-payment-buttons">
            <button class="custom-cash">
                EFECTIVO
                <i class="fas fa-money-bill-wave"></i>
            </button>
            <button class="custom-card">
                TARJETA
                <i class="fas fa-credit-card"></i>
            </button>
        </div>
    </div>

    <!--TABLA-->
    <div class="tabla">
        <div class="total">
            <span>Total: $ 1,234.00 MX</span>
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
            <tbody>
                <tr>
                    <td>645353</td>
                    <td>Pantalón Jeans</td>
                    <td>3</td>
                    <td>$ 175.00</td>
                    <td class="actions">
                        <button><i class="fas fa-minus-circle"></i></button>
                        <button><i class="fas fa-plus-circle"></i></button>
                        <button><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>645353</td>
                    <td>Pantalón Jeans</td>
                    <td>3</td>
                    <td>$ 175.00</td>
                    <td class="actions">
                        <button><i class="fas fa-minus-circle"></i></button>
                        <button><i class="fas fa-plus-circle"></i></button>
                        <button><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>645353</td>
                    <td>Pantalón Jeans</td>
                    <td>3</td>
                    <td>$ 175.00</td>
                    <td class="actions">
                        <button><i class="fas fa-minus-circle"></i></button>
                        <button><i class="fas fa-plus-circle"></i></button>
                        <button><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection