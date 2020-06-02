<?php
function Conectarse(){

// LOCAL

$host_db = "localhost";
$usuario_db = "u597918086_remid";
$pass_db = "pwd1234";
$base_db = "u597918086_remid";

if (!($link=mysqli_connect($host_db, $usuario_db, $pass_db)))
	{
	echo "Error conectando a la base de datos.";
	exit();
	}
if (!mysqli_select_db($link,$base_db))
	{
	echo "Error seleccionando la base de datos";
	exit();
	}
  return $link;
}
?>