<!DOCTYPE html>
<html lang="es">

<head>
    <title>ReMIDA - ADMIN</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="{{ asset('css/bastrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container">
        @include('admin-navbar')
        <div class="row">
            <div class="col-md-12 titulo">Retiro</div>
        </div>
        <form method="POST" action="{{ url("admin/retiro/$retiro_id/approve") }}" id="formRetiro">
            {{ csrf_field() }}
            <div class="container">
                <hr />
                <div class="form-group row">
                    <label for="nombre" class="col-sm-2 col-form-label">Nombre y Apellido:</label>
                    <div class="col-sm-10">
                        {{ $retiro->nombre }}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="institucion" class="col-sm-2 col-form-label">Escuela / Institución:</label>
                    <div class="col-sm-10">
                        {{ $retiro->institucion }}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="evento" class="col-sm-2 col-form-label">Evento:</label>
                    <div class="col-sm-10">
                        {{ $retiro->evento }}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="distrito_id" class="col-sm-2 col-form-label">Distrito:</label>
                    <div class="col-sm-10">
                        {{ $retiro->nombreDistrito }}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="proyecto_institucional" class="col-sm-2 col-form-label">Proyecto Institucional:</label>
                    <div class="col-sm-10">
                        {{ $retiro->proyecto_institucional }}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fecha" class="col-sm-2 col-form-label">Fecha (dd/mm/aaaa):</label>
                    <div class="col-sm-10">
                        {{ \Carbon\Carbon::parse($retiro->fecha)->format('d/m/Y')}}
                    </div>
                </div>
                <hr />
                <div class="container" data-original-title="">
                    <div class="row" data-original-title="">
                        <div class="col-md-2" align="left" data-original-title="">
                            <h3>Materialidad </h3>
                        </div>
                        <div class="col-md-2" align="left" data-original-title="">
                            <h3>Cantidad Pedida (Gs.) </h3>
                        </div>
                        @if ($retiro->aprobado == 'N')
                            <div class="col-md-2" align="left" data-original-title="">
                                <h3>Stock (Gs.) </h3>
                            </div>
                        @endif
                        <div class="col-md-6" align="left" data-original-title="">
                            <h3>Observaciones del solicitante</h3>
                        </div>
                    </div>
                    <div class="row bkg-1" data-original-title="">
                        <div class="col-md-2" align="left" data-original-title="">
                            <h3>MADERA</h3>
                        </div>
                        <div class="col-md-2" align="left" data-original-title="">
                            <input type="number" min="0" class="form-control text-center" value="{{ $retiro->madera }}" id="inputMadera" name="madera" placeholder="" onkeydown="javascript: return event.keyCode == 69 ? false : true" />
                        </div>
                        @if ($retiro->aprobado == 'N')
                        <div class="col-md-2" align="center" data-original-title="">
                            <input type="number" id="inputStockMadera" class="form-control text-center" value="{{ $stock["MAD"] }}" disabled />
                        </div>
                        @endif
                        <div class="col-md-6" align="left" data-original-title="">
                            {{ $retiro->madera_obs }}
                        </div>
                    </div>
                    <div class="row bkg-2" data-original-title="">
                        <div class="col-md-2" align="left" data-original-title="">
                            <h3>PAPEL</h3>
                        </div>
                        <div class="col-md-2" align="left" data-original-title="">
                            <input type="number" min="0" class="form-control text-center" value="{{ $retiro->papel }}" id="inputPapel" name="papel" placeholder="" onkeydown="javascript: return event.keyCode == 69 ? false : true" />
                        </div>
                        @if ($retiro->aprobado == 'N')
                        <div class="col-md-2" align="center" data-original-title="">
                            <input type="number" id="inputStockPapel" class="form-control text-center" value="{{ $stock["PYC"] }}" disabled />
                        </div>
                        @endif
                        <div class="col-md-6" align="left" data-original-title="">
                            {{ $retiro->papel_obs }}
                        </div>
                    </div>
                    <div class="row bkg-2" data-original-title="">
                        <div class="col-md-2" align="left" data-original-title="">
                            <h3>PLÁSTICO</h3>
                        </div>
                        <div class="col-md-2" align="left" data-original-title="">
                            <input type="number" min="0" class="form-control text-center" value="{{ $retiro->plastico }}" id="inputPlastico" name="plastico" placeholder="" onkeydown="javascript: return event.keyCode == 69 ? false : true" />
                        </div>
                        @if ($retiro->aprobado == 'N')
                        <div class="col-md-2" align="center" data-original-title="">
                            <input type="number" id="inputStockPlastico" class="form-control text-center" value="{{ $stock["PLA"] }}" disabled />
                        </div>
                        @endif
                        <div class="col-md-6" align="left" data-original-title="">
                            {{ $retiro->plastico_obs }}
                        </div>
                    </div>
                    <div class="row bkg-1" data-original-title="">
                        <div class="col-md-2" align="left" data-original-title="">
                            <h3>METAL</h3>
                        </div>
                        <div class="col-md-2" align="left" data-original-title="">
                            <input type="number" min="0" class="form-control text-center" value="{{ $retiro->metal }}" id="inputMetal" name="metal" placeholder="" onkeydown="javascript: return event.keyCode == 69 ? false : true" />
                        </div>
                        @if ($retiro->aprobado == 'N')
                        <div class="col-md-2" align="center" data-original-title="">
                            <input type="number" id="inputStockMetal" class="form-control text-center" value="{{ $stock["MET"] }}" disabled />
                        </div>
                        @endif
                        <div class="col-md-6" align="left" data-original-title="">
                            {{ $retiro->metal_obs }}
                        </div>
                    </div>
                    <div class="row bkg-2" data-original-title="">
                        <div class="col-md-2" align="left" data-original-title="">
                            <h3>TEXTIL</h3>
                        </div>
                        <div class="col-md-2" align="left" data-original-title="">
                            <input type="number" min="0" class="form-control text-center" value="{{ $retiro->textil }}" id="inputTextil" name="textil" placeholder="" onkeydown="javascript: return event.keyCode == 69 ? false : true" />
                        </div>
                        @if ($retiro->aprobado == 'N')
                        <div class="col-md-2" align="center" data-original-title="">
                            <input type="number" id="inputStockTextil" class="form-control text-center" value="{{ $stock["TEX"] }}" disabled />
                        </div>
                        @endif
                        <div class="col-md-6" align="left" data-original-title="">
                            {{ $retiro->textil_obs }}
                        </div>
                    </div>
                    <div class="row bkg-1" data-original-title="">
                        <div class="col-md-2" align="left" data-original-title="">
                            <h3>VIDRIO</h3>
                        </div>
                        <div class="col-md-2" align="left" data-original-title="">
                            <input type="number" min="0" class="form-control text-center" value="{{ $retiro->vidrio }}" id="inputVidrio" name="vidrio" placeholder="" onkeydown="javascript: return event.keyCode == 69 ? false : true" />
                        </div>
                        @if ($retiro->aprobado == 'N')
                        <div class="col-md-2" align="center" data-original-title="">
                            <input type="number" id="inputStockVidrio" class="form-control text-center" value="{{ $stock["VID"] }}" disabled />
                        </div>
                        @endif
                        <div class="col-md-6" align="left" data-original-title="">
                            {{ $retiro->vidrio_obs }}
                        </div>
                    </div>
                    <div class="row bkg-2" data-original-title="">
                        <div class="col-md-2" align="left" data-original-title="">
                            <h3>NATURAL</h3>
                        </div>
                        <div class="col-md-2" align="left" data-original-title="">
                            <input type="number" min="0" class="form-control text-center" value="{{ $retiro->natural }}" id="inputNatural" name="natural" placeholder="" onkeydown="javascript: return event.keyCode == 69 ? false : true" />
                        </div>
                        @if ($retiro->aprobado == 'N')
                        <div class="col-md-2" align="center" data-original-title="">
                            <input type="number" id="inputStockNatural" class="form-control text-center" value="{{ $stock["NAT"] }}" disabled />
                        </div>
                        @endif
                        <div class="col-md-6" align="left" data-original-title="">
                            {{ $retiro->natural_obs }}
                        </div>
                    </div>
                    <div class="row bkg-2" data-original-title="">
                        <div class="col-md-2" align="left" data-original-title="">
                            <h3>OTROS</h3>
                        </div>
                        <div class="col-md-2" align="left" data-original-title="">
                            <input type="number" min="0" class="form-control text-center" value="{{ $retiro->otros }}" id="inputOtros" name="otros" placeholder="" onkeydown="javascript: return event.keyCode == 69 ? false : true" />
                        </div>
                        @if ($retiro->aprobado == 'N')
                        <div class="col-md-2" align="center" data-original-title="">
                            <input type="number" id="inputStockOtros" class="form-control text-center" value="{{ $stock["OTR"] }}" disabled />
                        </div>
                        @endif
                        <div class="col-md-6" align="left" data-original-title="">
                            {{ $retiro->otros_obs }}
                        </div>
                    </div>
                    <div class="text-center">
                    <button class="btn boton btn-lg" id="butVolver">Volver</button>
                    @if ($retiro->aprobado == 'N')
                        <button type="button" class="btn btn-lg btn-primary" id="butAprobarRetiro">Aprobar retiro</button>
                        <input type="hidden" name="valido" id="inputValido" value="S" />
                        <button class="btn btn-lg btn-danger" type="button" id="butEliminarRetiro">Eliminar</button>
                    
                    @else
                        <div class="alert alert-warning text-center">Retiro aprobado por <strong>{{ $retiro->aprobador }}</strong> en <strong>{{ $retiro->aprobado_fecha }}</strong>.</div>
                    @endif
                    </div>
                    <div class="clearfix" data-original-title=""> </div>
                    <hr />
                </div>
            </div>
        </form>
        @if($isAdmin == true)
            <form action="{{ route('retiros.destroy', $retiro_id)}}" method="post" id="formEliminarRetiro">
                @csrf
                @method('DELETE')
            </form>
        @endif        
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
    $(document).ready(function() {
        $("#navbar li").removeClass('menulink-active');
        $("#navbar li#menulink-admin-retiros").addClass('menulink-active');
    });

    $("#butAprobarRetiro").click(function() {
        var valido = $("#inputValido").val();
        if (valido == 'N'){
            var msg = "ERROR: Algunos materiales no tienen suficiente stock.\n Por favor, ajustá las cantidades para poder aprobar el Retiro.";
            alert(msg);
        } else {
                var rdo = confirm("Las cantidades pedidas son válidas. ¿Aprobar solicitud de retiro?");
            if (rdo) {
                $("#formRetiro").submit();
            }
        }
    });

    $("#butEliminarRetiro").click(function(){
        var rdo =confirm("¿Desea eliminar este retiro");
        if (rdo) {
            $("#formEliminarRetiro").submit();
        };
      });

    $("#butVolver").click(function() {
        window.location.href = "../retiros_pendientes";
        return false;
    });

    function checkStock(){
        var valido = 'S';

        if ( parseFloat($("#inputMadera").val()) > parseFloat($("#inputStockMadera").val()) ) {
            valido = 'N';
            $("#inputMadera").addClass('sin-stock');
        } else {
            $("#inputMadera").removeClass('sin-stock');
        }
        if ( parseFloat($("#inputPapel").val()) > parseFloat($("#inputStockPapel").val()) ) {
            valido = 'N';
            $("#inputPapel").addClass('sin-stock');
        } else {
            $("#inputPapel").removeClass('sin-stock');
        }  
        if ( parseFloat($("#inputCarton").val()) > parseFloat($("#inputStockCarton").val()) ) {
            valido = 'N';
            $("#inputCarton").addClass('sin-stock');
        } else {
            $("#inputCarton").removeClass('sin-stock');
        } 
        if ( parseFloat($("#inputPlastico").val()) > parseFloat($("#inputStockPlastico").val()) ) {
            valido = 'N';
            $("#inputPlastico").addClass('sin-stock');
        } else {
            $("#inputPlastico").removeClass('sin-stock');
        }
        if ( parseFloat($("#inputMetal").val()) > parseFloat($("#inputStockMetal").val()) ) {
            valido = 'N';
            $("#inputMetal").addClass('sin-stock');
        } else {
            $("#inputMetal").removeClass('sin-stock');
        } 
        if ( parseFloat($("#inputTextil").val()) > parseFloat($("#inputStockTextil").val()) ) {
            valido = 'N';
            $("#inputTextil").addClass('sin-stock');
        } else {
            $("#inputTextil").removeClass('sin-stock');
        }
        if ( parseFloat($("#inputVidrio").val()) > parseFloat($("#inputStockVidrio").val()) ) {
            valido = 'N';
            $("#inputVidrio").addClass('sin-stock');
        } else {
            $("#inputVidrio").removeClass('sin-stock');
        } 
        if ( parseFloat($("#inputNatural").val()) > parseFloat($("#inputStockNatural").val()) ) {
            valido = 'N';
            $("#inputNatural").addClass('sin-stock');
        } else {
            $("#inputNatural").removeClass('sin-stock');
        } 
        if ( parseFloat($("#inputOtros").val()) > parseFloat($("#inputStockOtros").val()) ) {
            valido = 'N';
            $("#inputOtros").addClass('sin-stock');
        } else {
            $("#inputOtros").removeClass('sin-stock');
        }     

        $("#inputValido").val(valido);
    }

        $("#formRetiro input").blur(function(){
         @if ($retiro->aprobado == 'N')
          checkStock();  
         @endif
        });

        $(document).ready( function () {
             @if ($retiro->aprobado == 'N') 
                checkStock(); 
             @endif
             @if ($retiro->aprobado == 'S') {
                $("#formRetiro input").prop("readonly", true);
                $("#formRetiro input").attr("readonly", 'readonly');
             }
             @endif
        });

    </script>
</body>

</html>
