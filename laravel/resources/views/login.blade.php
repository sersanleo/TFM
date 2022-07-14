@extends('layouts.layout')

@section('content')
<div class="row justify-content-center align-items-center">
    <div class="col-12 col-sm-10 col-md-7 col-xl-5 col-xxl-4">
        <div class="card shadow">
            <div class="card-body text-center">
                <div class="d-flex flex-column gap-3">
                    <div class="form-floating">
                        <input id="email" type="email" class="form-control" autocomplete="username"
                            placeholder="Correo electrónico" required />
                        <label for="email">Correo electrónico</label>
                    </div>
                    <div class="form-floating">
                        <input id="password" type="password" class="form-control" autocomplete="current-password"
                            placeholder="Contraseña" required />
                        <label for="password">Contraseña</label>
                    </div>
                    <input type="submit" class="btn btn-primary btn-lg" value="Iniciar sesión" />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
