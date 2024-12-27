@extends('layouts.app')

@section('template_title')
    Detalles de la Orden de Compra
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow-lg border-primary">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <span id="card_title">
                            <i class="fa fa-file-alt"></i> {{ __('Detalle de Orden de Compra') }}
                        </span>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success m-4 alert-dismissible fade show" role="alert">
                        <i class="fa fa-check-circle"></i> {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Orden</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Cantidad Recibida</th>
                                    <th>Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detalleOrdenCompras as $detalle)
                                    <tr>
                                        <td>{{ $detalle->ordencompra->clave_orden ?? 'Sin Orden' }}</td>
                                        <td>{{ $detalle->producto->descripcion ?? 'Sin Producto' }}</td>
                                        <td>{{ $detalle->cantidad }}</td>
                                        <td>{{ $detalle->cantidad_recibida }}</td>
                                        <td>{{ $detalle->total }}</td>
                                        <td>
                                            <!-- Botón para abrir el modal de editar cantidad recibida -->
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editarCantidadModal{{ $detalle->id }}">
                                                <i class="fa fa-edit"></i> {{ __('Ver Orden') }}
                                            </button>

                                            <!-- Modal para editar cantidad recibida -->
                                            <div class="modal fade" id="editarCantidadModal{{ $detalle->id }}" tabindex="-1" aria-labelledby="editarCantidadModalLabel{{ $detalle->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editarCantidadModalLabel{{ $detalle->id }}">Editar Cantidad Recibida</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('detalleordencompras.actualizarCantidadRecibida', $detalle->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="cantidad_recibida" class="form-label">Cantidad Recibida</label>
                                                                    <input type="number" class="form-control" name="cantidad_recibida" min="1" max="{{ $detalle->cantidad }}" value="{{ $detalle->cantidad_recibida }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn btn-success">Actualizar Cantidad</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Formulario para finalizar la orden -->
                                            <form action="{{ route('detalleordencompras.finalizarOrden', $detalle->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success btn-sm mt-2" {{ $detalle->estado == 'finalizado' ? 'disabled' : '' }}>
                                                    Finalizar Detalle
                                                </button>
                                            </form>

                                            <!-- Formulario para eliminar la orden (solo si está finalizada) -->
                                            @if ($detalle->ordencompra->estado == 'finalizado')
                                                <form action="{{ route('detalleordencompras.eliminarOrden', $detalle->ordencompra->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm mt-2">
                                                        Eliminar Orden
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {!! $detalleOrdenCompras->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
