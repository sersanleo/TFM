@extends('layouts.layout')

@section('content')
    <div class="row g-3 justify-content-center align-items-center">
        <div class="col-12 col-md-8 col-xl-6">
            <form class="card shadow" method="post">
                @csrf
                <div class="card-body text-center">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-floating">
                                <select class="form-select" id="race" required>
                                    <option selected>---------</option>
                                    @foreach ($races as $race)
                                        {{ $race }}
                                        <option value="{{ $race->id }}">{{ $race }}</option>
                                    @endforeach
                                </select>
                                <label for="race">Raza</label>
                            </div>
                            @error('race')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
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
                            <input type="submit" class="btn btn-primary btn-lg" value="Guardar cambios" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
