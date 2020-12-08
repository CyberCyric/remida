@extends('layouts.app')


<!DOCTYPE html>
<!--[if lt IE 7]><html lang="es" class="lt-ie10 lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html lang="es" class="lt-ie10 lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html lang="es" class="lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]><html lang="es" class="lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="es"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sitio externo del Gobierno de la Ciudad de Buenos Aires.">
    <meta name="author" content="Gobierno de la Ciudad de Buenos Aires">
    <title>ReMIDA</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
     
    
    <!-- PARA QUE ESTE HTML FUNCIONE CORRECTAMENTE DEBE VINCULAR BASTRAP.CSS -->
    <link href="{{ asset('css/bastrap.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
   
     
    <!-- ESTILOS EXTRA -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    
  </head>
  <body>
 <header id="header">
 <div class="border-gradient">
  <div class="container">
            <div id="logo-sitio">
                <a href="#" style="text-decoration: none;">
                    <div id="ba-logo" class="navbar-brand img-responsive" data-original-title="" title="">
                    </div>
                </a>
            </div>
      <div id="nombre-sitio">
        <!-- NOMBRE DEL SITIO -->
                <a href="http://disfrutemosba.buenosaires.gob.ar">
          <h1>ReMIDA Buenos Aires</h1>
        </a>
      </div>
        
      <div>
        <img src="{{ asset('images/remida.jpg') }}" class="remida-logo" style="float:right;height: 60px; width: auto"/>
      </div>

  </div>
  </div>
</header>
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h2 class="header">Administrador - Nuevo usuario</h2><br><br>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Clave</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Repetir Clave</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group text-center">

                                <button type="submit" class="btn btn-primary">
                                    Registrarse
                                </button>
                                &nbsp;&nbsp;&nbsp;
                                <button type="button" id="btnRegister" class="btn btn-secondary align-left" onClick="javascript:window.location.href='login/';">
                                    Volver
                                </button>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

  
    <!-- Modal de Validación -->
      <div class="modal fade" id="modalValidacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Se encontraron los siguientes errores:</h4>
          </div>
          <div class="modal-body" id="msgModal">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
          </div>
        </div>
      </div>
      </div>
      <!-- Fin Modal de Validación -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="https://servicios.usig.buenosaires.gob.ar/usig-js/3.1/usig.MapaInteractivo.min.js"></script>
  <script src="https://servicios.usig.buenosaires.gob.ar/usig-js/3.1/usig.AutoCompleterFull.min.js"></script>
  <script src="https://servicios.usig.buenosaires.gob.ar/usig-js/3.1/usig.Recorridos.min.js"></script>
      
  </body>
</html>

