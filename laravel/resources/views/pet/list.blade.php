@extends('layouts.layout')

@section('content')
    <div class="row g-3 justify-content-center align-items-center">
        @if (true)
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
                            @if (true)
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
                                @if (true)
                                    <td></td>
                                @endif
                                <td></td>
                                <td>{{ $pet->name }}</td>
                                <td class="text-center">Estado</td>
                                <td>{{ $pet->race }}</td>
                                <td class="text-center">{{ $pet->sex }}</td>
                                <td>{{ $pet->birthday }}</td>
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
