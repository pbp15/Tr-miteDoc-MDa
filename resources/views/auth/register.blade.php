@extends('auth.contenido')

@section('login')
<div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card-group mb-0">
        <div class="card p-4">
        <form class="form-horizontal was-validated" method="POST" action="{{route('login')}}">
          {{ csrf_field() }}
          <div class="card-body">
            <h1 class="text-center">Registrarse</h1>
            <p class="text-center">Oficina de Trámite Documentario</p>
            <div class="form-group mb-3{{$errors->has('usuario' ? 'is-invalid' : '')}}   ">
              <span class="input-group-addon"><i class="icon-user"></i></span>
              <input type="text" value="{{old('usuario')}}"   name="usuario" id="usuario" class="form-control" placeholder="Nombres">
              {!! $errors->first('usuario', '<span class="invalid-feedback">:message</span>')!!}
            </div>
            <div class="form-group mb-3{{$errors->has('usuario' ? 'is-invalid' : '')}}   ">
                <span class="input-group-addon"><i class="icon-user"></i></span>
                <input type="text" value="{{old('usuario')}}"   name="usuario" id="usuario" class="form-control" placeholder="Apellidos">
                {!! $errors->first('usuario', '<span class="invalid-feedback">:message</span>')!!}
              </div>
              <div class="form-group mb-3{{$errors->has('usuario' ? 'is-invalid' : '')}}   ">
                <span class="input-group-addon"><i class="icon-user"></i></span>
                <input type="email" value="{{old('usuario')}}"   name="usuario" id="usuario" class="form-control" placeholder="Correo electrónico">
                {!! $errors->first('usuario', '<span class="invalid-feedback">:message</span>')!!}
              </div>
                
                <div class="form-group mb-4{{$errors->has('password' ? 'is-invalid' : '')}} ">
                <span class="input-group-addon"><i class="icon-lock"></i></span>
                <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña">
                {!! $errors->first('password', '<span class="invalid-feedback">:message</span>')!!}
                </div>

                <div class="form-group mb-4{{$errors->has('password' ? 'is-invalid' : '')}} ">
                    <span class="input-group-addon"><i class="icon-lock"></i></span>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Confirmar Contraseña">
                    {!! $errors->first('password', '<span class="invalid-feedback">:message</span>')!!}
                    </div>
            <div class="row justify-content-center " >
              <div class="col-6">
                <button type="submit" class="btn btn-primary px-5">Acceder</button>
              </div>
            </div>
          </div>
        </form>
        </div>
        <div class="card text-black bg-white mb-8 " style= "border: 2px solid red">
          <div class="card-body text-center" style= "border: 2px solid green">
            <div  class="py-4 mt-5" style= "border: 2px solid rgb(24, 21, 165)">
            <strong><h2>Sistema de Mesa de Partes Virtual</h2></strong>  
              <p>Municipalidad  Distrital de Acobamba</p>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
