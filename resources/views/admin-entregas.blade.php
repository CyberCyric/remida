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
            <div class="col-md-6 titulo"> Entregas</div>
            <div class="col-md-6 text-right"><button class="btn btn-primary" id="butNuevaEntrega" type="submit">Nueva Entrega</button></div>
        </div>
        <div>
            <h5>Elegir año: 
                @foreach ($agnos as $agno)
                    <a href="{{ url('/admin/entregas/'.$agno->agno) }}">{{ $agno->agno }}</a> |
                @endforeach
            </h5>
        </div>
        <table class="table">
            <tr class="table-header">
                <th><h4>{{$agno_seleccionado}}</h4></th>
                <th></th>
            </tr>
            @foreach ($entregas as $entrega)
            <tr class="selectable" id="row-{{ $entrega->entrega_id }}" onClick="javascript:verItems({{ $entrega->entrega_id }})">
                <td>mes_castellano({{ \Carbon\Carbon::parse($entrega->fecha)->format('m')}}) {{ \Carbon\Carbon::parse($entrega->fecha)->format('d, Y')}}</td>
                <td>Entrega Nro. {{ $entrega->entrega_id }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    </div>
    <div>{{ $entregas->links() }}</div>
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
    $("#butNuevaEntrega").click(function() {
        window.location.href = "entrega/";
    });

    function verItems(id) {
        var url = "{{ url('/admin/entrega_items/') }}" + "/" + id;
        window.location.href = url;
    }

    </script>
</body>

</html>
