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
           <div class="col-md-12 titulo">Editar usuario</div>
      </div>

  <form method="POST" action="{{ url("admin/usuario/$usuario->id") }}" id="formUsuario">
  {{ csrf_field() }}

  <div class="well">

  <div class="form-group row" id="field_group_1">
    <label for="input1" class="col-sm-4 col-form-label">Nombre:</label>
    <div class="col-sm-8">{{ $usuario->name }}</div>
  </div>

  <div class="form-group row" id="field_group_1">
    <label for="input1" class="col-sm-4 col-form-label">Email:</label>
    <div class="col-sm-8">{{ $usuario->email }}</div>
  </div>

  <div class="form-group row" id="field_group_1">
    <label for="input1" class="col-sm-4 col-form-label">Role:</label>
    <div class="col-sm-8">
      <select id="cmbRole" name="role" class="form-control " data-toggle="tooltip" title="" 
      @if($isAdmin == false)
          disabled
        @endif
      >
          <option {{old('role',$usuario->role)=="A"? 'selected':''}}  value="A">Administrador</option>
          <option {{old('role',$usuario->role)=="E"? 'selected':''}} value="E">Editor</option>
      </select>
    </div>
  </div>

  <div class="form-group row" id="field_group_1">
    <label for="input1" class="col-sm-4 col-form-label">Habilitado:</label>
    <div class="col-sm-8">
      <select id="cmbActive" name="active" class="form-control " data-toggle="tooltip" title="" 
        @if($isAdmin == false)
          disabled
        @endif>
          <option {{old('role',$usuario->active)=="1"? 'selected':''}}  value="1">SI</option>
          <option {{old('role',$usuario->active)=="0"? 'selected':''}} value="0">NO</option>
      </select>
    </div>
  </div>

</div>

      <div class="row">
           <div class="col-md-12 text-right">
            <button class="btn boton" id="butVolver">Volver</button>
            @if($isAdmin == true)
               <button class="btn btn-primary boton" id="butGuardarUsuario" type="button">Guardar</button>
            @endif
           </div>
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
          $("#navbar li#menulink-admin-otros").addClass('menulink-active');
      });

      $("#butGuardarUsuario").click(function(){
        $("#formUsuario").submit();
      });

      $("#butVolver").click(function(){
        window.location.href = "../usuarios";
      });

    </script>
  </body>
</html>