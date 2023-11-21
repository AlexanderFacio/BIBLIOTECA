@extends('layouts.app')

@section('content')
<section class="vh-100" style="background-color: #9A616D;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-10">
                <div class="card" style="border-radius: 1rem; background-color: #F3EFEF; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <div class="card-header text-center" style="background-color: #D8BFD8; border-radius: 1rem 1rem 0 0; padding: 20px;">
                        <h2 class="mb-0" style="color: #4B0082;">{{ __('¡BIENVENIDO A LA BIBLIOTECA!') }}</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-6 d-flex justify-content-center align-items-center" style="height: 100%;">
                            <img src="https://i.pinimg.com/originals/81/f9/28/81f9285872f712f142fb8a0b1f767baf.jpg"
                                alt="library" class="img-fluid" style="border-radius: 1rem 0 0 1rem; max-width: 400px; box-shadow: 4px 0 8px rgba(0, 0, 0, 0.1);" />
                        </div>
                        <div class="col-md-6 text-center">
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <p class="md-3 "  style="font-size: 3.0em; font-weight: bold; color: #4B0082;">
                                    {{ __('"Un lector vive mil vidas antes de morir. Aquel que nunca lee vive solo una vez."') }}
                                    <br>
                                    - George R.R. Martin
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
