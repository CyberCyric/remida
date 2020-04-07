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
           <div class="col-md-6 titulo">Retiros de material</div>
      </div>
      

      <table class="table">
        <tr class="table-header">
          <th>Número</th>
          <th>Fecha</th>
          <th>Escuela / Institución</th>
          <th>Distrito</th>
          <th>Nombre y Apellido</th>
          <th>Estado</th>
        </tr>
        @foreach ($retiros as $retiro)
          <tr class="selectable" id="row-{{ $retiro->retiro_id }}">
            <td>{{ $retiro->retiro_id }}</td>
            <td>{{ \Carbon\Carbon::parse($retiro->fecha)->format('d/m/Y')}}</td>
            <td>{{ $retiro->institucion }}</td>
            <td>{{ $retiro->distrito }}</td>
            <td>{{ $retiro->nombre }}</td>
            <td>
              @if ($retiro->aprobado == 'S')
              <span class="label label-success icono_retiro_aprobado" >
                <span class="glyphicon glyphicon-ok" >Aprobado</span>
              </span>
              @else
              <span class="label label-danger icono_retiro_pendiente">
                <span class="glyphicon glyphicon-time">&nbsp;Pendiente</span>
              </span>
              @endif
             </td>
          </tr>
        @endforeach
      </table>
    </div>

    <div>{{ $retiros->links() }}</div>

    
    </div>

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>

    <script>

     $( document ).ready(function() {
        $("#navbar li").removeClass('menulink-active');
        $("#navbar li#menulink-admin-retiros").addClass('menulink-active');
     });

      $("table tr.selectable").click(function(){
        var rowID = this.id
          window.location.href= "retiro/" + rowID.substring(rowID.indexOf("-")+1, rowID.length);
      });

    </script>

  </body>
</html>