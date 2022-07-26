@extends('layouts.layout')

@section('content')
    <div class="row g-3 justify-content-center align-items-center">
        <div class="col-12 d-flex gap-2">
            <a class="btn btn-primary" href="{{ route('appointment.create') }}">
                Pedir cita
            </a>
        </div>
        <div class="col-12">
            <div class="card table-responsive shadow">
                <table class="m-0 table table-striped table-borderless table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Mascota</th>
                            <th>Veterinario</th>
                            <th>Fecha y hora</th>
                        </tr>
                    </thead>
                    <tbody class=" align-middle text-nowrap">
                        @foreach ($appointments as $appointment)
                            <tr>
                                <td class="shrink">
                                    <div class="d-flex gap-3">
                                        <a href="{{ route('appointment.edit', $appointment) }}" class="p-0 btn btn-link">
                                            <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                        </a>
                                        <form action="{{ route('appointment.delete') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="appointment" value="{{ $appointment->id }}" />
                                            <button type="submit" class="p-0 btn btn-link">
                                                <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td>{{ $appointment->pet }}</td>
                                <td>{{ $appointment->vet }}</td>
                                <td>{{ $appointment->date->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12 text-center">
            {{ $appointments->links('components.pagination') }}
        </div>
    </div>
@endsection
