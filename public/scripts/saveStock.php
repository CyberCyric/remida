<?php
// Registro el stock actual.

error_reporting( E_ALL & ~E_NOTICE );

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

$link = Conectarse();

$r = mysqli_fetch_assoc(mysqli_query($link, "SELECT stock FROM material WHERE nombre = 'MADERA'"));
$stMadera = $r["stock"];
$r = mysqli_fetch_assoc(mysqli_query($link, "SELECT stock FROM material WHERE nombre = 'PAPEL'"));
$stPapel = $r["stock"];
$r = mysqli_fetch_assoc(mysqli_query($link, "SELECT stock FROM material WHERE nombre = 'CARTON'"));
$stCarton = $r["stock"];
$r = mysqli_fetch_assoc(mysqli_query($link, "SELECT stock FROM material WHERE nombre = 'PLASTICO'"));
$stPlastico = $r["stock"];
$r = mysqli_fetch_assoc(mysqli_query($link, "SELECT stock FROM material WHERE nombre = 'METAL'"));
$stMetal = $r["stock"];
$r = mysqli_fetch_assoc(mysqli_query($link, "SELECT stock FROM material WHERE nombre = 'TEXTIL'"));
$stTextil = $r["stock"];
$r = mysqli_fetch_assoc(mysqli_query($link, "SELECT stock FROM material WHERE nombre = 'VIDRIO'"));
$stVidrio = $r["stock"];
$r = mysqli_fetch_assoc(mysqli_query($link, "SELECT stock FROM material WHERE nombre = 'NATURAL'"));
$stNatural = $r["stock"];
$r = mysqli_fetch_assoc(mysqli_query($link, "SELECT stock FROM material WHERE nombre = 'OTROS'"));
$stOtros = $r["stock"];

$sql = "INSERT INTO stock_historico(fecha,madera,papel,carton,plastico,metal,textil,vidrio,naturales,otros) VALUES (NOW(),'".$stMadera."','".$stPapel."','".$stCarton."','".$stPlastico."','".$stMetal."','".$stTextil."','".$stVidrio."','".$stNatural."','".$stOtros."')";
mysqli_query($link, $sql);
if (mysqli_errno($link) > 0) { echo mysqli_errno($link) . ": " . mysqli_error($link). "<br>"; }
?>