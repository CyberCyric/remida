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
            <h3>Retiros por Lugar de Retiro</h3>
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
        <canvas id="myChart" width="400" height="400">Chart</canvas>
        <div>
            <hr />
        </div>
        <div class="row well">
            <table class="table table-stripped" id="tableResultados" style="display:none">
                <tr>
                    <th class="text-left">Lugar Entrega</th>
                    <th class="text-center">Total retiros</th>
                    <th class="text-center">Total (gs)</th>
                    <th class="text-center">Madera (gs)</th>
                    <th class="text-center">Papel (gs)</th>
                    <th class="text-center">Cartón (gs)</th>
                    <th class="text-center">Plástico (gs)</th>
                    <th class="text-center">Metal (gs)</th>
                    <th class="text-center">Textil (gs)</th>
                    <th class="text-center">Vidrio (gs)</th>
                    <th class="text-center">Natural (gs)</th>
                    <th class="text-center">Otros (gs)</th>
                </tr>
                <tr>
                    <td>Centro </td>
                    <td class="text-center" style="border: #AAA 1px solid; background-color: #e5e5e5;color: #5f4600;font-size: 12px; font-weight: bold"><span id="sp_CENTRO_TotalRetiros" class="label spanValue label-default">0</span></td>
                    <td class="text-center" style="border: #AAA 1px solid; background-color: #e5e5e5;color: #5f4600;font-size: 12px; font-weight: bold"><span id="sp_CENTRO_TOTAL" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_CENTRO_MADERA" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_CENTRO_PAPEL" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_CENTRO_CARTON" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_CENTRO_PLASTICO" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_CENTRO_METAL" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_CENTRO_TEXTIL" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_CENTRO_VIDRIO" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_CENTRO_NATURAL_TOTAL" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_CENTRO_OTROS" class="label spanValue label-default">0</span></td>
                </tr>
                <tr>
                    <td>Viajero</td>
                    <td class="text-center" style="border: #AAA 1px solid; background-color: #e5e5e5;color: #5f4600;font-size: 12px; font-weight: bold"><span id="sp_VIAJERO_TotalRetiros" class="label spanValue label-default">0</span></td>
                    <td class="text-center" style="border: #AAA 1px solid; background-color: #e5e5e5;color: #5f4600;font-size: 12px; font-weight: bold"><span id="sp_VIAJERO_TOTAL" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_VIAJERO_MADERA" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_VIAJERO_PAPEL" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_VIAJERO_CARTON" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_VIAJERO_PLASTICO" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_VIAJERO_METAL" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_VIAJERO_TEXTIL" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_VIAJERO_VIDRIO" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_VIAJERO_NATURAL_TOTAL" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_VIAJERO_OTROS" class="label spanValue label-default">0</span></td>
                </tr>                
            </table>
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

                var url = './lugares_entrega/' + $("#desde_agno").val() + '-' + $("#desde_mes").val() + '-01/' + $("#hasta_agno").val() + '-' + $("#hasta_mes").val() + '-31';

                $.ajax({
                    type: "POST",
                    dataType: 'html',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);

                        $("#tableResultados").show();
                        $(".spanValue").html("0");
                        $(".spanValue").addClass("label-default");

                        var totalEntregas = {"CENTRO":0,"VIAJERO":0};
                        var total = new Array();
                        total["MADERA"] = 0;
                        total["PAPEL"] = 0;
                        total["CARTON"] = 0;
                        total["PLASTICO"] = 0;
                        total["METAL"] = 0;
                        total["TEXTIL"] = 0;
                        total["VIDRIO"] = 0;
                        total["NATURAL"] = 0;
                        total["OTROS"] = 0;

                        var arrCentro = {"MADERA":0, "PAPEL":0, "CARTON":0, "PLASTICO":0, "METAL":0, "TEXTIL":0, "VIDRIO":0, "NATURAL":0, "OTROS":0};
                        var arrViajero = {"MADERA":0, "PAPEL":0, "CARTON":0, "PLASTICO":0, "METAL":0, "TEXTIL":0, "VIDRIO":0, "NATURAL":0, "OTROS":0}

                        for (index = 0; index < obj.length; ++index) {
                            /* MADERA */
                            if ( (obj[index]["MADERA"] >0) && (obj[index]["lugar_retiro"] != '') ) {
                                $("#sp_"+obj[index]["lugar_retiro"]+"_MADERA").html(obj[index]["MADERA"]);
                                totalEntregas[obj[index]["lugar_retiro"]] += obj[index]["MADERA"];
                                total["MADERA"] += obj[index]["MADERA"];
                                if (obj[index]["lugar_retiro"]=='CENTRO') arrCentro["MADERA"] += obj[index]["MADERA"];
                                if (obj[index]["lugar_retiro"]=='VIAJERO') arrViajero["MADERA"] += obj[index]["MADERA"];
                            }
                            if ( (obj[index]["PAPEL"] >0) && (obj[index]["lugar_retiro"] != '')) {
                                $("#sp_"+obj[index]["lugar_retiro"]+"_PAPEL").html(obj[index]["PAPEL"]);
                                totalEntregas[obj[index]["lugar_retiro"]] += obj[index]["PAPEL"];
                                total["PAPEL"] += obj[index]["PAPEL"];
                            }
                            if ((obj[index]["CARTON"] >0)  && (obj[index]["lugar_retiro"] != '')) {
                                $("#sp_"+obj[index]["lugar_retiro"]+"_CARTON").html(obj[index]["CARTON"]);
                                totalEntregas[obj[index]["lugar_retiro"]] += obj[index]["CARTON"];
                                total["CARTON"] += obj[index]["CARTON"];
                            }
                            if ((obj[index]["PLASTICO"] >0) && (obj[index]["lugar_retiro"] != '')) {
                                $("#sp_"+obj[index]["lugar_retiro"]+"_PLASTICO").html(obj[index]["PLASTICO"]);
                                totalEntregas[obj[index]["lugar_retiro"]] += obj[index]["PLASTICO"];
                                total["PLASTICO"] += obj[index]["PLASTICO"];
                            }
                            if ((obj[index]["METAL"] >0) && (obj[index]["lugar_retiro"] != '')){
                                $("#sp_"+obj[index]["lugar_retiro"]+"_METAL").html(obj[index]["METAL"]);
                                totalEntregas[obj[index]["lugar_retiro"]] += obj[index]["METAL"];
                                total["METAL"] += obj[index]["METAL"];
                            }
                            if ((obj[index]["TEXTIL"] >0) && (obj[index]["lugar_retiro"] != '')){
                                $("#sp_"+obj[index]["lugar_retiro"]+"_TEXTIL").html(obj[index]["TEXTIL"]);
                                totalEntregas[obj[index]["lugar_retiro"]] += obj[index]["TEXTIL"];
                                total["TEXTIL"] += obj[index]["TEXTIL"];
                            }
                            if ((obj[index]["VIDRIO"] >0) && (obj[index]["lugar_retiro"] != '')) {
                                $("#sp_"+obj[index]["lugar_retiro"]+"_VIDRIO").html(obj[index]["VIDRIO"]);
                                totalEntregas[obj[index]["lugar_retiro"]] += obj[index]["VIDRIO"];
                                total["VIDRIO"] += obj[index]["VIDRIO"];
                            }
                            if ((obj[index]["NATURAL_TOTAL"] >0) && (obj[index]["lugar_retiro"] != '')){
                                $("#sp_"+obj[index]["lugar_retiro"]+"_NATURAL").html(obj[index]["NATURAL_TOTAL"]);
                                totalEntregas[obj[index]["lugar_r   etiro"]] += obj[index]["NATURAL_TOTAL"];
                                total["NATURAL"] += obj[index]["N   ATURAL_TOTAL"];
                            }   
                            if ((obj[index]["OTROS"] >0) && (obj[index]["lugar_retiro"] != '')){
                                $("#sp_"+obj[index]["lugar_retiro"]+"_OTROS").html(obj[index]["OTROS"]);
                                totalEntregas[obj[index]["lugar_retiro"]] += obj[index]["OTROS"];
                                total["OTROS"] += obj[index]["OTROS"];
                            }
                        }                  

                        $("#sp_CENTRO_TOTAL").html(totalEntregas["CENTRO"]);
                        $("#sp_VIAJERO_TOTAL").html(totalEntregas["VIAJERO"]);

                        var arrLabels = ['Madera', 'Papel', 'Cartón', 'Plástico', 'Metal', 'Textil', 'Vidrio', 'Natural', 'Otros'];

                        drawChart(arrLabels, arrCentro, arrViajero);

                        row = '<tr><th class="text-left"></th><th class="text-left"></th><th class="text-left"></th><th class="text-center">'+total["MADERA"]+'</th><th class="text-center">'+total["PAPEL"]+'</th><th class="text-center">'+total["CARTON"]+'</th><th class="text-center">'+total["PLASTICO"]+'</th><th class="text-center">'+total["METAL"]+'</th><th class="text-center">'+total["TEXTIL"]+'</th><th class="text-center">'+total["VIDRIO"]+'</th><th class="text-center">'+total["NATURAL"]+'</th><th class="text-center">'+total["OTROS"]+'</th></tr>';
                        
                        $("#tableResultados").append(row);

                        var url = './lugares_entrega_totales/' + $("#desde_agno").val() + '-' + $("#desde_mes").val() + '-01/' + $("#hasta_agno").val() + '-' + $("#hasta_mes").val() + '-31';

                        $.ajax({
                            type: "GET",
                            dataType: 'html',
                            url: url,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {
                                /* MOSTRAR TOTALES */
                                var obj = jQuery.parseJSON(data);

                                for (index = 0; index < obj.length; ++index) {
                                    $("#sp_"+obj[index]["lugar_retiro"]+"_TotalRetiros").html(obj[index]["total"]);
                             
                                }

                            }});
                    }
                });

            }
        });

        function drawChart(arrLabels, arrCentro, arrViajero){
        console.log("CENTRO:"+arrCentro);
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: arrLabels,
                datasets: [{
                    label: 'Centro',
                    data: Array.from(arrCentro),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: ['rgba(255, 99, 132, 1)'],
                    borderWidth: 1
                },
                {
                    label: 'Viajero',
                    data: Array.from(arrViajero),
                    backgroundColor: 'rgba(99, 255, 132, 0.2)',
                    borderColor: ['rgba(99, 255, 132, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        }

        </script>
    </div>
</body>

</html>
