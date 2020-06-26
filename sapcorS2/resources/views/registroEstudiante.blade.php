@extends('barraLateral')
@section('content')
    <h1>Registro de estudiantes</h1>
    <form method="POST" action="{{ route('registroEstudiante.alta') }}">
        @csrf
        <input value="{{$idPsicologoRegistrado}}" type="hidden" name="inputPsicologo">
        <div class="form-group row">
            <div class="col">
            <label>ID de la UAA:</label>
            <input type="number" class="form-control" name="inputID" required>
            </div>
            <div class="col">
            <label>Nombre(s):</label>
            <input type="text" class="form-control" name="inputNombre" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
            <label>Primer apellido:</label>
            <input type="text" class="form-control" name="inputPrimerApe" required>
            </div>
            <div class="col">
            <label>Segundo apellido:</label>
            <input type="text" class="form-control" name="inputSegundoApe">
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
            <label>Semestre:</label>
            <input type="number" class="form-control" name="inputSemestre">
            </div>
            <div class="col">
            <label>Especialidad:</label>
            <select class="form-control" name="inputEnfoque">
                @forelse ($especialidades as $especialidad)
                    <option value="{{ $especialidad['nombre'] }}">{{ $especialidad['nombre'] }}</option>
                @empty
                    <option>---</option>
                @endforelse
            </select>
            </div>
        </div>
        <div class="form-group">
            <label>Programa:</label>
            <select class="form-control" name="inputPrograma">
                <option value="1">Servicio social</option>
                <option value="2">Prácticas profesionales</option>
            </select>
        </div>
        <div class="form-group">
            <label>Contraseña nueva:</label>
            <input type="password" class="form-control" name="inputPasswd">
        </div>
        <button type="submit" class="btn btn-black">Registrar</button>
    </form>
@endsection