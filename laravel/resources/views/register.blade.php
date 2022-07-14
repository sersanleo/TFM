@extends('layouts.layout')

@section('content')
<div class="row justify-content-center align-items-center">
    <div class="col-12 col-lg-7">
        <div class="card shadow">
            <div class="card-body text-center">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-floating">
                            <input id="email" name="email" type="email" class="form-control" autocomplete="email"
                                placeholder="Correo electrónico" required />
                            <label for="email">Correo electrónico</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input id="password" name="password" type="password" class="form-control"
                                autocomplete="new-password" placeholder="Contraseña" required />
                            <label for="password">Contraseña</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input id="repeat-password" name="repeat-password" type="password" class="form-control"
                                autocomplete="new-password" placeholder="Contraseña" required />
                            <label for="repeat-password">Repita la contraseña</label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-5">
                        <div class="form-floating">
                            <input id="name" name="name" type="text" class="form-control" autocomplete="given-name"
                                placeholder="Nombre" required />
                            <label for="name">Nombre</label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-7">
                        <div class="form-floating">
                            <input id="surname" name="surname" type="text" class="form-control"
                                autocomplete="family-name" placeholder="Apellidos" required />
                            <label for="surname">Apellidos</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input id="address" name="address" type="text" class="form-control" placeholder="Dirección"
                                required />
                            <label for="birthday">Dirección</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input id="birthday" name="birthday" type="date" class="form-control" autocomplete="bday"
                                placeholder="Fecha de nacimiento" required />
                            <label for="birthday">Fecha de nacimiento</label>
                        </div>
                    </div>
                    <div class="col-12 d-grid">
                        <input type="submit" class="btn btn-primary btn-lg" value="Registrarme" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
