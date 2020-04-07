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

      <div class="row">
           <div class="col-md-6 titulo">Entrega</div>
           <div class="col-md-6 text-right">
           </div>
      </div>

 <form method="POST" action="{{ url('admin/entrega') }}" id="formEntrega">
    {{ csrf_field() }}
  <div class="container">    
    <div class="form-group row">
      <div class="text-center">
          <h4>Crear una nueva entrega con fecha: </h4>
            <input type="text" name="dia" size="2" id="inputDia" value="{{ date('d') }}" />
            <input type="text" name="mes" size="2" id="inputMes" value="{{ date('m') }}" />
            <input type="text" name="agno" size="4" id="inputAgno" value="{{ date('Y') }}" />
       </div>
    </div>
  </div>
  <div class="text-center"><br />
    <button type="submit" class="btn btn-primary" id="butAceptar">Aceptar</button>
    <button type="button" class="btn boton btn-default" id="butVolver">Volver</button>
  </div>
 </form>
</div>
        </div>
    </div>

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script>

      $( document ).ready(function() {
          $("#navbar li").removeClass('menulink-active');
          $("#navbar li#menulink-admin-empresas").addClass('menulink-active');
      });


      $("#butVolver").click(function(){
        window.location.href = "./entregas";
      });
      
    </script>
  </body>
</html>