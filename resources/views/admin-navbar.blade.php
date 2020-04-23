<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/admin/reportes/stock') }}">ReMIDA ADMIN</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar">
      <ul class="nav navbar-nav">
        <li class="dropdown" id="menulink-admin-reportes">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="{{ url('/admin/reportes/stock') }}">Stock (actual)</a></li>
            <li><a href="{{ url('/admin/reportes/stock_historico') }}">Stock (histórico)</a></li>
            <li><a href="{{ url('/admin/reportes/entregas') }}">Entregas</a></li>
            <li><a href="{{ url('/admin/reportes/retiros') }}">Retiros</a></li>
            <li><a href="{{ url('/admin/reportes/empresas_registradas') }}">Empresas Registradas</a></li>
            <li><a href="{{ url('/admin/reportes/distritos') }}">Distritos Educativos</a></li>            
          </ul>
        </li>
        <li id="menulink-admin-entregas"><a href="{{ url('/admin/entregas') }}">Entregas</a></li>
        <li class="dropdown" id="menulink-admin-retiros">
          <a href="#" class="dropdown-toggle" id="" data-toggle="dropdown">Retiros <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li ><a href="{{ url('/admin/retiros_pendientes') }}">Retiros Pendientes</a></li>
            <li ><a href="{{ url('/admin/retiros_aprobados') }}">Retiros Aprobados</a></li>
            <li role="separator" class="divider"></li>
            <li id="menulink-admin-retiro"><a href="{{ url('/retiro') }}" target="_blank">Solicitar Retiro (EXT)</a></li>
          </ul>
        </li>
        
        <li class="dropdown" id="menulink-admin-otros">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Otros <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li id="menulink-admin-empresas"><a href="{{ url('/admin/empresas') }}">Empresas</a></li>
            <li id="menulink-admin-usuarios"><a href="{{ url('/admin/usuarios') }}">Usuarios</a></li>     
            <li role="separator" class="divider"></li>     
            <li id="menulink-admin-">
              <a href="{{ url('/scripts/saveStock.php') }}" target="_blank">(*) Guardar Stock actual</a>
            </li>
            <!--  
            <li id="menulink-admin-">
              <a href="{{ url('/scripts/resetDatabase.php') }}">(*) Resetear Base de Datos</a>
            </li>
            -->  
          </ul>
        </li>
        <li><a href="{{ url('/admin/ayuda') }}">Ayuda</a></li>
        <li><a href="{{ url('/admin/logout') }}">Salir</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>