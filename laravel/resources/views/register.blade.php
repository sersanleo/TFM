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
                                <input id="name" name="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}"autocomplete="given-name" placeholder="Nombre" required />
                                <label for="name">Nombre</label>
                            </div>
                            @error('name')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-7">
                            <div class="form-floating">
                                <input id="surname" name="surname" type="text"
                                    class="form-control @error('surname') is-invalid @enderror"value="{{ old('surname') }}"
                                    autocomplete="family-name" placeholder="Apellidos" required />
                                <label for="surname">Apellidos</label>
                            </div>
                            @error('surname')
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
        </div>
    </div>
    </div>
@endsection
