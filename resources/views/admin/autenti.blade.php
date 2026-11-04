@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Verificación de Seguridad (Admin)') }}</div>

                <div class="card-body">
                    <p class="text-muted text-center">
                        Hemos enviado un código de verificación a tu correo electrónico. Por favor ingrésalo para continuar.
                    </p>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.verificar') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="two_factor_code" class="form-label">Código de Verificación</label>
                            <input id="two_factor_code" type="text" 
                                   class="form-control text-center @error('two_factor_code') is-invalid @enderror" 
                                   name="two_factor_code" required autofocus maxlength="6" style="font-size: 1.5rem; letter-spacing: 5px;">

                            @error('two_factor_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Verificar Código') }}
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <form method="POST" action="{{ route('admin.reenviar') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                                ¿No recibiste el código? Reenviar código
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection