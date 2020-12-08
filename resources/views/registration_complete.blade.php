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
 
  <div class="container">
    <h1>Muchas gracias.</h1>
    <p>Tu usuario ha sido registrado y está a la espera de ser aprobado por un Administrador.</p>
    <a class="label label-primary" href="{{ url('/admin/logout') }}">Volver al Inicio</a>
  </div>
  
  

  <footer id="ba-footer">
  </footer>

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
  
    <!-- JAVASCRIPT EXTRA -->
    
  </body>
</html>