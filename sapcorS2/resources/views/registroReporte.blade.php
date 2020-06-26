@extends('barraLateral')
@section('content')
    <h1>Registro de reportes</h1>
    <form method="POST" action="{{ route('registroReporte.alta') }}">
        @csrf
        <input value="{{$idPsicologoRegistrado}}" type="hidden" name="inputPsicologo">
        <div class="form-group row">
            <div class="col">
                <label>ID del estudiante:</label>
                <select class="form-control" name="inputEstudiante">
                    @forelse ($estudiantes as $estudiante)
                        <option value="{{$estudiante['id']}}">{{ $estudiante['id'] }}</option>
                    @empty
                        <option>---</option>
                    @endforelse
                </select>
            </div>
            <div class="col">
                <label>Programa:</label>
                <select class="form-control" name="inputPrograma">
                    <option value="1">Servicio social</option>
                    <option value="2">Prácticas profesionales</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
            <label>Fecha de inicio:</label>
            <input type="date" class="form-control" name="inputFechaInicio" required>
            </div>
            <div class="col">
            <label>Fecha de fin:</label>
            <input type="date" class="form-control" name="inputFechaFin" required>
            </div>
        </div>
        <div class="form-group">
            <label>Horas sumadas:</label>
            <input type="number" class="form-control" name="inputHoras">
        </div>
        <button type="submit" class="btn btn-black">Registrar</button>
    </form>
@endsection