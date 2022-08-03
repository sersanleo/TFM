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
                                <select name="pet_id" class="form-select @error('pet_id') is-invalid @enderror"
                                    id="pet_id" required>
                                    <option value="">---------</option>
                                    @foreach (App\Models\Pet::visibleBy(Auth::user())->orderBy('name')->get() as $pet)
                                        <option value="{{ $pet->id }}"
                                            {{ old('pet_id', $appointment?->pet_id) == $pet->id ? 'selected' : '' }}>
                                            {{ $pet }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="pet_id">Mascota</label>
                            </div>
                            @error('pet_id')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <select name="vet_id" class="form-select @error('vet_id') is-invalid @enderror"
                                    id="vet_id" required>
                                    <option value="">---------</option>
                                    @foreach (App\Models\User::where('is_staff', true)->orderBy('first_name')->orderBy('last_name')->get() as $vet)
                                        <option value="{{ $vet->id }}"
                                            {{ old('vet_id', $appointment?->vet_id) == $vet->id ? 'selected' : '' }}>
                                            {{ $vet }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="vet_id">Veterinario</label>
                            </div>
                            @error('vet_id')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="datetime-local" name="date" class="form-control" placeholder="Fecha y hora"
                                    value="{{ old('date', $appointment?->date) }}" required id="id_date">
                                <label for="id_date">Fecha y hora</label>
                            </div>
                            @error('date')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea name="annotations" style="height:7rem" class="form-control @error('annotations') is-invalid @enderror"
                                    placeholder="Anotaciones" id="annotations">{{ old('annotations', $appointment?->annotations) }}</textarea>
                                <label for="annotations">Anotaciones</label>
                            </div>
                            @error('annotations')
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
