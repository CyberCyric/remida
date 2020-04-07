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
           <div class="col-md-6 titulo">Usuarios</div>
      </div>

      <table class="table">
        <tr class="table-header">
          <th>Usuario</th>
          <th>Email</th>
          <th>Rol</th>
          <th>Activo</th>
        </tr>
        @foreach ($usuarios as $usuario)
          <tr class="selectable" id="row-{{ $usuario->id }}">
            <td>{{ $usuario->name }}</td>
            <td>{{ $usuario->email }}</td>
            <td>
              @if($usuario->role == 'A')
                Administrador
              @elseif($usuario->role == 'E')
                Editor
              @elseif($usuario->role == 'P')
                No habilitado
              @endif
            </td>
            <td>
              @if($usuario->active == 1)
                Si
              @else
                No
              @endif
            </td>
          </tr>
        @endforeach
      </table>
    </div>
    <div>{{ $usuarios->links() }}</div>
    </div>

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script>

     $( document ).ready(function() {
        $("#navbar li").removeClass('menulink-active');
        $("#navbar li#menulink-admin-otros").addClass('menulink-active');
     });

      $("table tr.selectable").click(function(){
        var rowID = this.id
          window.location.href= "usuario/" + rowID.substring(rowID.indexOf("-")+1);
      });

    </script>

  </body>
</html>