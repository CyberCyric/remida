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
        <!-- Modal -->
      <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="divModalDescarga">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Archivo generado</h4>
          </div>
          <div class="modal-body text-center">
            <div id="divLinkDescargaReporte">
              <h4><a class="badge badge-secondary" href="{{ asset('/reportes/reporteRetirosPendientes.csv') }}" download="reporteRetirosPendientes.csv">Descargar</a></h4>
            </div>
          </div>
        </div>
      </div>
      </div>
        <canvas id="myChart" width="400" height="400">Chart</canvas>
        <div>
            <hr />
        </div>
        
        <div class="row well" style="display:none" id="divTableResultados">
            <div class="text-right"><button class="btn" onclick="javascript:exportCSV();">Exportar</button></div>
            <table class="table table-stripped" id="tableResultados" >
                <tr><td colspan="10" class="text-center" id="tdTituloTabla"><h3></h3></td><tr>
                <tr>
                    <th class="text-left"><span id="sp_LABEL_LUGARES"></span></th>
                    <th class="text-center"><span id="sp_LABEL_TOTAL_GRAMOS"></span></th>
                    <th class="text-center"><span id="sp_LABEL_MAD"></span></th>
                    <th class="text-center"><span id="sp_LABEL_PYC"></span></th>
                    <th class="text-center"><span id="sp_LABEL_PLA"></span></th>
                    <th class="text-center"><span id="sp_LABEL_MET"></span></th>
                    <th class="text-center"><span id="sp_LABEL_TEX"></span></th>
                    <th class="text-center"><span id="sp_LABEL_VID"></span></th>
                    <th class="text-center"><span id="sp_LABEL_NAT"></span></th>
                    <th class="text-center"><span id="sp_LABEL_OTR"></span></th>
                </tr>
                <tr>
                    <td>Centro </td>
                    <td class="text-center" style="border: #AAA 1px solid; background-color: #e5e5e5;color: #5f4600;font-size: 12px; font-weight: bold"><span id="sp_CENTRO_TOTAL" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_CENTRO_MAD" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_CENTRO_PYC" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_CENTRO_PLA" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_CENTRO_MET" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_CENTRO_TEX" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_CENTRO_VID" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_CENTRO_NAT" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_CENTRO_OTR" class="label spanValue label-default">0</span></td>
                </tr>
                <tr>
                    <td>Viajero</td>
                    <td class="text-center" style="border: #AAA 1px solid; background-color: #e5e5e5;color: #5f4600;font-size: 12px; font-weight: bold"><span id="sp_VIAJERO_TOTAL" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_VIAJERO_MAD" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_VIAJERO_PYC" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_VIAJERO_PLA" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_VIAJERO_MET" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_VIAJERO_TEX" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_VIAJERO_VID" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_VIAJERO_NAT" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_VIAJERO_OTR" class="label spanValue label-default">0</span></td>
                </tr>   
                <tr>
                    <td>Eventos </td>
                    <td class="text-center" style="border: #AAA 1px solid; background-color: #e5e5e5;color: #5f4600;font-size: 12px; font-weight: bold"><span id="sp_EVENTOS_TOTAL" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_EVENTOS_MAD" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_EVENTOS_PYC" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_EVENTOS_PLA" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_EVENTOS_MET" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_EVENTOS_TEX" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_EVENTOS_VID" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_EVENTOS_NAT" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_EVENTOS_OTR" class="label spanValue label-default">0</span></td>
                </tr>    
                <tr>
                    <td></td>
                    <td class="text-center" style="border: #AAA 1px solid; background-color: #e5e5e5;color: #5f4600;font-size: 12px; font-weight: bold"><span id="sp_TOTAL" class="spanValue">0</span></td>
                    <td class="text-center"><span id="sp_TOTAL_MAD" class="spanValue ">0</span></td>
                    <td class="text-center"><span id="sp_TOTAL_PYC" class="spanValue ">0</span></td>
                    <td class="text-center"><span id="sp_TOTAL_PLA" class="spanValue ">0</span></td>
                    <td class="text-center"><span id="sp_TOTAL_MET" class="spanValue ">0</span></td>
                    <td class="text-center"><span id="sp_TOTAL_TEX" class="spanValue ">0</span></td>
                    <td class="text-center"><span id="sp_TOTAL_VID" class="spanValue ">0</span></td>
                    <td class="text-center"><span id="sp_TOTAL_NAT" class="spanValue ">0</span></td>
                    <td class="text-center"><span id="sp_TOTAL_OTR" class="spanValue ">0</span></td>
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

                var url = './retiros/' + $("#desde_agno").val() + '-' + $("#desde_mes").val() + '-01/' + $("#hasta_agno").val() + '-' + $("#hasta_mes").val() + '-31';

                $.ajax({
                    type: "POST",
                    dataType: 'html',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        drawTable(data);
                        drawChart(data);
                }
            })
        }});

        function drawTable(data){
            var obj = JSON.parse(data);
            var desde = $("#desde_mes").val()+"/"+$("#desde_agno").val();
            var hasta = $("#hasta_mes").val()+"/"+$("#hasta_agno").val();

            $("#tdTituloTabla").html("<h3>Retiros entre "+desde+" y "+hasta+"</h3>");
            
            // LABELS
            $("#sp_LABEL_LUGARES").html();
            $("#sp_LABEL_TOTAL_GRAMOS").html("Total en grms");
            $("#sp_LABEL_MAD").html(obj.LABELS[0]);
            $("#sp_LABEL_PYC").html(obj.LABELS[1]);
            $("#sp_LABEL_PLA").html(obj.LABELS[2]);
            $("#sp_LABEL_MET").html(obj.LABELS[3]);
            $("#sp_LABEL_TEX").html(obj.LABELS[4]);
            $("#sp_LABEL_VID").html(obj.LABELS[5]);
            $("#sp_LABEL_NAT").html(obj.LABELS[6]);
            $("#sp_LABEL_OTR").html(obj.LABELS[7]);

            // CENTRO
            centro = obj.DATA.CENTRO[0];
            $("#sp_CENTRO_MAD").html(new Intl.NumberFormat("de-DE").format(centro.MAD));
            $("#sp_CENTRO_PYC").html(new Intl.NumberFormat("de-DE").format(centro.PYC));
            $("#sp_CENTRO_PLA").html(new Intl.NumberFormat("de-DE").format(centro.PLA));
            $("#sp_CENTRO_MET").html(new Intl.NumberFormat("de-DE").format(centro.MET));
            $("#sp_CENTRO_TEX").html(new Intl.NumberFormat("de-DE").format(centro.TEX));
            $("#sp_CENTRO_VID").html(new Intl.NumberFormat("de-DE").format(centro.VID));
            $("#sp_CENTRO_NAT").html(new Intl.NumberFormat("de-DE").format(centro.NAT));
            $("#sp_CENTRO_OTR").html(new Intl.NumberFormat("de-DE").format(centro.OTR));

            // VIAJERO
            viajero = obj.DATA.VIAJERO[0];
            $("#sp_VIAJERO_MAD").html(new Intl.NumberFormat("de-DE").format(viajero.MAD));
            $("#sp_VIAJERO_PYC").html(new Intl.NumberFormat("de-DE").format(viajero.PYC));
            $("#sp_VIAJERO_PLA").html(new Intl.NumberFormat("de-DE").format(viajero.PLA));
            $("#sp_VIAJERO_MET").html(new Intl.NumberFormat("de-DE").format(viajero.MET));
            $("#sp_VIAJERO_TEX").html(new Intl.NumberFormat("de-DE").format(viajero.TEX));
            $("#sp_VIAJERO_VID").html(new Intl.NumberFormat("de-DE").format(viajero.VID));
            $("#sp_VIAJERO_NAT").html(new Intl.NumberFormat("de-DE").format(viajero.NAT));
            $("#sp_VIAJERO_OTR").html(new Intl.NumberFormat("de-DE").format(viajero.OTR));            
            // EVENTOS
            eventos = obj.DATA.EVENTOS[0];
            $("#sp_EVENTOS_MAD").html(new Intl.NumberFormat("de-DE").format(eventos.MAD));
            $("#sp_EVENTOS_PYC").html(new Intl.NumberFormat("de-DE").format(eventos.PYC));
            $("#sp_EVENTOS_PLA").html(new Intl.NumberFormat("de-DE").format(eventos.PLA));
            $("#sp_EVENTOS_MET").html(new Intl.NumberFormat("de-DE").format(eventos.MET));
            $("#sp_EVENTOS_TEX").html(new Intl.NumberFormat("de-DE").format(eventos.TEX));
            $("#sp_EVENTOS_VID").html(new Intl.NumberFormat("de-DE").format(eventos.VID));
            $("#sp_EVENTOS_NAT").html(new Intl.NumberFormat("de-DE").format(eventos.NAT));
            $("#sp_EVENTOS_OTR").html(new Intl.NumberFormat("de-DE").format(eventos.OTR));    

            // TOTALES por LUGAR
            total_gramos_centro = centro.MAD + centro.PYC + centro.PLA + centro.MET + centro.TEX + centro.VID + centro.NAT + centro.OTR;
            $("#sp_CENTRO_TOTAL").html(new Intl.NumberFormat("de-DE").format(total_gramos_centro ));
            total_gramos_viajero = viajero.MAD + viajero.PYC + viajero.PLA + viajero.MET + viajero.TEX + viajero.VID + viajero.NAT + viajero.OTR;
            $("#sp_VIAJERO_TOTAL").html(new Intl.NumberFormat("de-DE").format(total_gramos_viajero ));
            total_gramos_eventos = eventos.MAD + eventos.PYC + eventos.PLA + eventos.MET + eventos.TEX + eventos.VID + eventos.NAT + eventos.OTR;
            $("#sp_EVENTOS_TOTAL").html(new Intl.NumberFormat("de-DE").format(total_gramos_eventos ));

            // TOTALES por MATERIAL
            total_MAD = centro.MAD + viajero.MAD + eventos.MAD;
            $("#sp_TOTAL_MAD").html(new Intl.NumberFormat("de-DE").format(total_MAD));
            total_PYC = centro.PYC + viajero.PYC + eventos.PYC;
            $("#sp_TOTAL_PYC").html(new Intl.NumberFormat("de-DE").format(total_PYC));
            total_PLA = centro.PLA + viajero.PLA + eventos.PLA;
            $("#sp_TOTAL_PLA").html(new Intl.NumberFormat("de-DE").format(total_PLA));
            total_MET = centro.MET + viajero.MET + eventos.MET;
            $("#sp_TOTAL_MET").html(new Intl.NumberFormat("de-DE").format(total_MET));
            total_TEX = centro.TEX + viajero.TEX + eventos.TEX;
            $("#sp_TOTAL_TEX").html(new Intl.NumberFormat("de-DE").format(total_TEX));
            total_VID = centro.VID + viajero.VID + eventos.VID;
            $("#sp_TOTAL_VID").html(new Intl.NumberFormat("de-DE").format(total_VID));
            total_NAT = centro.NAT + viajero.NAT + eventos.NAT;
            $("#sp_TOTAL_NAT").html(new Intl.NumberFormat("de-DE").format(total_NAT));
            total_OTR = centro.OTR + viajero.OTR + eventos.OTR;
            $("#sp_TOTAL_OTR").html(new Intl.NumberFormat("de-DE").format(total_OTR));

            total = total_gramos_centro + total_gramos_viajero + total_gramos_eventos;
            $("#sp_TOTAL").html(new Intl.NumberFormat("de-DE").format(total));

            $("#divTableResultados").show();
        }


        function drawChart(data){
            var obj = jQuery.parseJSON(data);
            var centro = obj.DATA.CENTRO[0];
            var viajeros = obj.DATA.VIAJERO[0];
            var eventos = obj.DATA.EVENTOS[0];

            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: obj.LABELS,
                    datasets: [{
                        label: 'Centro',
                        data: [ centro["MAD"], centro["PYC"], centro["PLA"], centro["MET"], centro["TEX"], centro["VID"], centro["NAT"], centro["OTR"]  ],
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: ['rgba(255, 99, 132, 1)'],
                        borderWidth: 1
                    },
                    {
                        label: 'Viajero',
                       data: [ viajeros["MAD"], viajeros["PYC"], viajeros["PLA"], viajeros["MET"], viajeros["TEX"], viajeros["VID"], viajeros["NAT"], viajeros["OTR"]  ],
                        backgroundColor: 'rgba(188,246,12, 0.4)',
                        borderColor: ['rgba(188,246,12, 0.4)'],
                        borderWidth: 1
                    },
                    {
                        label: 'Eventos',
                        data: [ eventos["MAD"], eventos["PYC"], eventos["PLA"], eventos["MET"], eventos["TEX"], eventos["VID"], eventos["NAT"], eventos["OTR"]  ],
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

        function exportCSV() {
            var csv = '';
            $("#tableResultados tr").each(function () {
              $(this).find('td').each(function(){
                csv += $(this).text() + ";"; 
              });
              csv += "\n";
            });

            var link = '<h4><a class="badge badge-secondary" href="data:application/csv;charset=utf-8,'+encodeURIComponent(csv)+'" download="reporteRetiros.csv">Descargar</a></h4>';

            $("#divLinkDescargaReporte").html(link);
            $("#divModalDescarga").modal('show');
        }
        </script>
    </div>
</body>

</html>
