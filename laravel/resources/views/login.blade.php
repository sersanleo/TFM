@extends('layouts.layout')

@section('content')
    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-sm-10 col-md-7 col-xl-5 col-xxl-4">
            <form method="post" class="card shadow">
                @csrf
                <div class="card-body text-center">
                    <div class="d-flex flex-column gap-3">
                        <div class="form-floating">
                            <input id="email" name="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" autocomplete="email"
                                placeholder="Correo electrónico" value="{{ old('email') }}" required />
                            <label for="email">Correo electrónico</label>
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-floating">
                            <input id="password" name="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" autocomplete="current-password"
                                placeholder="Contraseña" required />
                            <label for="password">Contraseña</label>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="submit" class="btn btn-primary btn-lg" value="Iniciar sesión" />
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
