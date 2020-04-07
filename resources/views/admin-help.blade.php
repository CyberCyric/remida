<!DOCTYPE html>
<html lang="es">
  <head>
   <title>ReMIDA - ADMIN</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
                                                              
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="{{ asset('css/bastrap.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >

  </head> 
        
  <body>
    <div class="container">
    @include('admin-navbar')      

      <div class="well" style="width:70%">
        <strong>Ayuda</strong>
        <ol>
          <li>Agregar una nueva entrega</li>
          <li>Agregar el contenido de una entrega</li>
          <li>Eliminar el contenido de una entrega</li>
        </ol>
      </div>

      <section>
        <h4>Agregar una nueva entrega</h4>
        <i>Una entrega es un ingreso de material en una determinada fecha. La entrega puede incluir distintos tipos de material y distintas empresas proveedoras. Por lo tanto, el único dato necesario para crear una entrega es su fecha.<br/>
        La entrega representa un "contenedor" al que luego se cargan los materiales recibidos. (Ver sección siguiente).</i><br /><br />
        Para crear una nueva entrega: 
        <li>Elegir la opción "Entregas" del menú. Esta pantalla muestra la lista de entregas ya cargadas en el sistema. </li>
        <li>Hacer click en el botón "Nueva Entrega"</li>
        <li>Ingresar la fecha de la entrega. (Por defecto aparece cargada la fecha actual).</li>        
      </section>
      <hr />
    
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   
  </body>
</html>