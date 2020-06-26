@extends('barraLateral')
@section('content')
    <h1>Lista de pacientes</h1>
    <form method="POST" action="{{ route('listaPacientes.ver') }}">
        @csrf
        <div class="form-group row">
            <div class="col">
            <label>Paciente:</label>
            <select class="form-control" name="inputPaciente">
                @forelse ($pacientes as $paciente)
                    <option value="{{$paciente['id']}}">{{ $paciente['nombre'] }} {{ $paciente['primerApellido'] }} {{ $paciente['segundoApellido'] }}</option>
                @empty
                    <option>---</option>
                @endforelse
            </select>
            </div>
        </div>
        <button type="submit" class="btn btn-black">Ver</button>
        <div class="mt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Motivos</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($historiales as $historial)
                        <tr>
                            <td class="text-center">{{ $historial['motivo'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td>---</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </form>
@endsection