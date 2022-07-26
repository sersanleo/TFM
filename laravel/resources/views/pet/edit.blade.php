@extends('layouts.layout')

@section('content')
    <div class="row g-3 justify-content-center align-items-center">
        <div class="col-12 col-md-8 col-xl-6">
            <form class="card shadow" method="post">
                @csrf
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-floating">
                                <select name="owner_id"class="form-select @error('owner_id') is-invalid @enderror"
                                    id="owner_id" required>
                                    <option value="">---------</option>
                                    @foreach (App\Models\User::all() as $user)
                                        <option value="{{ $user->id }}"
                                            {{ (isset($pet) ? $pet->owner_id : old('owner_id')) == $user->id ? 'selected' : '' }}>
                                            {{ $user }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="owner_id">Dueño</label>
                            </div>
                            @error('owner_id')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input id="name" name="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ isset($pet) ? $pet->name : old('name') }}" autocomplete="given-name"
                                    placeholder="Nombre" required />
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
                                <select name="race_id"class="form-select @error('race_id') is-invalid @enderror"
                                    id="race_id">
                                    <option value="">---------</option>
                                    @foreach (App\Models\PetRace::all() as $race)
                                        <option value="{{ $race->id }}"
                                            {{ (isset($pet) ? $pet->race_id : old('race_id')) == $race->id ? 'selected' : '' }}>
                                            {{ $race }}</option>
                                    @endforeach
                                </select>
                                <label for="race_id">Raza</label>
                            </div>
                            @error('race_id')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <select name="sex" class="form-select @error('sex') is-invalid @enderror"
                                    placeholder="Sexo" id="sex">
                                    <option value="">---------</option>
                                    <option value="F"
                                        {{ (isset($pet) ? $pet->sex : old('sex')) == 'F' ? 'selected' : '' }}>
                                        Hembra
                                    </option>
                                    <option value="M"
                                        {{ (isset($pet) ? $pet->sex : old('sex')) == 'M' ? 'selected' : '' }}>
                                        Macho
                                    </option>
                                </select>
                                <label for="sex">Sexo</label>
                            </div>
                            @error('sex')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input id="birthday" name="birthday" type="date"
                                    class="form-control @error('birthday') is-invalid @enderror" autocomplete="bday"
                                    value="{{ isset($pet) ? $pet->birthday : old('birthday') }}"
                                    placeholder="Fecha de nacimiento" />
                                <label for="birthday">Fecha de nacimiento</label>
                            </div>
                            @error('birthday')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea name="annotations" style="height:7rem" class="form-control @error('annotations') is-invalid @enderror"
                                    placeholder="Anotaciones" id="annotations">{{ isset($pet) ? $pet->annotations : old('annotations') }}</textarea>
                                <label for="annotations">Anotaciones</label>
                            </div>
                            @error('annotations')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="deceased"
                                    class="form-check-input @error('deceased') is-invalid @enderror"
                                    placeholder="¿Ha fallecido?" id="deceased"
                                    {{ (isset($pet) ? $pet->deceased : old('deceased')) == 'on' ? 'checked' : '' }}>
                                <label class="form-check-label" for="deceased">
                                    ¿Ha fallecido?
                                </label>
                            </div>
                            @error('deceased')
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
