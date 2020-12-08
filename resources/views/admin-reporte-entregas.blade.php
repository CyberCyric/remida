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
    <script src="{{ asset('js/jquery.tabletoCSV.js') }}"></script>

</head>

<body>
    <!-- Modal -->
      <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="divModalDescarga">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Archivo generado</h4>
          </div>
          <div class="modal-body text-center">
            <div id="divLinkDescargaReporte"></div>
          </div>
        </div>
      </div>
      </div>

    <div class="container">
        @include('admin-navbar')
        <div class="row">
            <h3>Entregas</h3>
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
        <div class="row well" style="display:none" id="divTableResultados">
            <canvas id="myChart" ></canvas>
            <hr />
           <div class="text-right"><button class="btn" onclick="javascript:exportCSV();">Exportar</button></div>

            <table class="table table-stripped" id="tableResultados" ></table>
        </div>

        <script>
        var myChart;
        function drawChart(arrData, desde, hasta){
            if (!(myChart === undefined)) {myChart.destroy();}

            var ctx = document.getElementById("myChart").getContext('2d');

            myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Madera', 'Papel y Cartón', 'Plástico', 'Metal', 'Textil', 'Vidrio', 'Natural', 'Otros'],
                    datasets: [{
                        data: [ arrData["MAD"], arrData["PYC"], arrData["PLA"], arrData["MET"], arrData["TEX"], arrData["VID"], arrData["NAT"], arrData["OTR"] ],
                        backgroundColor: [
                            'rgba(230,25,75, 0.4)',
                            'rgba(245,130,49, 0.4)',
                            'rgba(255,225,25, 0.4)',
                            'rgba(188,246,12, 0.4)',
                            'rgba(60,180,75, 0.4)',
                            'rgba(66,99,216, 0.4)',
                            'rgba(145,30,180, 0.4)',
                            'rgba(128,128,128, 0.4)',
                        ],
                        borderColor: [
                            'rgba(230,25,75, 1)',
                            'rgba(245,130,49, 1)',
                            'rgba(255,225,25, 1)',
                            'rgba(188,246,12, 1)',
                            'rgba(60,180,75, 1)',
                            'rgba(66,99,216, 1)',
                            'rgba(145,30,180, 1)',
                            'rgba(128,128,128, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                  title: {
                    display: true,
                    text: "Entregas entre "+desde+" y "+hasta,
                    fontSize: 14,
                  },
                  legend: {
                    display: true,
                  },
                    responsive: true,
                    maintainAspectRatio: true,
                    
                }
            });
       
        }

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

        function exportCSV() {
            var csv = '';

            $("#tableResultados tr").each(function () {
              $(this).find('td').each(function(){
                csv += $(this).text() + ";"; 
              });
              csv += "\n";
            });

            var link = '<h4><a class="badge badge-secondary" href="data:application/csv;charset=utf-8,'+encodeURIComponent(csv)+'" download="reporteEntregas.csv">Descargar</a></h4>';

            $("#divLinkDescargaReporte").html(link);
            $("#divModalDescarga").modal('show');

        }

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
                        var desde = $("#desde_mes").val()+"/"+$("#desde_agno").val();
                        var hasta = $("#hasta_mes").val()+"/"+$("#hasta_agno").val();

                        $("#tableResultados").html('<tr><td colspan="12"><h3 class="text-center">Entregas entre '+desde+' y '+hasta+'</h3></td></tr><tr><strong><td class="text-left">Entrega #</strong></td><td class="text-left"><strong>Empresa</strong></td><td class="text-left"><strong>Tipo</strong></td><td class="text-left"><strong>Fecha</strong></td><td class="text-center"><strong>Madera</strong></td><td class="text-center"><strong>Papel</strong></td><td class="text-center"><strong>Pl&aacute;stico</strong></td><td class="text-center"><strong>Metal</strong></td><td class="text-center"><strong>Textil</strong></td><td class="text-center"><strong>Vidrio</strong></td><td class="text-center"><strong>Natural</strong></td><td class="text-center"><strong>Otros</strong></td></tr>');

                        var total = new Array();

                        for (index = 0; index < obj.length; ++index) {

                            // Creo los Row con valor inicial 0
                            var row = '<tr><td>'+obj[index]["orden"]+'</td><td>'+obj[index]["razon_social"]+'</td><td>'+obj[index]["tipo"]+'</td><td>'+obj[index]["fecha"]+'</td><td class="text-center"><span id="sp_'+obj[index]["item_id"]+'_MAD" class=" spanValue ">0</span></td><td class="text-center"><span id="sp_'+obj[index]["item_id"]+'_PYC" class=" spanValue ">0</span></td><td class="text-center"><span id="sp_'+obj[index]["item_id"]+'_PLA" class=" spanValue ">0</span></td><td class="text-center"><span id="sp_'+obj[index]["item_id"]+'_MET" class=" spanValue ">0</span></td><td class="text-center"><span id="sp_'+obj[index]["item_id"]+'_TEX" class=" spanValue ">0</span></td><td class="text-center"><span id="sp_'+obj[index]["item_id"]+'_VID" class=" spanValue ">0</span></td><td class="text-center"><span id="sp_'+obj[index]["item_id"]+'_NAT" class=" spanValue ">0</span></td><td class="text-center"><span id="sp_'+obj[index]["item_id"]+'_OTR" class=" spanValue ">0</span></td></tr>';                         
                                $("#tableResultados").append(row);                           

                        }

                        total["MAD"] = 0;
                        total["PYC"] = 0;
                        total["PLA"] = 0;
                        total["MET"] = 0;
                        total["TEX"] = 0;
                        total["VID"] = 0;
                        total["NAT"] = 0;
                        total["OTR"] = 0;

                        for (index = 0; index < obj.length; ++index) {
                            
                            // Sumo al total
                            if( obj[index]["codigo"] == "MAD") { total["MAD"] += obj[index]["cantidad"] }
                            if( obj[index]["codigo"] == "PYC") { total["PYC"] += obj[index]["cantidad"] }
                            if( obj[index]["codigo"] == "PLA") { total["PLA"] += obj[index]["cantidad"] }
                            if( obj[index]["codigo"] == "MET") { total["MET"] += obj[index]["cantidad"] }
                            if( obj[index]["codigo"] == "TEX") { total["TEX"] += obj[index]["cantidad"] }
                            if( obj[index]["codigo"] == "VID") { total["VID"] += obj[index]["cantidad"] }
                            if( obj[index]["codigo"] == "NAT") { total["NAT"] += obj[index]["cantidad"] }
                            if( obj[index]["codigo"] == "OTR") { total["OTR"] += obj[index]["cantidad"] }

                            // Cargo la información
                            var cantidad_formateada = new Intl.NumberFormat("de-DE").format(obj[index]["cantidad"]);
                            $("#sp_"+obj[index]["item_id"]+'_'+obj[index]["codigo"]).html(cantidad_formateada);
                            /*
                                if (obj[index]["cantidad"]>0){
                                    $("#sp_"+obj[index]["item_id"]+'_'+obj[index]["codigo"]).removeClass("");
                                    $("#sp_"+obj[index]["item_id"]+'_'+obj[index]["codigo"]).addClass("label-primary");
                                } else {
                                    $("#sp_"+obj[index]["item_id"]+'_'+obj[index]["codigo"]).removeClass("label-primary");
                                    $("#sp_"+obj[index]["item_id"]+'_'+obj[index]["codigo"]).addClass("");
                                }
                            */
                        }

                        // Totales
                        row = '<tr><th class="text-left"></th><th class="text-left"></th><th class="text-left"></th><th class="text-left"></th><th class="text-center">'+new Intl.NumberFormat("de-DE").format(total["MAD"])+'</th><th class="text-center">'+new Intl.NumberFormat("de-DE").format(total["PYC"])+'</th><th class="text-center">'+new Intl.NumberFormat("de-DE").format(total["PLA"])+'</th><th class="text-center">'+new Intl.NumberFormat("de-DE").format(total["MET"])+'</th><th class="text-center">'+new Intl.NumberFormat("de-DE").format(total["TEX"])+'</th><th class="text-center">'+new Intl.NumberFormat("de-DE").format(total["VID"])+'</th><th class="text-center">'+new Intl.NumberFormat("de-DE").format(total["NAT"])+'</th><th class="text-center">'+new Intl.NumberFormat("de-DE").format(total["OTR"])+'</th></tr>';
                        
                        $("#tableResultados").append(row); 

                        var desde = $("#desde_mes").val()+"/"+$("#desde_agno").val();
                        var hasta = $("#hasta_mes").val()+"/"+$("#hasta_agno").val();
                        drawChart(total, desde, hasta);

                    $("#divTableResultados").show();
                    }
                });

            }
        });

        </script>
    </div>
</body>

</html>
