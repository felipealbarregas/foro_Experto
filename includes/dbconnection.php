<?php
//conexion a la base de datos

$usuario = "felipe";
$contrasena = "1234";
$servidor = "localhost";
$basededatos = "foro_expertos";

$conexion = mysqli_connect( $servidor, $usuario,$contrasena,$basededatos ) or die ("No se ha podido conectar al servidor de Base de datos");




?>
