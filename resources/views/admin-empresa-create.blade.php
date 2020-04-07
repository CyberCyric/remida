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
           <div class="col-md-12 titulo">Empresa</div>           
      </div>

  <form method="POST" action="{{ url('admin/empresa/') }}" id="formEmpresa" onsubmit="return enviarForm(event)">
  {{ csrf_field() }}

  <div class="well">

  <div class="form-group row" id="field_group_1">
    <label for="input1" class="col-sm-4 col-form-label">
    Razón Social
  </label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="input_razon_social" name="razon_social" placeholder="" data-toggle="tooltip" title="" value="">
    </div>
  </div>
  
  <div class="form-group row" id="field_group_4">
    <label for="input4" class="col-sm-4 col-form-label">
      Tipo
    </label>
    <div class="col-sm-8">
      <select id="cmbTipo" name="tipo" class="form-control " data-toggle="tooltip" title="" >
          <option value="PROPIO">Propio</option>
          <option value="ESCUELAS_VERDES">Escuelas Verdes</option>
      </select>
    </div>
  </div>

  <div class="form-group row" id="field_group_5">
    <label for="input5" class="col-sm-4 col-form-label">
    Nombre del Contacto
  </label>
    <div class="col-sm-8">
      <input type="text" class="form-control " id="input5" placeholder="" name="contacto" data-toggle="tooltip" title=""  value="">
    </div>
  </div>

  <div class="form-group row" id="field_group_5">
    <label for="input5" class="col-sm-4 col-form-label">
    Dirección
  </label>
    <div class="col-sm-8">
      <input type="text" class="form-control " id="input5" placeholder="" name="direccion" data-toggle="tooltip" title=""  value="">
    </div>
  </div>  

  <div class="form-group row" id="field_group_5">
    <label for="input5" class="col-sm-4 col-form-label">
    Telefono
  </label>
    <div class="col-sm-8">
      <input type="text" class="form-control " id="input5" placeholder="" name="telefono" data-toggle="tooltip" title=""  value="">
    </div>
  </div>

  <div class="form-group row" id="field_group_5">
    <label for="input5" class="col-sm-4 col-form-label">
    Email
  </label>
    <div class="col-sm-8">
      <input type="text" class="form-control " id="input5" placeholder="" name="email" data-toggle="tooltip" title="" value="">
    </div>
  </div>

  <div class="form-group row" id="field_group_5">
    <label for="input5" class="col-sm-4 col-form-label">
    Entrega
  </label>
    <div class="col-sm-8">
      <div>
        <label>Madera:</label> <input type="checkbox" name="entrega_madera" />
        <label>Papel:</label> <input type="checkbox" name="entrega_papel" />
        <label>Cartón:</label> <input type="checkbox" name="entrega_carton" />
      </div>
      <div>
        <label>Plástico:</label> <input type="checkbox" name="entrega_plastico" />
        <label>Metal:</label> <input type="checkbox" name="entrega_metal" />
        <label>Textil:</label> <input type="checkbox" name="entrega_textil" />
      </div>
      <div>
        <label>Vidrio:</label> <input type="checkbox" name="entrega_vidrio" />
        <label>Natural:</label> <input type="checkbox" name="entrega_natural" />
        <label>Otros:</label> <input type="checkbox" name="entrega_otros" />
      </div>
    </div>

         
  </div>

<div class="form-group row" id="field_group_6">
    <label for="input5" class="col-sm-4 col-form-label">
    Observaciones
</h6>
  </label>
    <div class="col-sm-8">
      <textarea class="form-control " id="input5" placeholder="" name="observaciones" ></textarea>
  </div>

</div>

      <div class="row">
           <div class="col-md-12 text-right">
               <button class="btn boton" id="butVolver">Volver</button>           
               <button class="btn btn-primary boton" id="butGuardarEmpresa">Guardar</button>
           </div>
      </div>

</form>
</div>
        </div>
    </div>

    <!-- Modal de Validación -->
      <div class="modal fade" id="modalValidacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Error:</h4>
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

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script>

      function enviarForm(event){
          $("#formEmpresa").submit();
      }

      $( document ).ready(function() {
          $("#navbar li").removeClass('menulink-active');
          $("#navbar li#menulink-admin-otros").addClass('menulink-active');
      });

      $("#butGuardarEmpresa").click(function(){
          enviarForm();
      });

      $("#butVolver").click(function(){
        window.location.href = "../empresas";
      });

    </script>
  </body>
</html>