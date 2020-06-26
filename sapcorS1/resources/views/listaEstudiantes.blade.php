@extends('barraLateral')
@section('content')
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="text-center">#id</th>
                    <th scope="col" class="text-center">Nombre</th>
                    <th scope="col" class="text-center">Semestre</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($estudiantes as $estudiante)
                    <tr>
                        <th scope="row" class="text-center">{{ $estudiante['id'] }}</th>
                        <td class="text-center">{{ $estudiante['nombre'] }} {{ $estudiante['primerApellido'] }} {{ $estudiante['segundoApellido'] }}</td>
                        <td class="text-center">{{ $estudiante['semestre'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <th scope="row" class="text-center">---</th>
                        <td class="text-center">---</td>
                        <td class="text-center">---</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection