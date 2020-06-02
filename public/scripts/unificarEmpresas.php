<?php
error_reporting( E_ALL & ~E_NOTICE );
include('conn.php');
$link = Conectarse();

if (isset($_REQUEST["empresa_correcta_id"]) && ($_REQUEST["empresa_eliminar_id"])){
	$r = mysql_query("UPDATE entrega_item SET empresa_id =".$_REQUEST["empresa_correcta_id"]." WHERE empresa_id=".$_REQUEST["empresa_eliminar_id"]);
	$r = mysql_query("DELETE FROM empresas WHERE empresa_id = ".$_REQUEST["empresa_eliminar_id"]);
} else {
?>
<form action="unificarEmpresas.php">
	<div>Empresa Correcta ID:<input type="text" name="empresa_correcta_id" /></div>
	<div>Empresa a Eliminar ID:<input type="text" name="empresa_eliminar_id" /></div>
	<input type="submit"></button>
</form>
<?php	
}
?>