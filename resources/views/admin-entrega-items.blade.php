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
            <div class="col-md-6 titulo">Contenido de la Entrega #{{$entrega_id}} ({{ \Carbon\Carbon::parse($entrega->fecha)->format('d/m/Y')}})</div>
            <div class="col-md-6 text-right">
                <button class="btn btn-primary" id="butNuevoItem" type="button">Nuevo contenido</button>
                <button class="btn btn-default" id="butVolver" type="button" onClick="javascript:volver({{$entrega_id}})">Volver</button>
            </div>
        </div>
        <table class="table">
            <tr class="table-header">
                <th>Emprea</th>
                <th>Material</th>
                <th>Cantidad (en KGs)</th>
                <th>Descripcion</th>
                <th></th>
            </tr>
            @foreach ($items as $item)
            <tr class="selectable">
                <td>{{$item->razon_social}}</td>
                <td>{{$item->material}}</td>
                <td>{{$item->cantidad}}</td>
                <td>{{$item->descripcion}}</td>
                <td><button class="btn btn-sm btn-danger" onClick="javascript:eliminarItem({{$item->item_id}},{{$item->entrega_id}});">Eliminar</button></td>
            </tr>
            @endforeach
        </table>
    </div>
    </div>
    <div>{{ $items->links() }}</div>

    <!-- Modal de Validación -->
    <div class="modal fade" id="modalEntregaItem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url("admin/entrega_items/$entrega_id") }}" method="POST"/>
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Agregar:</h4>
                </div>
                <div class="modal-body" id="msgModal">
                
                    <div class="form-group">
                        <label for="empresa_id">Empresa:</label>
                        <select name="empresa_id" id="cmbEmpresa" class="form-control">
                            @foreach ($empresas as $empresa)"
                                <option value="{{ $empresa->empresa_id }}">{{ $empresa->razon_social }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                       <label for="material_id">Material:</label>
                        <select name="material_id" id="cmbMaterial" class="form-control">
                             @foreach ($materiales as $material)
                                <option value="{{ $material->material_id }}">{{ $material->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cantidad">Cantidad (en KGs):</label>
                        <input type="text" name="cantidad" class="form-control" value="0"/>
                    </div>
                    <div class="form-group">
                       <label for="cantidad">Descripcion:</label>
                        <textarea name="descripcion" class="form-control"></textarea>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="entrega_id" value="{{ $entrega_id }}" />
                    <button type="submit" class="btn btn-default">Aceptar</button>
                </div>
            </form>
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
        $("#navbar li#menulink-admin-entregas").addClass('menulink-active');
    });

    function eliminarItem(item_id, entrega_id){
        var rdo = confirm("¿Eliminar este registro?");
        if (rdo){
            $.ajax({
                url: '../entrega_items/' + entrega_id + '/' + item_id,
                type: 'DELETE',
                data : {"_token":"{{ csrf_token() }}"},  //pass the CSRF_TOKEN()
                success: function(result) {
                    var url = "{{ url('/admin/entrega_items/') }}" + "/" + entrega_id;
                    window.location.href = url;
                }
            });
        }
    }

    $("#butNuevoItem").click(function() {
        $('#modalEntregaItem').modal('show');
    });

    function volver(id){
        var url = "{{ url('/admin/entregas/') }}";
        window.location.href = url;
    }

    function verItems(id) {
        var url = "{{ url('/admin/entrega_items/') }}" + "/" + id;
        window.location.href = url;
    }

    </script>
</body>

</html>
