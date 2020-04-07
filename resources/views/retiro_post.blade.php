<!DOCTYPE html>
<html lang="es">
  <head>
   <title>ReMIDA - Solicitar Retiro de Materiales</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
                                                              
    <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link href="{{ asset('css/bastrap.css') }}" rel="stylesheet" type="text/css" >
      <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >   
  </head> 
        
  <body>
    @include('includes.header')

    <div class="container main-container text-center">
      <h1>Gracias - Tu número de pedido es #{{ $retiro_id }}</h1>
      <h3>Tu pedido ha sido registrado y será revisado a la brevedad.</h3>
      <h3><a class="label label-primary" href="{{ url('/retiro') }}">Volver</a></h3>
    </div>

    <div class="alert alert-danger text-center"><span class="glyphicon glyphicon-warning-sign"></span>&nbsp;<strong>Importante:</strong> El centro ReMida BA no se responsabiliza por el uso y el destino del material una vez retirado.</div>

    @include('includes.footer')
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>