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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <div class="container">
        @include('admin-navbar')
        <div class="row">
            <h3>Entregas por Empresa</h3>
            <form class="form-horizontal text-right">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                Desde:
                <input type="hidden" name="desde_dia" id="desde_dia" value="01" />
                <select name="desde_mes" id="desde_mes">
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
                <input type="number" name="desde_agno" id="desde_agno" value="" maxlength="4" />
                &nbsp;&nbsp;&nbsp;
                Hasta:
                <input type="hidden" name="hasta_dia" id="hasta_dia" value="31" />
                <select name="hasta_mes" id="hasta_mes">
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
                <input type="number" name="hasta_agno" id="hasta_agno" value="" maxlength="4" />
                &nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-lg btn-primary" id="butShowResults">Mostrar</button>
            </form>
        </div>
        <div>
            <hr />
        </div>
        <div class="row well">
            <table class="table table-stripped" id="tableResultados" style="display:none"></table>
        </div>
        <script>
        $(document).ready(function() {
            $("#navbar li").removeClass('menulink-active');
            $("#navbar li#menulink-admin-reportes").addClass('menulink-active');

            var d = new Date();
            var desde_mes = d.getMonth();
            $("#desde_mes").val(desde_mes+1);
            var desde_agno = d.getFullYear();
            $("#desde_agno").val(desde_agno);
            var hasta_mes = d.getMonth();
            $("#hasta_mes").val(hasta_mes+1);
            var hasta_agno = d.getFullYear();
            $("#hasta_agno").val(hasta_agno);

        });

        $("#butShowResults").click(function() {
            if (($("#desde_mes").val() == '') || ($("#desde_agno").val() == '') || ($("#hasta_mes").val() == '') || ($("#hasta_agno").val() == '')) {
                alert("Error: Completá todos los campos DESDE y HASTA para continuar.")
            } else {
                var url = './entregas/' + $("#desde_agno").val() + '-' + $("#desde_mes").val() + '-01/' + $("#hasta_agno").val() + '-' + $("#hasta_mes").val() + '-31';

                $.ajax({
                    type: "POST",
                    dataType: 'html',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    error: function( jqXHR, textStatus, errorThrown ) {
                        console.log(jqXHR.responseText);
                    },
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);

                        $("#tableResultados").html('<tr><th class="text-left">Empresa</th><th class="text-left">Empresa</th><th class="text-left">Cantidad de Entregas</th><th class="text-left">Total</th><th class="text-center">Madera</th><th class="text-center">Papel</th><th class="text-center">Cartón</th><th class="text-center">Plástico</th><th class="text-center">Metal</th><th class="text-center">Textil</th><th class="text-center">Vidrio</th><th class="text-center">Natural</th><th class="text-center">Otros</th></tr>');

                        var total = new Array();

                        for (index = 0; index < obj.length; ++index) {

                            var row = '<tr><td>'+obj[index]["razon_social"]+'</td><td>'+obj[index]["razon_social"]+'</td><td>'+obj[index]["fecha"]+'</td><td class="text-center"><span id="sp_'+obj[index]["item_id"]+'_MADERA" class="label spanValue label-default">0</span></td><td class="text-center"><span id="sp_'+obj[index]["item_id"]+'_PAPEL" class="label spanValue label-default">0</span></td><td class="text-center"><span id="sp_'+obj[index]["item_id"]+'_CARTON" class="label spanValue label-default">0</span></td><td class="text-center"><span id="sp_'+obj[index]["item_id"]+'_PLASTICO" class="label spanValue label-default">0</span></td><td class="text-center"><span id="sp_'+obj[index]["item_id"]+'_METAL" class="label spanValue label-default">0</span></td><td class="text-center"><span id="sp_'+obj[index]["item_id"]+'_TEXTIL" class="label spanValue label-default">0</span></td><td class="text-center"><span id="sp_'+obj[index]["item_id"]+'_VIDRIO" class="label spanValue label-default">0</span></td><td class="text-center"><span id="sp_'+obj[index]["item_id"]+'_NATURAL" class="label spanValue label-default">0</span></td><td class="text-center"><span id="sp_'+obj[index]["item_id"]+'_OTROS" class="label spanValue label-default">0</span></td></tr>';                         
                                $("#tableResultados").append(row);                           

                                // total[obj[index]["item_id"]] = 0;                        
                        }


                        for (index = 0; index < obj.length; ++index) {
                            $("#sp_"+obj[index]["item_id"]+'_'+obj[index]["material"]).html(obj[index]["cantidad"]);
                                if (obj[index]["cantidad"]>0){
                                    $("#sp_"+obj[index]["item_id"]+'_'+obj[index]["material"]).removeClass("label-default");
                                    $("#sp_"+obj[index]["item_id"]+'_'+obj[index]["material"]).addClass("label-primary");
                                } else {
                                    $("#sp_"+obj[index]["item_id"]+'_'+obj[index]["material"]).removeClass("label-primary");
                                    $("#sp_"+obj[index]["item_id"]+'_'+obj[index]["material"]).addClass("label-default");
                                }
                        }

                        $("#tableResultados").show();
                    }
                });

            }
        });

        </script>
    </div>
</body>

</html>
