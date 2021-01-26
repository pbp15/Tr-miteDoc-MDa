@extends('auth.contenido')

@section('login')
<div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card-group mb-0">
        <div class="card p-4 bg-light ">
        <form class="form-horizontal was-validated" method="POST" action="{{route('login')}}">
          {{ csrf_field() }}
          <div class="card-body py-5 " >
            <h1 class="text-center">Login</h1>
            <strong><p class="text-center">Control de acceso al sistema</p></strong>
            <div class="form-group mb-3{{$errors->has('usuario' ? 'is-invalid' : '')}}   ">
              <span class="input-group-addon"><i class="icon-user"></i></span>
              <input type="text" value="{{old('usuario')}}"   name="usuario" id="usuario" class="form-control text-center" placeholder="Usuario">
              {!! $errors->first('usuario', '<span class="invalid-feedback">:message</span>')!!}
            </div>
            <div class="form-group mb-4{{$errors->has('password' ? 'is-invalid' : '')}} ">
              <span class="input-group-addon"><i class="icon-lock "></i></span>
              <input type="password" name="password" id="password" class="form-control text-center " placeholder="Password">
              {!! $errors->first('password', '<span class="invalid-feedback">:message</span>')!!}
            </div>
            <div class="row d-flex justify-content-center mt-3">
              <div class="col-6">
                <button type="submit" class="btn btn-danger px-4 ">Iniciar Sesión</button>
               
              </div>
             
            </div>
          </div>
        </form>
        </div>
        <div class="card text-danger bg-white py-4 d-md-down-none" style="width:44%">
          <div class="card-body text-center">
            <div>
              <h2 class="text-dark">Portal Web </h2>
              <h1>I.E.P "Einstein"</h1>
              <strong><h4 class="text-dark">Sistema Administrador Web</h4></strong>
              <img src="images/log1.jpg" class="ml-2" alt="logo eisntein" width="150px">
              <strong><h6 class="text-dark">"Aprendizaje Activo y Personalizado"</h6></strong>            
              <a href="{{route('page')}}" target="_blank" class=" btn btn-danger active mt-3">Ver Pagina</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
