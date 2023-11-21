@extends('layouts.app')

@section('content')
<section class="vh-100" style="background-color: #9A616D; display: flex; align-items: center; justify-content: center;">
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col col-xl-8">
                <div class="card" style="border-radius: 1rem; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                    <div class="card-header text-center" style="background-color: #F3EFEF; border-radius: 1rem 1rem 0 0;">
                        <h2 style="color: #4B0082;">¡BIENVENIDO A NUESTRA BIBLIOTECA!</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <img src="https://i.pinimg.com/originals/9f/c1/41/9fc141cbcaf1ad42647d4ab83a1186ba.jpg"
                                alt="library" class="img-fluid" style="border-radius: 1rem 0 0 1rem;">
                        </div>
                        <div class="col-md-6 text-center">
                            <div class="card-body">
                                @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <p class="md-3" style="font-size: 2.5em; font-weight: bold; color: #4B0082;">
                                    {{ __('"El misterio de la vida no es un problema a resolver, sino una realidad a experimentar."') }}
                                    <br>
                                    - Frank Herbert
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center" style="background-color: #D8BFD8; border-radius: 0 0 1rem 1rem; padding: 10px;">
                        <a href="{{ route('libros.index') }}" class="btn btn-primary btn-lg">{{ __('Explora Nuestros Libros') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
