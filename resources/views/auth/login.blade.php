@extends('auth.contenido')

@section('login')
<div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-group mb-0">
          <div class="card p-4">
          <form class="form-horizontal was-validated" method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}
            <div class="card-body">
              <h1>Acceder</h1>
              <p class="text-muted">Control de acceso al sistema</p>
              <div class="form-group mb-3{{$errors->has('rut' ? 'is-invalid' : '')}}">
                <span class="input-group-addon"><i class="icon-user"></i></span>
                <input type="text" value="{{old('rut')}}" name="rut" id="rut" class="form-control" placeholder="RUT">
                {!!$errors->first('rut','<span class="invalid-feedback">:message</span>')!!}
              </div>
              <div class="form-group mb-4{{$errors->has('password' ? 'is-invalid' : '')}}">
                <span class="input-group-addon"><i class="icon-lock"></i></span>
                <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña">
                {!!$errors->first('password','<span class="invalid-feedback">:message</span>')!!}
              </div>
              <div class="row">
                <div class="col-6">
                  <button type="submit" class="btn btn-success px-4">Acceder</button>
                </div>
              </div>
            </div>
          </form>
          </div>
          <div class="card text-white bg-success py-5 d-md-down-none" style="width:44%">
            <div class="card-body text-center" style="background-color:#22A638">
              <div>
                <h2>Aplicación Web JJ.VV. - Aires del Valle</h2>
                <p>Sistema de administración para la Junta de Vecinos Aires del Valle de la comuna de San Bernardo</p>
                <a href="{{ route('register') }}" class="btn btn-success active mt-3">Registrarse</a>
              </div>
            </div>
          </div>
        </div>
      </div>

@endsection
