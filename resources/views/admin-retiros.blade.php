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
           <div class="col-md-6 titulo">Retiros de material</div>
           <div class="col-md-6 text-right"><button class="btn" onclick="javascript:exportCSV('{{ $aprobado }}');">Exportar</button></div>
      </div>

       <!-- Modal -->
      <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="divModalDescargaAprobados">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Archivo generado</h4>
          </div>
          <div class="modal-body text-center">
            <div id="divLinkDescargaReporte">
              <h4><a class="badge badge-secondary"  href="{{ asset('/reportes/reporteRetirosAprobados.csv') }}" download="reporteRetirosAprobados.csv">Descargar</a></h4>
            </div>
          </div>
        </div>
      </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="divModalDescargaPendientes">
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
      

      <table class="table">
        <tr class="table-header">
          <th>Número</th>
          <th>Fecha</th>
          <th>Lugar</th>
          <th>Escuela / Institución</th>
          <th>Distrito</th>
          <th>Nombre y Apellido</th>
          <th>Evento</th>
          <th>Proyecto Inst.</th>
          <th>Estado</th>
        </tr>
        @foreach ($retiros as $retiro)
          <tr class="selectable" id="row-{{ $retiro->retiro_id }}">
            <td>{{ $retiro->orden }}</td>
            <td>{{ \Carbon\Carbon::parse($retiro->fecha)->format('d/m/Y')}}</td>
            <td>{{ $retiro->lugar_retiro }}</td>
            <td>{{ $retiro->institucion }}</td>
            <td>{{ $retiro->distrito }}</td>
            <td>{{ $retiro->nombre }}</td>
            <td>{{ $retiro->evento }}</td>
            <td>{{ $retiro->proyecto_institucional }}</td>
            <td>
              @if ($retiro->aprobado == 'S')
              <span class="label label-success icono_retiro_aprobado" >
                <span class="glyphicon glyphicon-ok" >Aprobado</span>
              </span>
              @else
              <span class="label label-warning icono_retiro_pendiente">
                <span class="glyphicon glyphicon-time">&nbsp;Pendiente</span>
              </span>
              @endif
             </td>
          </tr>
        @endforeach
      </table>
    </div>

    <div>{{ $retiros->links() }}</div>

    
    </div>

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>

    <script>

     $( document ).ready(function() {
        $("#navbar li").removeClass('menulink-active');
        $("#navbar li#menulink-admin-retiros").addClass('menulink-active');
     });

      $("table tr.selectable").click(function(){
        var rowID = this.id
          window.location.href= "retiro/" + rowID.substring(rowID.indexOf("-")+1, rowID.length);
      });

      function exportCSV(aprobado) {
          if (aprobado == 'S')
            var url = '{{ url("/admin/retiros_aprobados/exportToJson") }}';
          else
            var url = '{{ url("/admin/retiros_pendientes/exportToJson") }}';

          $.ajax({
            url:url,  
            success:function(data) {
              if (aprobado == 'S')
                $("#divModalDescargaAprobados").modal('show');
              if (aprobado == 'N')
                $("#divModalDescargaPendientes").modal('show');
            }
          });
        }

    </script>

  </body>
</html>