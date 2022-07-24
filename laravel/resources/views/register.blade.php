@extends('layouts.layout')

@section('content')
    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-lg-7">
            <form class="card shadow" method="post">
                @csrf
                <div class="card-body text-center">
                    <div class="row g-3">
                        <div class="col-12">
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
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input id="password" name="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" autocomplete="new-password"
                                    placeholder="Contraseña" required />
                                <label for="password">Contraseña</label>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input id="password_confirmation" name="password_confirmation" type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    autocomplete="new-password" placeholder="Repita la contraseña" required />
                                <label for="password_confirmation">Repita la contraseña</label>
                            </div>
                            @error('password_confirmation')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-5">
                            <div class="form-floating">
                                <input id="first_name" name="first_name" type="text"
                                    class="form-control @error('first_name') is-invalid @enderror"
                                    value="{{ old('first_name') }}"autocomplete="given-name" placeholder="Nombre"
                                    required />
                                <label for="first_name">Nombre</label>
                            </div>
                            @error('first_name')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-7">
                            <div class="form-floating">
                                <input id="last_name" name="last_name" type="text"
                                    class="form-control @error('last_name') is-invalid @enderror"value="{{ old('last_name') }}"
                                    autocomplete="family-name" placeholder="Apellidos" required />
                                <label for="last_name">Apellidos</label>
                            </div>
                            @error('last_name')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input id="address" name="address" type="text"
                                    class="form-control @error('address') is-invalid @enderror"
                                    placeholder="Dirección"value="{{ old('address') }}" required />
                                <label for="birthday">Dirección</label>
                            </div>
                            @error('address')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input id="birthday" name="birthday" type="date"
                                    class="form-control @error('birthday') is-invalid @enderror"
                                    autocomplete="bday"value="{{ old('birthday') }}" placeholder="Fecha de nacimiento"
                                    required />
                                <label for="birthday">Fecha de nacimiento</label>
                            </div>
                            @error('birthday')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 d-grid">
                            <input type="submit" class="btn btn-primary btn-lg" value="Registrarme" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
