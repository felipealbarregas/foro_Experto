<?php

//obtenemos la palabra del formulario y lanzamos la inserccion en la tabla tesauro
include('../includes/dbconnection.php' );

$palabra=$_POST['palabra'];


$sql = "INSERT INTO tesauro (Palabra) VALUES ('$palabra')";
mysqli_query($conexion, $sql);

mysqli_close($conexion);
$url ="http://localhost/ingresarpalabra.html";
$tiempo_espera = 0;
header("refresh: $tiempo_espera; url=$url");
?>
