@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Row de Cards -->
    <div class="row mb-4">
        <!-- Card de Proveedores -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 rounded">
                <div class="card-header">
                    <h5><i class="fa-solid fa-truck"></i> Proveedores <span class="badge bg-secondary">{{ $proveedoresCount }}</span></h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Gestiona tus proveedores y consulta sus datos de forma fácil.</p>
                    <a href="{{ route('proveedores.index') }}" class="btn btn-outline-primary btn-block">Ir a Proveedores</a>
                </div>
            </div>
        </div>

        <!-- Card de Productos -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 rounded">
                <div class="card-header">
                    <h5><i class="fa-solid fa-boxes-stacked"></i> Productos <span class="badge bg-secondary">{{ $productosCount }}</span></h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Administra tus productos, actualiza y visualiza tu inventario.</p>
                    <a href="{{ route('productos.index') }}" class="btn btn-outline-success btn-block">Ir a Productos</a>
                </div>
            </div>
        </div>

        <!-- Card de Órdenes de Compra -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 rounded">
                <div class="card-header">
                    <h5><i class="fa-solid fa-file-invoice"></i> Órdenes de Compra <span class="badge bg-secondary">{{ $ordenesPendientesCount }}</span></h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Consulta, realiza y gestiona las órdenes de compra.</p>
                    <a href="{{ route('ordencompras.index') }}" class="btn btn-outline-warning btn-block">Ver Órdenes</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Card de Clientes -->
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm border-0 rounded">
                <div class="card-header">
                    <h5><i class="fa-solid fa-users"></i> Clientes <span class="badge bg-secondary">{{ $clientesCount }}</span></h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Accede y gestiona toda la información de tus clientes.</p>
                    <a href="{{ route('clientes.index') }}" class="btn btn-outline-info btn-block">Ir a Clientes</a>
                </div>
            </div>
        </div>

        <!-- Card de Ventas -->
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm border-0 rounded">
                <div class="card-header">
                    <h5><i class="fa-solid fa-cash-register"></i> Ventas <span class="badge bg-secondary">{{ $ventasCount }}</span></h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Consulta las ventas realizadas y gestiona las transacciones.</p>
                    <a href="{{ route('ventas.index') }}" class="btn btn-outline-danger btn-block">Ir a Ventas</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Estilos personalizados usando solo Bootstrap -->
<style>
    /* Card más largas en dispositivos pequeños */
    .card {
        height: 100%;
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    /* Asegurando que las tarjetas estén bien distribuidas en pantallas pequeñas */
    @media (max-width: 768px) {
        .col-md-4 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .col-md-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }

    @media (max-width: 576px) {
        .col-md-4,
        .col-md-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>

@endsection
