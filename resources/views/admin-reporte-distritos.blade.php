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
            <h3>Retiros por Distrito Educativo</h3>
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
        <div class="row well noline" id="divTableResultados" style="display:none">
            <div class="text-right"><button class="btn" onclick="javascript:exportCSV();">Exportar</button></div>
            <div class="col-md-6">
                <div id="divMapa" class="mapaDistrito0" >
                    <img src="{{ asset('images/pix.png') }}" style="width: 550px; height: 550px" usemap="#mapaDistritos"/>
                    <map name="mapaDistritos">
  <area shape="poly" coords="374,125,464,180,450,195,466,241,362,254,360,214,364,197,335,173,374,124" href="javascript:mostrarMapa(1);" alt="DE1">
  <area shape="poly" coords="271,225,332,177,360,199,357,210,357,223,361,254,319,258,304,263,305,244,292,244,278,243,273,236,270,224" href="javascript:mostrarMapa(2);" alt="DE2">
  <area shape="poly" coords="368,257,431,251,430,307,387,314,386,310,375,309,375,319,371,318,363,281,366,267,370,256" href="javascript:mostrarMapa(3);" alt="DE3">
  <area shape="poly" coords="460,215,482,211,493,225,500,231,504,245,513,259,519,272,519,281,525,290,530,312,521,315,503,318,498,325,486,311,462,295,468,305,480,321,484,333,478,344,472,347,466,348,474,360,451,378,445,385,438,398,422,361,437,355,435,328,440,320,438,315,434,314,434,251,471,241,462,217" href="javascript:mostrarMapa(4);" alt="DE4">
  <area shape="poly" coords="324,406,326,346,379,333,373,324,386,318,429,308,430,315,430,322,433,353,418,357,430,398,408,401,387,410,378,415,348,410,325,406" href="javascript:mostrarMapa(5);" alt="DE5">
  <area shape="poly" coords="308,265,317,260,365,257,359,268,359,274,372,332,313,347,302,291,309,290,308,264" href="javascript:mostrarMapa(6);" alt="DE6">
  <area shape="poly" coords="198,244,208,238,219,240,251,209,267,229,269,239,273,244,281,247,290,246,300,246,303,263,226,301,197,245" href="javascript:mostrarMapa(7);" alt="DE7">
  <area shape="poly" coords="233,303,303,268,305,275,307,288,299,290,309,348,256,359,256,352,248,335,236,323,233,302" href="javascript:mostrarMapa(8);" alt="DE8">
  <area shape="poly" coords="208,147,238,158,238,165,253,173,247,199,270,224,332,175,347,148,355,149,365,133,370,121,367,115,361,115,354,117,346,104,334,92,314,82,297,77,299,71,291,70,254,99,258,104,225,127,208,147" href="javascript:mostrarMapa(9);" alt="DE9">
  <area shape="poly" coords="132,56,203,20,215,3,220,3,230,9,238,20,245,32,261,34,263,42,273,44,281,54,288,58,289,68,251,97,253,103,218,129,198,152,164,106,132,57" href="javascript:mostrarMapa(10);" alt="DE10">
  <!--<area shape="poly" coords="144,332" href="javascript:mostrarMapa(11);" alt="DE11">-->
  <area shape="poly" coords="144,332,213,397,253,354,248,340,239,329,231,321,225,306,145,332" href="javascript:mostrarMapa(11);" alt="DE11">
  <area shape="poly" coords="126,285,142,270,154,262,168,254,181,246,191,241,198,254,206,267,211,277,215,289,223,304,154,327,148,310,142,300,128,286" href="javascript:mostrarMapa(12);" alt="DE12">
  <area shape="poly" coords="142,332,211,400,162,450,81,372,96,351,89,344,143,333" href="javascript:mostrarMapa(13);" alt="DE13">
  <area shape="poly" coords="165,253,150,232,153,227,147,218,129,216,123,203,135,203,153,189,165,179,173,171,184,162,192,157,201,152,207,147,213,151,221,154,235,161,234,166,249,174,244,197,249,209,216,236,207,234,191,242,190,240,166,252" href="javascript:mostrarMapa(14);" alt="DE14">
  <area shape="poly" coords="129,60,162,105,195,154,153,186,105,117,96,110,108,70,128,60" href="javascript:mostrarMapa(15);" alt="DE15">
  <area shape="poly" coords="94,111,110,124,123,145,151,187,139,198,123,202,112,205,91,207,75,218,48,239,45,236,93,111,42,243" href="javascript:mostrarMapa(16);" alt="DE16">
  <area shape="poly" coords="34,307,59,292,64,294,76,279,93,265,106,254,128,279,140,269,150,262,158,257,162,256,148,234,151,225,145,218,130,217,121,206,92,209,50,240,45,239,31,272,34,306,34,313,56,296" href="javascript:mostrarMapa(17);" alt="DE17">
  <area shape="poly" coords="69,285,107,257,127,281,125,284,138,298,147,313,153,328,88,344,65,343,50,343,36,344,35,310,61,294,67,288" href="javascript:mostrarMapa(18);" alt="DE18">
  <area shape="poly" coords="214,399,253,357,262,360,322,348,320,406,301,417,291,429,275,451,253,438,214,400" href="javascript:mostrarMapa(19);" alt="DE19">
  <area shape="poly" coords="35,347,81,347,88,345,92,352,76,372,159,451,133,476,36,391,36,347" href="javascript:mostrarMapa(20);" alt="DE20">
    <area shape="poly" coords="134,479,212,402,251,440,274,452,209,547,134,478" href="javascript:mostrarMapa(21);" alt="DE21">




                    </map>
                </div>
            </div>
            <div class="col-md-6">
            <table class="table table-stripped" id="tableResultados">
                <tr><td colspan="11" class="text-center" id="tdTituloTabla"></td></tr>
                <tr>
                    <td class="text-left">Distrito</td>
                    <td class="text-center">Cantidad de Retiros</td>
                    <td class="text-center">Total (grs)</td>
                    <td class="text-center">Madera (grs)</td>
                    <td class="text-center">Papel y Cartón (grs)</td>
                    <td class="text-center">Plastico (grs)</td>
                    <td class="text-center">Metal (grs)</td>
                    <td class="text-center">Textil (grs)</td>
                    <td class="text-center">Vidrio (grs)</td>
                    <td class="text-center">Natural (grs)</td>
                    <td class="text-center">Otros (grs)</td>
                </tr>
                <tr id="tableRow1" class="selectable-row">
                    <td>1</td>
                    <td class="text-center" ><span id="sp_D1TotalRetiros" class="label spanValue label-default">0</span></td>
                    <td class="text-center" ><span id="sp_D1Total" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D1Madera" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D1Papel" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D1Plastico" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D1Metal" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D1Textil" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D1Vidrio" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D1Natural" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D1Otros" class="label spanValue label-default">0</span></td>
                </tr>
                <tr id="tableRow2" class="selectable-row">
                    <td>2</td>
                    <td class="text-center" ><span id="sp_D2TotalRetiros" class="label spanValue label-default">0</span></td>
                    <td class="text-center" ><span id="sp_D2Total" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D2Madera" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D2Papel" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D2Plastico" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D2Metal" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D2Textil" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D2Vidrio" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D2Natural" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D2Otros" class="label spanValue label-default">0</span></td>
                </tr>
                <tr id="tableRow3" class="selectable-row">
                    <td>3</td>
                    <td class="text-center" ><span id="sp_D3TotalRetiros" class="label spanValue label-default">0</span></td>
                    <td class="text-center" ><span id="sp_D3Total" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D3Madera" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D3Papel" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D3Plastico" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D3Metal" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D3Textil" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D3Vidrio" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D3Natural" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D3Otros" class="label spanValue label-default">0</span></td>
                </tr>
                <tr id="tableRow4" class="selectable-row" >
                    <td>4</td>
                    <td class="text-center" ><span id="sp_D4TotalRetiros" class="label spanValue label-default">0</span></td>
                    <td class="text-center" ><span id="sp_D4Total" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D4Madera" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D4Papel" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D4Plastico" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D4Metal" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D4Textil" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D4Vidrio" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D4Natural" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D4Otros" class="label spanValue label-default">0</span></td>                    
                </tr>
                <tr id="tableRow5" class="selectable-row">
                    <td>5</td>
                    <td class="text-center" ><span id="sp_D5TotalRetiros" class="label spanValue label-default">0</span></td>
                    <td class="text-center" ><span id="sp_D5Total" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D5Madera" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D5Papel" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D5Plastico" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D5Metal" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D5Textil" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D5Vidrio" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D5Natural" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D5Otros" class="label spanValue label-default">0</span></td>
                </tr>
                <tr id="tableRow6" class="selectable-row" >
                    <td>6</td>
                    <td class="text-center" ><span id="sp_D6TotalRetiros" class="label spanValue label-default">0</span></td>
                    <td class="text-center" ><span id="sp_D6Total" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D6Madera" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D6Papel" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D6Plastico" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D6Metal" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D6Textil" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D6Vidrio" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D6Natural" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D6Otros" class="label spanValue label-default">0</span></td>
                </tr>
                <tr id="tableRow7" class="selectable-row">
                    <td>7</td>
                    <td class="text-center" ><span id="sp_D7TotalRetiros" class="label spanValue label-default">0</span></td>
                    <td class="text-center" ><span id="sp_D7Total" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D7Madera" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D7Papel" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D7Plastico" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D7Metal" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D7Textil" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D7Vidrio" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D7Natural" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D7Otros" class="label spanValue label-default">0</span></td>
                </tr>
                <tr id="tableRow8" class="selectable-row">
                    <td>8</td>
                    <td class="text-center" ><span id="sp_D8TotalRetiros" class="label spanValue label-default">0</span></td>
                    <td class="text-center" ><span id="sp_D8Total" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D8Madera" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D8Papel" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D8Plastico" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D8Metal" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D8Textil" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D8Vidrio" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D8Natural" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D8Otros" class="label spanValue label-default">0</span></td>
                </tr>
                <tr id="tableRow9" class="selectable-row">
                    <td>9</td>
                    <td class="text-center" ><span id="sp_D9TotalRetiros" class="label spanValue label-default">0</span></td>
                    <td class="text-center" ><span id="sp_D9Total" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D9Madera" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D9Papel" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D9Plastico" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D9Metal" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D9Textil" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D9Vidrio" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D9Natural" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D9Otros" class="label spanValue label-default">0</span></td>
                </tr>
                <tr id="tableRow10" class="selectable-row">
                    <td>10</td>
                    <td class="text-center" ><span id="sp_D10TotalRetiros" class="label spanValue label-default">0</span></td>
                    <td class="text-center" ><span id="sp_D10Total" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D10Madera" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D10Papel" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D10Plastico" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D10Metal" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D10Textil" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D10Vidrio" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D10Natural" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D10Otros" class="label spanValue label-default">0</span></td>
                </tr>
                <tr id="tableRow11" class="selectable-row" >
                    <td>11</td>
                    <td class="text-center" ><span id="sp_D11TotalRetiros" class="label spanValue label-default">0</span></td>
                    <td class="text-center" ><span id="sp_D11Total" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D11Madera" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D11Papel" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D11Plastico" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D11Metal" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D11Textil" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D11Vidrio" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D11Natural" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D11Otros" class="label spanValue label-default">0</span></td>
                </tr>
                <tr id="tableRow12" class="selectable-row">
                    <td>12</td>
                    <td class="text-center" ><span id="sp_D12TotalRetiros" class="label spanValue label-default">0</span></td>
                    <td class="text-center" ><span id="sp_D12Total" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D12Madera" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D12Papel" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D12Plastico" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D12Metal" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D12Textil" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D12Vidrio" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D12Natural" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D12Otros" class="label spanValue label-default">0</span></td>
                </tr>
                <tr id="tableRow13" class="selectable-row">
                    <td>13</td>
                    <td class="text-center" ><span id="sp_D13TotalRetiros" class="label spanValue label-default">0</span></td>
                    <td class="text-center" ><span id="sp_D13Total" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D13Madera" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D13Papel" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D13Plastico" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D13Metal" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D13Textil" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D13Vidrio" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D13Natural" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D13Otros" class="label spanValue label-default">0</span></td>
                </tr>
                <tr id="tableRow14" class="selectable-row">
                    <td>14</td>
                    <td class="text-center" ><span id="sp_D14TotalRetiros" class="label spanValue label-default">0</span></td>
                    <td class="text-center" ><span id="sp_D14Total" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D14Madera" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D14Papel" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D14Plastico" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D14Metal" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D14Textil" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D14Vidrio" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D14Natural" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D14Otros" class="label spanValue label-default">0</span></td>
                </tr>
                <tr id="tableRow15" class="selectable-row">
                    <td>15</td>
                    <td class="text-center" ><span id="sp_D15TotalRetiros" class="label spanValue label-default">0</span></td>
                    <td class="text-center" ><span id="sp_D15Total" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D15Madera" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D15Papel" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D15Plastico" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D15Metal" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D15Textil" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D15Vidrio" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D15Natural" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D15Otros" class="label spanValue label-default">0</span></td>
                </tr>
                <tr id="tableRow16" class="selectable-row">
                    <td>16</td>
                    <td class="text-center" ><span id="sp_D16TotalRetiros" class="label spanValue label-default">0</span></td>
                    <td class="text-center" ><span id="sp_D16Total" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D16Madera" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D16Papel" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D16Plastico" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D16Metal" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D16Textil" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D16Vidrio" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D16Natural" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D16Otros" class="label spanValue label-default">0</span></td>
                </tr>
                <tr id="tableRow17" class="selectable-row" >
                    <td>17</td>
                    <td class="text-center" ><span id="sp_D17TotalRetiros" class="label spanValue label-default">0</span></td>
                    <td class="text-center" ><span id="sp_D17Total" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D17Madera" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D17Papel" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D17Plastico" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D17Metal" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D17Textil" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D17Vidrio" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D17Natural" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D17Otros" class="label spanValue label-default">0</span></td>
                </tr>
                <tr id="tableRow18" class="selectable-row">
                    <td>18</td>
                    <td class="text-center" ><span id="sp_D18TotalRetiros" class="label spanValue label-default">0</span></td>
                    <td class="text-center" ><span id="sp_D18Total" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D18Madera" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D18Papel" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D18Plastico" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D18Metal" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D18Textil" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D18Vidrio" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D18Natural" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D18Otros" class="label spanValue label-default">0</span></td>
                </tr>
                <tr id="tableRow19" class="selectable-row">
                    <td>19</td>
                    <td class="text-center" ><span id="sp_D19TotalRetiros" class="label spanValue label-default">0</span></td>
                    <td class="text-center" ><span id="sp_D19Total" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D19Madera" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D19Papel" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D19Plastico" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D19Metal" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D19Textil" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D19Vidrio" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D19Natural" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D19Otros" class="label spanValue label-default">0</span></td>
                </tr>
                <tr id="tableRow20" class="selectable-row" >
                    <td>20</td>
                    <td class="text-center" ><span id="sp_D20TotalRetiros" class="label spanValue label-default">0</span></td>
                    <td class="text-center" ><span id="sp_D20Total" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D20Madera" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D20Papel" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D20Plastico" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D20Metal" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D20Textil" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D20Vidrio" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D20Natural" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D20Otros" class="label spanValue label-default">0</span></td>
                </tr>
                <tr id="tableRow21" class="selectable-row">
                    <td>21</td>
                    <td class="text-center" ><span id="sp_D21TotalRetiros" class="label spanValue label-default">0</span></td>
                    <td class="text-center" ><span id="sp_D21Total" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D21Madera" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D21Papel" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D21Plastico" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D21Metal" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D21Textil" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D21Vidrio" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D21Natural" class="label spanValue label-default">0</span></td>
                    <td class="text-center"><span id="sp_D21Otros" class="label spanValue label-default">0</span></td>
                </tr>
            </table>
        </div>
        </div>
        <script>

        function mostrarMapa(i){
            $("#divMapa").removeClass();

            if (i == 0){
                $("#divMapa").addClass('mapaDistrito0');
                $(".selectable-row").removeClass('selected-row');
                // $("#tableRow1").removeClass('selected-row');
            } else {
                $(".selectable-row").removeClass('selected-row');
                $("#divMapa").addClass('mapaDistrito'+i);
                $("#tableRow"+i).addClass('selected-row');
            }
        }

        function exportCSV() {
            var csv = '';

            $("#tableResultados tr").each(function () {
              $(this).find('td').each(function(){
                csv += $(this).text() + ";"; 
              });
              csv += "\n";
            });

            var link = '<h4><a class="badge badge-secondary" href="data:application/csv;charset=utf-8,'+encodeURIComponent(csv)+'" download="reporteDistritos.csv">Descargar</a></h4>';

            $("#divLinkDescargaReporte").html(link);
            $("#divModalDescarga").modal('show');

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

        $("#butShowResults").click(function() {
            if (($("#desde_mes").val() == '') || ($("#desde_agno").val() == '') || ($("#hasta_mes").val() == '') || ($("#hasta_agno").val() == '')) {
                alert("Error: Completá todos los campos DESDE y HASTA para continuar.")
            } else {

                var url = './distritos/' + $("#desde_agno").val() + '-' + $("#desde_mes").val() + '-01/' + $("#hasta_agno").val() + '-' + $("#hasta_mes").val() + '-31';

                $.ajax({
                    type: "POST",
                    dataType: 'html',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);
                        var desde = $("#desde_mes").val()+"/"+$("#desde_agno").val();
                        var hasta = $("#hasta_mes").val()+"/"+$("#hasta_agno").val();                        
                        $("#divTableResultados").show();
                        $("#tdTituloTabla").html("<h3>Retiros por Distrito Educativo entre "+desde+" y "+hasta+"</h3>");
                        $(".spanValue").html("0");
                        $(".spanValue").removeClass("label-primary");
                        $(".spanValue").addClass("label-default");

                        var total = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0];
                        for (index = 0; index < obj.length; ++index) {
                            var preffix = "sp_D"+obj[index]["distrito_id"];
                            distrito_id = obj[index]["distrito_id"];
                            if (obj[index]["carton"] > 0) { 
                                $("#"+preffix+"Carton").html(obj[index]["carton"]); 
                                total[distrito_id] += obj[index]["carton"];
                            }
                            if (obj[index]["madera"] > 0) { 
                                $("#"+preffix+"Madera").html(obj[index]["madera"]); 
                                total[distrito_id] += obj[index]["madera"];
                            }
                            if (obj[index]["metal"] > 0) {  
                                $("#"+preffix+"Metal").html(obj[index]["metal"]); 
                                total[distrito_id] += obj[index]["metal"];
                            }
                            if (obj[index]["naturalTotal"] > 0) { 
                            $("#"+preffix+"Natural").html(obj[index]["naturalTotal"]); 
                                total[distrito_id] += obj[index]["naturalTotal"];
                            }
                            if (obj[index]["otros"] > 0) { 
                                $("#"+preffix+"Otros").html(obj[index]["otros"]); 
                                total[distrito_id] += obj[index]["otros"];
                            }
                            if (obj[index]["papel"] > 0) { 
                                $("#"+preffix+"Papel").html(obj[index]["papel"]); 
                                total[distrito_id] += obj[index]["papel"];
                            }
                            if (obj[index]["plastico"] > 0) { 
                                $("#"+preffix+"Plastico").html(obj[index]["plastico"]); 
                                total[distrito_id] += obj[index]["plastico"];
                            }
                            if (obj[index]["textil"] > 0) { 
                                $("#"+preffix+"Textil").html(obj[index]["textil"]); 
                                total[distrito_id] += obj[index]["textil"];
                            }
                            if (obj[index]["vidrio"] > 0) { 
                                $("#"+preffix+"Vidrio").html(obj[index]["vidrio"]); 
                                total[distrito_id] += obj[index]["vidrio"];
                            }
                        }
                        for (index = 0; index < total.length; ++index) {
                            distrito_id = index;
                            $("#sp_D"+distrito_id+"Total").html(total[index]);
                        }

                        var url = './distritosTotales/' + $("#desde_agno").val() + '-' + $("#desde_mes").val() + '-01/' + $("#hasta_agno").val() + '-' + $("#hasta_mes").val() + '-31';

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
                                    $("#sp_D"+obj[index]["distrito_id"]+"TotalRetiros").html(obj[index]["total"]);                                
                                    }
                                    $("#divTableResultados").show();
                                    }
                            });
                    }
                });

            }
        });

        </script>
    </div>
</body>

</html>
