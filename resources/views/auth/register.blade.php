@extends('auth.contenido')

@section('register')
<div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-group mb-0">
          <div class="card p-4">
          <form class="form-horizontal was-validated" method="POST" action="{{ route('register') }}">
          {{ csrf_field() }}
            <div class="card-body">
              <h1>FORMULARIO DE REGISTRO PARA NUEVO SOCIO/USUARIO</h1>
              <p class="text-muted">Ingrese los datos solicitados</p>

              <div class="form-group">
                <span class="input-group-addon"><b>RUT</b></span>
                <input type="text" name="rut" id="rut" class="form-control" placeholder="Ej: 12345678-9">
              </div>

              <div class="form-group">
                <span class="input-group-addon"><b>Nombre completo</b></span>
                <input type="text" name="nom_p" id="nom_p" class="form-control" placeholder="Primer nombre">
                <input type="text" name="nom_s" id="nom_s" class="form-control" placeholder="Segundo nombre">
                <input type="text" name="ap_p" id="ap_p" class="form-control" placeholder="Primer apellido">
                <input type="text" name="ap_s" id="ap_s" class="form-control" placeholder="Segundo apellido">
              </div>

              <div class="form-group">
                <span class="input-group-addon"><b>Edad actual</b></span>
                <input type="number" name="edad" id="edad" class="form-control" placeholder="Ingrese su edad actual">
              </div>

              <div class="form-group">
                <span class="input-group-addon"><b>Dirección</b></span>
                <select class="form-control">
                  <option>Seleccione una dirección</option>
                  <option>  Pasaje Cerro Adasme # 654  </option>
                  <option>  Pasaje Cerro Rinconada # 654  </option>
                </select>
              </div>

              <div class="form-group">
                <span class="input-group-addon"><b>Profesión</b></span>
                <input type="text" name="prof" id="prof" class="form-control" placeholder="Ingrese su profesión">
              </div>

              <div class="form-group">
                <span class="input-group-addon"><b>Email</b></span>
                <input type="text" name="email" id="email" class="form-control" placeholder="Ej: abc@gg.com">
              </div>

              <div class="form-group">
                <span class="input-group-addon"><b>Teléfono</b></span>
                <input type="number" name="telef" id="telef" class="form-control" placeholder="Ej: 912345678">
              </div>

              <div class="form-group">
                <span class="input-group-addon"><b>Contraseña de usuario</b></span>
                <input type="password" name="password" id="password" class="form-control" placeholder="Ingrese una contraseña">
              </div>

              <div class="row">
                <div class="col-6">
                  <a href="{{ route('l') }}" class="btn btn-success active mt-3">Enviar solicitud</a>
                </div>
              </div>
            </div>
          </form>
          </div>
          
        </div>
      </div>
@endsection

