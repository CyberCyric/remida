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

/* DISTRITOS */
mysqli_query($link, "DELETE FROM distrito");
mysqli_query($link, "INSERT INTO distrito (distrito_id, nombre) VALUES (1, 'Distrito 1')");
mysqli_query($link, "INSERT INTO distrito (distrito_id, nombre) VALUES (2, 'Distrito 2')");
mysqli_query($link, "INSERT INTO distrito (distrito_id, nombre) VALUES (3, 'Distrito 3')");
mysqli_query($link, "INSERT INTO distrito (distrito_id, nombre) VALUES (4, 'Distrito 4')");
mysqli_query($link, "INSERT INTO distrito (distrito_id, nombre) VALUES (5, 'Distrito 5')");
mysqli_query($link, "INSERT INTO distrito (distrito_id, nombre) VALUES (6, 'Distrito 6')");
mysqli_query($link, "INSERT INTO distrito (distrito_id, nombre) VALUES (7, 'Distrito 7')");
mysqli_query($link, "INSERT INTO distrito (distrito_id, nombre) VALUES (8, 'Distrito 8')");
mysqli_query($link, "INSERT INTO distrito (distrito_id, nombre) VALUES (9, 'Distrito 9')");
mysqli_query($link, "INSERT INTO distrito (distrito_id, nombre) VALUES (10, 'Distrito 10')");
mysqli_query($link, "INSERT INTO distrito (distrito_id, nombre) VALUES (11, 'Distrito 11')");
mysqli_query($link, "INSERT INTO distrito (distrito_id, nombre) VALUES (12, 'Distrito 12')");
mysqli_query($link, "INSERT INTO distrito (distrito_id, nombre) VALUES (13, 'Distrito 13')");
mysqli_query($link, "INSERT INTO distrito (distrito_id, nombre) VALUES (14, 'Distrito 14')");
mysqli_query($link, "INSERT INTO distrito (distrito_id, nombre) VALUES (15, 'Distrito 15')");
mysqli_query($link, "INSERT INTO distrito (distrito_id, nombre) VALUES (16, 'Distrito 16')");
mysqli_query($link, "INSERT INTO distrito (distrito_id, nombre) VALUES (17, 'Distrito 17')");
mysqli_query($link, "INSERT INTO distrito (distrito_id, nombre) VALUES (18, 'Distrito 18')");
mysqli_query($link, "INSERT INTO distrito (distrito_id, nombre) VALUES (19, 'Distrito 19')");
mysqli_query($link, "INSERT INTO distrito (distrito_id, nombre) VALUES (20, 'Distrito 20')");
mysqli_query($link, "INSERT INTO distrito (distrito_id, nombre) VALUES (21, 'Distrito 21')");

mysqli_query($link, "DELETE FROM empresa");

mysqli_query($link, "DELETE FROM entrega");

mysqli_query($link, "DELETE FROM entrega_item");

mysqli_query($link, "DELETE FROM material");
mysqli_query($link, "INSERT INTO material (material_id, nombre, stock) VALUES (1, 'MADERA',0)");
mysqli_query($link, "INSERT INTO material (material_id, nombre, stock) VALUES (2, 'PAPEL',0)");
mysqli_query($link, "INSERT INTO material (material_id, nombre, stock) VALUES (3, 'CARTON',0)");
mysqli_query($link, "INSERT INTO material (material_id, nombre, stock) VALUES (4, 'PLASTICO',0)");
mysqli_query($link, "INSERT INTO material (material_id, nombre, stock) VALUES (5, 'METAL',0)");
mysqli_query($link, "INSERT INTO material (material_id, nombre, stock) VALUES (6, 'TEXTIL',0)");
mysqli_query($link, "INSERT INTO material (material_id, nombre, stock) VALUES (7, 'VIDRIO',0)");
mysqli_query($link, "INSERT INTO material (material_id, nombre, stock) VALUES (8, 'NATURAL',0)");
mysqli_query($link, "INSERT INTO material (material_id, nombre, stock) VALUES (9, 'OTROS',0)");

mysqli_query($link, "DELETE FROM retiros");

// mysqli_query($link, "DELETE FROM stock");
// mysqli_query($link, "DELETE FROM users");
// mysqli_query($link, "INSERT INTO users (id, name, email, role, email_verified_at, password, remember_token, created_at, updated_at, active, deleted) VALUES (1, 'Admin', 'admin@admin.com', 'A', NULL, '$2y$10$26M6Z6gG5yGzvSp0jNiXOeq9xvgZrECB25juaFTMOzjpbW3ES1Thy', 'Mcsd9YmbiRxW7YGL3kF277TOb3srAbEcyVA7eDZN7fQA9D9Aus0vqz4cU26x', '2018-10-24 20:18:03', '2019-02-21 19:34:00', 1, 0)");

header("location:../admin/home")
?>