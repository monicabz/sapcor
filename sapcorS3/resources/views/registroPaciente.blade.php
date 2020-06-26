@extends('barraLateral')
@section('content')
    <h1>Registro de pacientes</h1>
    <form method="POST" action="{{ route('registroPaciente.altaPaciente') }}">
        @csrf
        <div class="form-group row">
            <div class="col">
            <label>Nombre(s):</label>
            <input type="text" class="form-control" name="inputNombre" required>
            </div>
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
            <label>Fecha de nacimiento:</label>
            <input type="date" class="form-control" name="inputFechaNac" required>
            </div>
            <div class="col">
            <label>Primer contacto:</label>
            <input type="number" class="form-control" name="inputPrimerCont" required>
            </div>
            <div class="col">
            <label>Estudios:</label>
            <select class="form-control" name="inputEstudios">
                <option value="0">Ninguna</option>
                <option value="1">Kinder</option>
                <option value="2">Primaria</option>
                <option value="3">Secundaria</option>
                <option value="4">Preparatoria</option>
                <option value="5">Licenciatura</option>
            </select>
            </div>
            <div class="col">
            <label>Necesidad especial:</label>
            <input type="text" class="form-control" name="inputNecesidad">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-4">
            <label>Calle:</label>
            <input type="text" class="form-control" name="inputCalle" required>
            </div>
            <div class="col-2">
            <label>Número:</label>
            <input type="number" class="form-control" name="inputNumero" required>
            </div>
            <div class="col-4">
            <label>Colonia:</label>
            <input type="text" class="form-control" name="inputColonia" required>
            </div>
            <div class="col-2">
            <label>Código postal:</label>
            <input type="number" class="form-control" name="inputCP" required>
            </div>
        </div>
        <h4>Datos de empleo</h4>
        <div class="form-group row">
            <div class="col">
            <label>Lugar:</label>
            <input type="text" class="form-control" name="inputLugar">
            </div>
            <div class="col">
            <label>Puesto:</label>
            <input type="text" class="form-control" name="inputPuesto">
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
            <label>Horario de entrada:</label>
            <input type="text" class="form-control" name="inputHE">
            </div>
            <div class="col">
            <label>Horario de salida:</label>
            <input type="text" class="form-control" name="inputHS">
            </div>
        </div>
        <h4>Antecedentes psicológicos</h4>
        <div class="form-group row">
            <div class="col">
            <label>Motivo de terapia anterior:</label>
            <input type="text" class="form-control" name="inputAntecedente" >
            </div>
        </div>
        <h4>Datos de enfermedades y adicciones</h4>
        <div class="form-group row">
            <div class="col">
                <label>Enfermedades crónicas:</label>
                <input type="text" class="form-control" name="inputEnfC" >
            </div>
        </div>
        <h6>Medicamentos</h6>
        <div class="form-group row">
            <div class="col">
                <label>Medicamento que consume:</label>
                <input type="text" class="form-control" name="inputMed" >
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
            <label>Fecha inicio:</label>
            <input type="date" class="form-control" name="inputFIMed" >
            </div>
            <div class="col">
            <label>Fecha fin:</label>
            <input type="date" class="form-control" name="inputFFMed" >
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
            <label>Dosis:</label>
            <input type="text" class="form-control" name="inputDosisMed" >
            </div>
            <div class="col">
            <label>Frecuencia:</label>
            <input type="text" class="form-control" name="inputFrecMed" >
            </div>
        </div>
        <h6>Drogas</h6>
        <div class="form-group row">
            <div class="col">
                <label>Droga que consume:</label>
                <input type="text" class="form-control" name="inputDroga" >
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
            <label>Fecha inicio:</label>
            <input type="date" class="form-control" name="inputFIDroga" >
            </div>
            <div class="col">
            <label>Fecha fin:</label>
            <input type="date" class="form-control" name="inputFFDroga" >
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
            <label>Dosis:</label>
            <input type="text" class="form-control" name="inputDosisDroga" >
            </div>
            <div class="col">
            <label>Frecuencia:</label>
            <input type="text" class="form-control" name="inputFrecDroga">
            </div>
        </div>
        <h4>Datos de contacto</h4>
        <div class="form-group row">
            <div class="col">
            <label>Nombre(s):</label>
            <input type="text" class="form-control" name="inputNombreC" required>
            </div>
            <div class="col">
            <label>Primer apellido:</label>
            <input type="text" class="form-control" name="inputPrimerApeC" required>
            </div>
            <div class="col">
            <label>Segundo apellido:</label>
            <input type="text" class="form-control" name="inputSegundoApeC">
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
            <label>Teléfono:</label>
            <input type="number" class="form-control" name="inputTelC" required>
            </div>
            <div class="col">
            <label>Correo:</label>
            <input type="email" class="form-control" name="inputCorreoC" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-4">
            <label>Calle:</label>
            <input type="text" class="form-control" name="inputCalleC" required>
            </div>
            <div class="col-2">
            <label>Número:</label>
            <input type="number" class="form-control" name="inputNumeroC" required>
            </div>
            <div class="col-4">
            <label>Colonia:</label>
            <input type="text" class="form-control" name="inputColoniaC" required>
            </div>
            <div class="col-2">
            <label>Código postal:</label>
            <input type="number" class="form-control" name="inputCPC" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <label>Relación con el contacto:</label>
                <input type="text" class="form-control" name="inputRelC" >
            </div>
        </div>
        <h4>Motivos para esta terapia</h4>
        <div class="form-group row">
            <div class="col">
                <label>Motivos:</label>
                <input type="text" class="form-control" name="inputMotivos" required>
            </div>
            <div class="col">
                <label>Enfoque:</label>
                <select class="form-control" name="inputEnfoque" required>
                    <option value="Cognitivo conductual">Cognitivo conductual</option>
                    <option value="unEnfoque">Neuropsicología</option>
                    <option value="Forense">Forense</option>
                    <option value="Psicoanálisis">Psicoanálisis</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-black">Registrar</button>
    </form>
@endsection