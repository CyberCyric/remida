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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>

  </head> 
        
  <body>
    <div class="container">
    @include('admin-navbar')

    <div class="row">
        <div class="alert-spot alert-spot-success col-md-4 dashboard-boxes">
        <span class="glyphicon glyphicon-log-in"></span>
        <div class="alert-link-text">
          <h4>Entregas: {{ $entregas }}</h4>
          <p class="dashboard-copete">Cantidad de entregas recibidas.</p>
        </div>
        </div>
        <div class="alert-spot alert-spot-info col-md-4 dashboard-boxes">
        <span class="glyphicon glyphicon glyphicon-log-out"></span>
        <div class="alert-link-text">
          <h4>Retiros: {{ $retiros }}</h4>
          <p class="dashboard-copete">Cantidad de retiros aprobados.</p>
        </div>
        </div> 
        <div class="alert-spot alert-spot-warning col-md-4 dashboard-boxes">
        <span class="glyphicon glyphicon-briefcase"></span>
        <div class="alert-link-text">
          <h4>Empresas: {{ $empresas }}</h4>
          <p class="dashboard-copete">Cantidad de empresas registradas en el sistema.</p>
        </div>
        </div>
    </div>
    <div><hr/></div>

  <div class="row well">
      <canvas id="myChart" height="400"></canvas>
        <script>

        var arrLabel = new Array();
        var arrData = new Array();
        @foreach ($materiales as $material)
          arrLabel.push("{{$material->nombre}}");
          arrData.push("{{$material->stock}}");
        @endforeach

        displayChart(arrLabel, arrData);

        function displayChart(arrLabel, arrData){
            
            var ctx = document.getElementById("myChart").getContext('2d');
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
            today = dd + '/' + mm + '/' + yyyy;

            var myChart = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: arrLabel,
                    datasets: [{
                        data: arrData,
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
                    text: "Stock actual de Material (en Gramos) - "+today,
                    fontSize: 20,
                  },
                  legend: {
                    display: false,
                  },
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                beginAtZero:true
                            },
                        }]
                    }
                }
            });
          }

    $( document ).ready(function() {
        $("#navbar li").removeClass('menulink-active');
        $("#navbar li#menulink-admin-reportes").addClass('menulink-active');
     });
        </script>
  </div>
</div>


  </body>
</html>