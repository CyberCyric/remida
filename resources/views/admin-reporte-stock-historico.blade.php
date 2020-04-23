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
    <div><hr/></div>

  <div class="row well">
     <canvas id="myChart" width="400" height="400"></canvas>
        <script>

        var labels = {!! json_encode($labels) !!};
        var dsMadera = {!! json_encode($dsMadera) !!};
        var dsPapel = {!! json_encode($dsPapel) !!};
        var dsPlastico = {!! json_encode($dsPlastico) !!};
        var dsMetal = {!! json_encode($dsMetal) !!};
        var dsTextil = {!! json_encode($dsTextil) !!};
        var dsVidrio = {!! json_encode($dsVidrio) !!};
        var dsNatural = {!! json_encode($dsNatural) !!};
        var dsOtros = {!! json_encode($dsOtros) !!};

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels.reverse(),
                datasets: [{
                    label: 'Madera',
                    data: dsMadera.reverse(),
                    backgroundColor: ['rgba(230,25,75, 0.4)'],
                    borderColor: [ 'rgba(230,25,75, 0.4)'],
                    fill: false,
                    borderWidth: 1
                },
                {
                    label: 'Papel',
                    data: dsPapel.reverse(),
                    backgroundColor: ['rgba(245,130,49, 0.4)'],
                    borderColor: ['rgba(245,130,49, 1)'],
                    fill: false,
                    borderWidth: 1
                },
                {
                    label: 'Plástico',
                    data: dsPlastico.reverse(),
                    backgroundColor: ['rgba(188,246,12, 0.4)'],
                    borderColor: ['rgba(188,246,12, 1)'],
                    fill: false,
                    borderWidth: 1
                },
                {
                    label: 'Metal',
                    data: dsMetal.reverse(),
                    backgroundColor: ['rgba(60,180,75, 0.4)'],
                    borderColor: ['rgba(60,180,75, 1)'],
                    fill: false,
                    borderWidth: 1
                },
                {
                    label: 'Textil',
                    data: dsTextil.reverse(),
                    backgroundColor: ['rgba(66,99,216, 0.4)'],
                    borderColor: ['rgba(66,99,216, 1)'],
                    fill: false,
                    borderWidth: 1
                },
                {
                    label: 'Vidrio',
                    data: dsVidrio.reverse(),
                    backgroundColor: ['rgba(145,30,180, 0.4)'],
                    borderColor: ['rgba(145,30,180, 1)'],
                    fill: false,
                    borderWidth: 1
                },
                {
                    label: 'Natural',
                    data: dsNatural.reverse(),
                    backgroundColor: ['rgba(128,128,128, 0.4)'],
                    borderColor: ['rgba(128,128,128, 1)'],
                    fill: false,
                    borderWidth: 1
                },
                {
                    label: 'Otros',
                    data: dsOtros.reverse(),
                    // backgroundColor: ['rgba(145,30,180, 0.4)'],
                    // borderColor: ['rgba(145,30,180, 1)'],
                    fill: false,
                    borderWidth: 1
                },

                ]
            },
            options: {
                title: {
                    display: true,
                    text: "Stock histórico de Material (en Gramos)",
                    fontSize: 20,
                  },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

    $( document ).ready(function() {
        $("#navbar li").removeClass('menulink-active');
        $("#navbar li#menulink-admin-reportes").addClass('menulink-active');
     });
    </script>
  </div>
</div>


  </body>
</html>