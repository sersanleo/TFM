@extends('layouts.layout')

@section('content')
    <div class="row g-3 justify-content-center align-items-center">
        @if (Auth::user()->is_staff)
            <div class="col-12 d-flex gap-2">
                <a class="btn btn-primary" href="{{ route('pet.create') }}">
                    Crear mascota
                </a>
            </div>
        @endif
        <div class="col-12">
            <div class="card table-responsive shadow">
                <table class="m-0 table table-striped table-borderless table-hover">
                    <thead>
                        <tr>
                            @if (Auth::user()->is_staff)
                                <th></th>
                            @endif
                            <th>Dueño</th>
                            <th>Nombre</th>
                            <th class="text-center">Estado</th>
                            <th>Raza</th>
                            <th class="text-center">Sexo</th>
                            <th>Fecha de nacimiento</th>
                        </tr>
                    </thead>
                    <tbody class=" align-middle text-nowrap">
                        @foreach ($pets as $pet)
                            <tr>
                                @if (Auth::user()->is_staff)
                                    <td class="shrink">
                                        <div class="d-flex gap-3">
                                            <a href="{{ route('pet.edit', $pet) }}" class="p-0 btn btn-link">
                                                <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                            </a>
                                            <form action="{{ route('pet.delete') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="pet" value="{{ $pet->id }}" />
                                                <button type="submit" class="p-0 btn btn-link">
                                                    <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                                <td>{{ $pet->owner }}</td>
                                <td>{{ $pet->name }}</td>
                                <td class="text-center">
                                    @if ($pet->deceased)
                                        <i class="fas fa-skull text-danger"></i>
                                    @else
                                        <i class="fas fa-smile text-success"></i>
                                    @endif
                                </td>
                                <td>{{ $pet->race }}</td>
                                <td class="text-center">
                                    @if ($pet->sex == 'F')
                                        <i class="fas fa-venus"></i>
                                    @elseif($pet->sex == 'M')
                                        <i class="fas fa-mars"></i>
                                    @endif
                                </td>
                                <td>
                                    @if ($pet->birthday)
                                        {{ $pet->birthday->format('d/m/Y') }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12 text-center">
            {{ $pets->links('components.pagination') }}
        </div>
    </div>
@endsection
