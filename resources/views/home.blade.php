@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Row de Cards -->
    <div class="row mb-4">
        <!-- Card de Proveedores -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-lg border-0 rounded-lg hover-shadow">
                <div class="card-header bg-gradient-primary text-white">
                    <h5><i class="fa-solid fa-truck"></i> Proveedores</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Gestiona tus proveedores y consulta sus datos de forma fácil.</p>
                    <a href="{{ route('proveedores.index') }}" class="btn btn-outline-light btn-block shadow-sm transition-all">Ir a Proveedores</a>
                </div>
            </div>
        </div>

        <!-- Card de Productos -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-lg border-0 rounded-lg hover-shadow">
                <div class="card-header bg-gradient-success text-white">
                    <h5><i class="fa-solid fa-boxes-stacked"></i> Productos</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Administra tus productos, actualiza y visualiza tu inventario.</p>
                    <a href="{{ route('productos.index') }}" class="btn btn-outline-light btn-block shadow-sm transition-all">Ir a Productos</a>
                </div>
            </div>
        </div>

        <!-- Card de Órdenes de Compra -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-lg border-0 rounded-lg hover-shadow">
                <div class="card-header bg-gradient-warning text-white">
                    <h5><i class="fa-solid fa-file-invoice"></i> Órdenes de Compra</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Consulta, realiza y gestiona las órdenes de compra.</p>
                    <a href="{{ route('ordencompras.index') }}" class="btn btn-outline-light btn-block shadow-sm transition-all">Ver Órdenes</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Card de Clientes -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-lg border-0 rounded-lg hover-shadow">
                <div class="card-header bg-gradient-info text-white">
                    <h5><i class="fa-solid fa-users"></i> Clientes</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Accede y gestiona toda la información de tus clientes.</p>
                    <a href="{{ route('clientes.index') }}" class="btn btn-outline-light btn-block shadow-sm transition-all">Ir a Clientes</a>
                </div>
            </div>
        </div>

        <!-- Card de Ventas -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-lg border-0 rounded-lg hover-shadow">
                <div class="card-header bg-gradient-danger text-white">
                    <h5><i class="fa-solid fa-cash-register"></i> Ventas</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Consulta las ventas realizadas y gestiona las transacciones.</p>
                    <a href="{{ route('ventas.index') }}" class="btn btn-outline-light btn-block shadow-sm transition-all">Ir a Ventas</a>
                </div>
            </div>
        </div>

        <!-- Card de Estadísticas -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-lg border-0 rounded-lg hover-shadow">
                <div class="card-header bg-gradient-dark text-white">
                    <h5><i class="fa-solid fa-chart-line"></i> Estadísticas</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Visualiza estadísticas clave para mejorar tus decisiones empresariales.</p>
                    <a href="" class="btn btn-outline-light btn-block shadow-sm transition-all">Ver Estadísticas</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Gradientes de fondo */
    .bg-gradient-primary {
        background: linear-gradient(to right, #007bff, #00c6ff);
    }

    .bg-gradient-success {
        background: linear-gradient(to right, #28a745, #00d700);
    }

    .bg-gradient-warning {
        background: linear-gradient(to right, #ffc107, #ff5722);
    }

    .bg-gradient-info {
        background: linear-gradient(to right, #17a2b8, #00bcd4);
    }

    .bg-gradient-danger {
        background: linear-gradient(to right, #dc3545, #ff1744);
    }

    .bg-gradient-dark {
        background: linear-gradient(to right, #343a40, #212529);
    }

    /* Efectos hover en las tarjetas */
    .hover-shadow:hover {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* Transición en botones */
    .transition-all {
        transition: all 0.3s ease;
    }

    .transition-all:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    /* Estilo para los botones */
    .btn-outline-light {
        border-color: white;
        color: white;
    }

    .btn-outline-light:hover {
        background-color: white;
        color: #343a40;
    }

    /* Footer */
    footer {
        position: relative;
        bottom: 0;
        width: 100%;
    }

    /* Navbar fijo */
    nav.fixed-top {
        z-index: 1030;
    }

    /* Diseño compactado */
    .container-fluid {
        padding: 30px 15px;
    }

    /* Mejorando la alineación y espaciado de las tarjetas */
    .card {
        border-radius: 15px;
    }

    .card-header {
        font-size: 1.25rem;
        font-weight: bold;
    }

    .card-body {
        text-align: center;
    }
</style>

@endsection
