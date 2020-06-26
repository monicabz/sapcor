@extends('barraLateral')
@section('content')
    <form method="POST" action="{{ route('estudiante.login') }}">
        @csrf
        <div class="form-group">
            <label>Usuario</label>
            <input type="text" class="form-control" placeholder="ID de la UAA" name="inputID" required value="{{ old('inputID') }}">
            {!! $errors->first('inputID', '<small style="color:red;">:message</small><br>') !!}
        </div>
        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" class="form-control" placeholder="***************" name="inputPasswd" required value="{{ old('inputID') }}">
            {!! $errors->first('inputPasswd', '<small style="color:red;">:message</small><br>') !!}
        </div>
        <button type="submit" class="btn btn-black">Entrar</button>
    </form>
@endsection