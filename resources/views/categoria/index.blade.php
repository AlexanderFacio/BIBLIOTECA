@extends('layouts.app')

@section('template_title')
    CATEGORIAS
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('CATEGORIAS') }}
                            </span>
                            @can('categoria.create')
                             <div class="float-right">
                                <a href="{{ route('categorias.create') }}" class="btn btn-primary btn-sm"  data-placement="left">
                                  {{ __('NUEVO') }}
                                </a>
                              </div>    
                              @endcan
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="mb-3">
                            <form action="{{ route('categorias.index') }}" method="GET" class="form-inline">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="busqueda" name="busqueda" placeholder="Buscar por nombre" aria-label="Buscar por nombre">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Buscar</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                        
                        @if(isset($busqueda))
                            <p>Resultados para: <strong>{{ $busqueda }}</strong></p>
                        @endif
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categorias as $categoria)
                                        <tr>
                                            <td>{{ $categoria->nombre }}</td>
                                            <td>
                                                <form action="{{ route('categorias.destroy',$categoria->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-info" href="{{ route('categorias.show',$categoria->id) }}">
                                                        <i class="fa fa-eye"></i> {{ __('CONSULTAR') }}
                                                    </a>

                                                    @can('categoria.edit')
                                                    <a class="btn btn-sm btn-warning" href="{{ route('categorias.edit',$categoria->id) }}">
                                                        <i class="fa fa-edit"></i> {{ __('EDITAR') }}
                                                    </a>
                                                    @endcan
                                                    @csrf
                                                    @can('categoria.destroy')
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este libro?')">
                                                        <i class="fa fa-trash"></i> {{ __('ELIMINAR') }}
                                                    </button>
                                                    @endcan
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $categorias->links() !!}
            </div>
        </div>
    </div>
@endsection
