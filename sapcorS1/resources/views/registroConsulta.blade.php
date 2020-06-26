@extends('barraLateral')
@section('content')
    <h1>Registro de consulta</h1>
    <form method="POST" action="{{ route('registroConsulta.agregar') }}">
        @csrf
        <input value="{{$idEstudiante}}" type="hidden" name="inputEstudiante">
        <div class="form-group row">
            <div class="col">
                <label>ID del paciente:</label>
                <select class="form-control" name="inputPaciente">
                    @forelse ($pacientes as $paciente)
                        <option value="{{$paciente['id']}}">{{ $paciente['id'] }}</option>
                    @empty
                        <option>---</option>
                    @endforelse
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
            <label>Fecha:</label>
            <input type="date" class="form-control" name="inputFecha" required>
            </div>
            <div class="col">
            <label>Hora:</label>
            <input type="text" class="form-control" name="inputHora" required>
            </div>
        </div>
        <div class="form-group">
            <label>Notas:</label>
            <input type="text" class="form-control" name="inputNotas">
        </div>
        <button type="submit" class="btn btn-black">Guardar</button>
    </form>
@endsection