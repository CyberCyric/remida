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
            <div class="col-md-12 titulo">Empresas</div>
        </div>
        <table class="table">
            <tr class="table-header">
                <th>Empresa</th>
                <th>Tipo</th>
                <th>Contacto</th>
            </tr>
            @foreach ($empresas as $empresa)
            <tr class="selectable" id="row-{{ $empresa->empresa_id }}">
                <td>{{ $empresa->razon_social }}</td>
                <td>{{ $empresa->tipo }}</td>
                <td>{{ $empresa->contacto }} ( {{ $empresa->direccion }} | {{ $empresa->email }} | {{ $empresa->telefono }})</td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="row col-md-12 text-right"><button class="btn btn-primary" id="butNuevaEmpresa" type="submit">Nueva Empresa</button></div>
    <div>{{ $empresas->links() }}</div>
    </div>
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

    $("table tr.selectable").click(function() {
        var rowID = this.id
        window.location.href = "empresa/" + rowID.substring(rowID.indexOf("-") + 1, rowID.length);
    });

    $("#butNuevaEmpresa").click(function() {
        window.location.href = "empresa/";
    });

    </script>
</body>

</html>
