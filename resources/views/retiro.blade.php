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

      <div class="main-container">
         <div class="container">
            <div class="alert alert-info"><span class="glyphicon glyphicon-warning-sign"></span>&nbsp;<strong>Importante:</strong> Este formulario solo podrá completarse presencialmente en el Centro ReMida BA o en el ReMida Viajero.</div>
            <h2>Ficha de Retiro</h2>
            <div><i>Te contamos que registramos esta información para medir el impacto ambiental de la reutilización y para saber cuales son los materiales más elegidos para que guíen nuestras búsquedas. Tus datos personales no serán compartidos con terceros.</i></div>
         </div>
         <form method="POST" action="{{ url('retiro') }}" id="formRetiro">
            {{ csrf_field() }}
            <div class="container" id="formRetiro">
               <hr/>
                <div class="form-group row">
                  <label for="" class="col-sm-2 col-form-label">Lugar de retiro:</label>
                  <div class="col-sm-10">
                     
                     <form class="form-inline">
                          <div class="form-check mb-2 mr-sm-2">
                           <label class="form-check-label" for="inlineFormCheck">
                              Centro ReMida
                            </label>
                            <input class="form-check-input" type="radio" id="radLugarRetiroCentro" name="lugar_retiro" value="CENTRO">
                           </div>

                           <div class="form-check mb-2 mr-sm-2">
                           <label class="form-check-label" for="inlineFormCheck">
                              ReMida Viajero
                            </label>
                            <input class="form-check-input" type="radio" id="radLugarRetiroViajero" name="lugar_retiro" value="VIAJERO">
                           </div>

                           <div class="form-check mb-2 mr-sm-2">
                           <label class="form-check-label" for="inlineFormCheck">
                              ReMida Eventos
                            </label>
                            <input class="form-check-input" type="radio" id="radLugarRetiroEventos" name="lugar_retiro" value="EVENTOS">
                           </div>

                        </form>

                  </div>
               </div>
               <div class="form-group row">
                  <label for="nombre" class="col-sm-2 col-form-label">Nombre y Apellido:</label>
                  <div class="col-sm-10">
                     <input type="text" id="input_nombre" name="nombre" data-type="input-textbox" class="form-control " size="70" value="" placeholder=" " data-component="textbox" required="">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="evento" class="col-sm-2 col-form-label">Evento:</label>
                  <div class="col-sm-10">
                     <input type="text" id="input_evento" name="evento" data-type="input-textbox" class="form-control " size="70" value="" placeholder=" " data-component="textbox" required="">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="institucion" class="col-sm-2 col-form-label">Escuela / Institución:</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" name="institucion" id="input_institucion" placeholder="" value="">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="distrito_id" class="col-sm-2 col-form-label">Distrito:</label>
                  <div class="col-sm-10">
                     <select class="form-control" name="distrito_id" id="cmbDistrito">
                        @foreach ($distritos as $distrito)
                        <option value="{{ $distrito->distrito_id }}">{{ $distrito->nombre }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="proyecto_institucional" class="col-sm-2 col-form-label">Proyecto Institucional:</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" name="proyecto_institucional" id="proyecto_institucional" placeholder="" value="">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="fecha" class="col-sm-2 col-form-label">Fecha (dd/mm/aaaa):</label>
                  <div class="col-sm-10">
                     <input type="text" name="dia" size="2" id="inputDia" value="{{ date('d') }}" />
            <input type="text" name="mes" size="2" id="inputMes" value="{{ date('m') }}" />
            <input type="text" name="agno" size="4" id="inputAgno" value="{{ date('Y') }}" />
                  </div>
               </div>
               <hr/>
               <div class="container" data-original-title="" id="materialidad">
                  <div class="row" data-original-title="">
                     <div class="col-md-2" align="left" data-original-title="">
                        <h3 class="">Materialidad </h3>
                     </div>
                     <div class="col-md-2" align="left" data-original-title="">
                        <h3 class="hidden-xs">Cantidad (Gms.) </h3>
                     </div>
                     <div class="col-md-8" align="left" data-original-title="">
                        <h3 class="hidden-xs">Observaciones </h3>
                     </div>
                  </div>
                  <div class="row bkg1" data-original-title="">
                     <div class="col-md-2" align="left" data-original-title="">
                        <h3>MADERA</h3>
                     </div>
                     <div class="col-md-2" align="left" data-original-title=""><h3 class="visible-xs">Cantidad (Gms.) </h3>
                        <input type="number" min="0" class="form-control text-right"  id="inputMadera" name="madera" placeholder="" onkeydown="javascript: return event.keyCode == 69 ? false : true">
                     </div>
                     <div class="col-md-8" align="left" data-original-title=""><h3 class="visible-xs">Observaciones </h3>
                        <textarea name="madera_obs"  class="form-control observaciones-txtarea"></textarea>  
                     </div>
                  </div>
                  <div class="row bkg2" data-original-title="">
                     <div class="col-md-2" align="left" data-original-title="">
                        <h3>PAPEL Y CARTÓN</h3>
                     </div>
                     <div class="col-md-2" align="left" data-original-title=""><h3 class="visible-xs">Cantidad (Gms.) </h3>
                        <input type="number" min="0" class="form-control text-right"  name="papel" id="inputPapel" placeholder="" onkeydown="javascript: return event.keyCode == 69 ? false : true">
                     </div>
                     <div class="col-md-8" align="left" data-original-title=""><h3 class="visible-xs">Observaciones </h3>
                        <textarea name="papel_obs"  class="form-control observaciones-txtarea"></textarea>  
                     </div>
                  </div>
                  <div class="row bkg2" data-original-title="">
                     <div class="col-md-2" align="left" data-original-title="">
                        <h3>PLÁSTICO</h3>
                     </div>
                     <div class="col-md-2" align="left" data-original-title=""><h3 class="visible-xs">Cantidad (Gms.) </h3>
                        <input type="number" min="0" class="form-control text-right"  id="inputPlastico" name="plastico" placeholder="" onkeydown="javascript: return event.keyCode == 69 ? false : true">
                     </div>
                     <div class="col-md-8" align="left" data-original-title=""><h3 class="visible-xs">Observaciones </h3>
                        <textarea name="plastico_obs"  class="form-control observaciones-txtarea"></textarea>  
                     </div>
                  </div>
                  <div class="row bkg1" data-original-title="">
                     <div class="col-md-2" align="left" data-original-title="">
                        <h3>METAL</h3>
                     </div>
                     <div class="col-md-2" align="left" data-original-title=""><h3 class="visible-xs">Cantidad (Gms.) </h3>
                        <input type="number" min="0" class="form-control text-right"  name="metal" id="inputMetal" placeholder="" onkeydown="javascript: return event.keyCode == 69 ? false : true">
                     </div>
                     <div class="col-md-8" align="left" data-original-title=""><h3 class="visible-xs">Observaciones </h3>
                        <textarea name="metal_obs"  class="form-control observaciones-txtarea"></textarea>  
                     </div>
                  </div>
                  <div class="row bkg2" data-original-title="">
                     <div class="col-md-2" align="left" data-original-title="">
                        <h3>TEXTIL</h3>
                     </div>
                     <div class="col-md-2" align="left" data-original-title=""><h3 class="visible-xs">Cantidad (Gms.) </h3>
                        <input type="number" min="0" class="form-control text-right"  name="textil" id="inputTextil" placeholder="" onkeydown="javascript: return event.keyCode == 69 ? false : true">
                     </div>
                     <div class="col-md-8" align="left" data-original-title=""><h3 class="visible-xs">Observaciones </h3>
                        <textarea name="textil_obs"  class="form-control observaciones-txtarea"></textarea>  
                     </div>
                  </div>
                  <div class="row bkg1" data-original-title="">
                     <div class="col-md-2" align="left" data-original-title="">
                        <h3>VIDRIO</h3>
                     </div>
                     <div class="col-md-2" align="left" data-original-title=""><h3 class="visible-xs">Cantidad (Gms.) </h3>
                        <input type="number" min="0" class="form-control text-right"  name="vidrio" id="inputVidrio" placeholder="" onkeydown="javascript: return event.keyCode == 69 ? false : true">
                     </div>
                     <div class="col-md-8" align="left" data-original-title=""><h3 class="visible-xs">Observaciones </h3>
                        <textarea name="vidrio_obs"  class="form-control observaciones-txtarea"></textarea>  
                     </div>
                  </div>
                  <div class="row bkg2" data-original-title="">
                     <div class="col-md-2" align="left" data-original-title="">
                        <h3>NATURAL</h3>
                     </div>
                     <div class="col-md-2" align="left" data-original-title=""><h3 class="visible-xs">Cantidad (Gms.) </h3>
                        <input type="number" min="0" class="form-control text-right"  name="natural" id="inputNatural" placeholder="" onkeydown="javascript: return event.keyCode == 69 ? false : true">
                     </div>
                     <div class="col-md-8" align="left" data-original-title=""><h3 class="visible-xs">Observaciones </h3>
                        <textarea name="natural_obs"  class="form-control observaciones-txtarea"></textarea>  
                     </div>
                  </div>
                  <div class="row bkg1" data-original-title="">
                     <div class="col-md-2" align="left" data-original-title="">
                        <h3>OTROS</h3>
                     </div>
                     <div class="col-md-2" align="left" data-original-title=""><h3 class="visible-xs">Cantidad (Gms.) </h3>
                        <input type="number" min="0" class="form-control text-right"  name="otros" id="inputOtros" placeholder="" onkeydown="javascript: return event.keyCode == 69 ? false : true">
                     </div>
                     <div class="col-md-8" align="left" data-original-title=""><h3 class="visible-xs">Observaciones </h3>
                        <textarea name="otros_obs"  class="form-control observaciones-txtarea"></textarea>  
                     </div>
                  </div>
                  <div class="text-center"><br /><button type="button" class="btn btn-lg btn-primary" id="butSolicitarMaterial">Solicitar material</button></div>
                  <div class="clearfix" data-original-title=""> </div>
                  <hr/>
               </div>
               <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span>&nbsp;<strong>Importante:</strong> El centro ReMida BA no se responsabiliza por el uso y el destino del material una vez retirado.</div>
            </div>
         </form>
      </div>

      @include('includes.footer')


      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      <script>
        $("#butSolicitarMaterial").click(function(){
          var error = false;
          var msg = '';
          // if ( $("#input_nombre").val() == '') { error = true; msg += " - Ingresa tu nombre y apellido.\n"; }
          // if ( $("#input_institucion").val() == '') { error = true; msg += " - Ingresa la institución educativa.\n"; }
          if ( ($("#inputMadera").val() == 0) &&  ($("#inputPapel").val() == 0) && ($("#inputCarton").val() == 0) && ($("#inputPlastico").val() == 0) && ($("#inputMetal").val() == 0) && ($("#inputTextil").val() == 0) && ($("#inputVidrio").val() == 0) && ($("#inputNatural").val() == 0) && ($("#inputOtros").val() == 0)){
              error = true;
              msg += " - Ingresá al menos un material.\n";
          }   

          if ( $("#cmbDistrito").val() == 0) {
              error = true;
              msg += " - Seleccioná el distrito.\n";
          }

          if ( ($("#radLugarRetiroCentro").is(':checked') == false) && ($("#radLugarRetiroViajero").is(':checked') == false) && ($("#radLugarRetiroEventos").is(':checked') == false) ){
            error = true;
            msg += " - Seleccioná el lugar de retiro. \n";
          } 
          if (error){
            alert("Se encontraron los siguientes errores: \n"+ msg);
          } else {
            var rdo = confirm("¿Enviar el pedido?")
            if (rdo) $("#formRetiro").submit();
          }
        });
      </script>
   </body>
</html>