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
            <div class="col-md-6 titulo">Editar Empresa</div>
        </div>
        <form method="POST" action="{{ url("admin/empresa/$empresa->empresa_id") }}" id="formEmpresa">
            {{ csrf_field() }}
            <div class="well">
                <div class="form-group row" id="field_group_1">
                    <label for="input1" class="col-sm-4 col-form-label">
                        Razón Social
                    </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="input_razon_social" name="razon_social" placeholder="" data-toggle="tooltip" title="" value="{{ $empresa->razon_social }}">
                    </div>
                </div>
                <div class="form-group row" id="field_group_4">
                    <label for="input4" class="col-sm-4 col-form-label">
                        Tipo
                    </label>
                    <div class="col-sm-8">
                        <select id="cmbTipo" name="tipo" class="form-control " data-toggle="tooltip" title="">
                            <option {{old('tipo',$empresa->tipo)=="PROPIO"? 'selected':''}} value="PROPIO">Propio</option>
                            <option {{old('tipo',$empresa->tipo)=="ESCUELAS_VERDES"? 'selected':''}} value="ESCUELAS_VERDES">Escuelas Verdes</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row" id="field_group_5">
                    <label for="input5" class="col-sm-4 col-form-label">
                        Nombre del Contacto
                    </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control " id="input5" placeholder="" name="contacto" data-toggle="tooltip" title="" value="{{ $empresa->contacto }}">
                    </div>
                </div>
                <div class="form-group row" id="field_group_5">
                    <label for="input5" class="col-sm-4 col-form-label">
                        Dirección
                    </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control " id="input5" placeholder="" name="direccion" data-toggle="tooltip" title="" value="{{ $empresa->direccion }}">
                    </div>
                </div>
                <div class="form-group row" id="field_group_5">
                    <label for="input5" class="col-sm-4 col-form-label">
                        Telefono
                    </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control " id="input5" placeholder="" name="telefono" data-toggle="tooltip" title="" value="{{ $empresa->telefono }}">
                    </div>
                </div>
                <div class="form-group row" id="field_group_5">
                    <label for="input5" class="col-sm-4 col-form-label">
                        Email
                    </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control " id="input5" placeholder="" name="email" data-toggle="tooltip" title="" value="{{ $empresa->email }}">
                    </div>
                </div>

                  <div class="form-group row" id="field_group_5">
                    <label for="input5" class="col-sm-4 col-form-label">
                    Entrega
                  </label>
                    <div class="col-sm-8">
                      <div>
                        <label>Madera:</label> <input type="checkbox" value="S" name="entrega_madera" @if($empresa->entrega_madera == 'S')
                                            checked="checked"
                                        @endif />
                        <label>Papel:</label> <input type="checkbox" value="S" name="entrega_papel" @if($empresa->entrega_papel == 'S')
                                            checked="checked"
                                        @endif />
                        <label>Cartón:</label> <input type="checkbox" value="S" name="entrega_carton" @if($empresa->entrega_carton == 'S')
                                            checked="checked"
                                        @endif />
                      </div>
                      <div>
                        <label>Plástico:</label> <input type="checkbox" value="S" name="entrega_plastico" @if($empresa->entrega_plastico == 'S')
                                            checked="checked"
                                        @endif />
                        <label>Metal:</label> <input type="checkbox" value="S" name="entrega_metal" @if($empresa->entrega_metal == 'S')
                                            checked="checked"
                                        @endif />
                        <label>Textil:</label> <input type="checkbox" value="S" name="entrega_textil"  @if($empresa->entrega_textil == 'S')
                                            checked="checked"
                                        @endif />
                      </div>
                      <div>
                        <label>Vidrio:</label> <input type="checkbox" value="S" name="entrega_vidrio" @if($empresa->entrega_vidrio == 'S')
                                            checked="checked"
                                        @endif />
                        <label>Natural:</label> <input type="checkbox" value="S" name="entrega_natural" @if($empresa->entrega_natural == 'S')
                                            checked="checked"
                                        @endif />
                        <label>Otros:</label> <input type="checkbox" value="S" name="entrega_otros"  @if($empresa->entrega_otros == 'S')
                                            checked="checked"
                                        @endif />
                      </div>
                    </div>

                  </div>

                <div class="form-group row" id="field_group_5">
                    <label for="input5" class="col-sm-4 col-form-label">
                        Observaciones
                        </h6>
                    </label>
                    <div class="col-sm-8">
                        <textarea class="form-control " id="input5" placeholder="" name="observaciones">{{ $empresa->observaciones }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button class="btn boton" id="butVolver">Volver</button>
                        <button class="btn btn-primary boton" id="butGuardarEmpresa" type="button">Guardar</button>
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
    $(document).ready(function() {
        $("#navbar li").removeClass('menulink-active');
        $("#navbar li#menulink-admin-otros").addClass('menulink-active');
    });

    $("#butGuardarEmpresa").click(function() {
        $("#formEmpresa").submit();
    });

    $("#butVolver").click(function() {
        window.location.href = "../empresas";
    });

    </script>
</body>

</html>
