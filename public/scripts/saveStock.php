<?php
error_reporting( E_ALL & ~E_NOTICE );
include('conn.php');
$link = Conectarse();

// Registro el stock actual.

$r = mysqli_fetch_assoc(mysqli_query($link, "SELECT stock FROM stock WHERE nombre = 'MADERA'"));
$stMadera = $r["stock"];
$r = mysqli_fetch_assoc(mysqli_query($link, "SELECT stock FROM stock WHERE nombre = 'PAPEL'"));
$stPapel = $r["stock"];
$r = mysqli_fetch_assoc(mysqli_query($link, "SELECT stock FROM stock WHERE nombre = 'PLASTICO'"));
$stPlastico = $r["stock"];
$r = mysqli_fetch_assoc(mysqli_query($link, "SELECT stock FROM stock WHERE nombre = 'METAL'"));
$stMetal = $r["stock"];
$r = mysqli_fetch_assoc(mysqli_query($link, "SELECT stock FROM stock WHERE nombre = 'TEXTIL'"));
$stTextil = $r["stock"];
$r = mysqli_fetch_assoc(mysqli_query($link, "SELECT stock FROM stock WHERE nombre = 'VIDRIO'"));
$stVidrio = $r["stock"];
$r = mysqli_fetch_assoc(mysqli_query($link, "SELECT stock FROM stock WHERE nombre = 'NATURAL'"));
$stNatural = $r["stock"];
$r = mysqli_fetch_assoc(mysqli_query($link, "SELECT stock FROM stock WHERE nombre = 'OTROS'"));
$stOtros = $r["stock"];

$sql = "SELECT stock_id FROM stock_historico WHERE fecha ='".date('Y-m-d')."'";
$r = mysqli_query($link, $sql);
if (mysqli_num_rows( $r ) > 0){
	$row = mysqli_fetch_assoc($r);
	$stock_id = $row["stock_id"];
	$sql = "UPDATE stock_historico SET madera='".$stMadera."',papel='".$stPapel."',plastico='".$stPlastico."',metal='".$stMetal."',textil='".$stTextil."',vidrio='".$stVidrio."',naturales='".$stNatural."',otros='".$stOtros."' 
	WHERE stock_id = ".$stock_id;

} else {
	$sql = "INSERT INTO stock_historico(fecha,madera,papel,plastico,metal,textil,vidrio,naturales,otros) VALUES (NOW(),'".$stMadera."','".$stPapel."','".$stPlastico."','".$stMetal."','".$stTextil."','".$stVidrio."','".$stNatural."','".$stOtros."')";
}
mysqli_query($link, $sql);
if (mysqli_errno($link) > 0) { echo mysqli_errno($link) . ": " . mysqli_error($link). "<br>"; }
?>