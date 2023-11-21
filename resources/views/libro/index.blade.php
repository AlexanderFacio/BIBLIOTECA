@extends('layouts.app')

@section('template_title')
    Libro
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span id="card_title" class="h4">
                                {{ __('LIBROS') }}
                            </span>
                            @can('libro.create')
                            <div class="float-right">
                                <a href="{{ route('libros.pdf') }}" class="btn btn-primary btn-sm" data-placement="left">
                                    {{ __('PDF') }}
                                </a>
                            @endcan
                            @can('libro.create')
                                <a href="{{ route('libros.create') }}" class="btn btn-primary btn-sm" data-placement="left">
                                    {{ __('NUEVO') }}
                                </a>
                            @endcan
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <form action="{{ route('libros.index') }}" method="GET" class="input-group">
                                    <input type="text" class="form-control" id="busqueda" name="busqueda" placeholder="Buscar por nombre" aria-label="Buscar por nombre">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Buscar por nombre</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-6">
                                <form action="{{ route('libros.index') }}" method="GET" class="input-group">
                                    <div class="form-group mx-sm-6 mb-2">
                                        <select class="form-control" id="categoria" name="categoria" placeholder="Categoría">
                                            <option value="" selected>Seleccione una Categoría</option>
                                            @foreach ($categorias as $id => $nombre)
                                                <option value="{{ $id }}">{{ $nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Buscar por categoría</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Categoría</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($libros as $libro)
                                        <tr>
                                            <td>{{ $libro->categoria->nombre }}</td>
                                            <td>{{ $libro->nombre }}</td>
                                            <td>{{ $libro->descripcion }}</td>
                                            <td>
                                                <form action="{{ route('libros.destroy', $libro->id) }}" method="POST">
                                                    <a class="btn btn-info btn-sm" href="{{ route('libros.show', $libro->id) }}">
                                                        <i class="fa fa-eye"></i> {{ __('CONSULTAR') }}
                                                    </a>
                                                    @can('libro.edit')
                                                    <a class="btn btn-warning btn-sm" href="{{ route('libros.edit', $libro->id) }}">
                                                        <i class="fa fa-edit"></i> {{ __('EDITAR') }}
                                                    </a>
                                                    @endcan
                                                    @can('libro.destroy')
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este libro?')">
                                                        <i class="fa fa-trash"></i> {{ __('ELIMINAR') }}
                                                    </button>
                                                    @endcan
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">No se encontraron resultados.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $libros->links() !!}
            </div>
        </div>
    </div>
@endsection
