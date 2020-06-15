<?php

//pagina que agrega la respuesta
include('../includes/dbconnection.php' );
//obtenemos los datos del formulario

$id=$_POST['idpregunta'];
$nombre=$_POST['usuario'];
$mensaje=$_POST['mensajeresp'];
$consulta = "SELECT ID FROM Expertos where Nickname='$nombre'";
$resultado = $conexion->query($consulta);
$fila = $resultado->fetch_assoc();
$id_experto =$fila['ID'];
$sql = "INSERT INTO respuestas (ID_pregunta, ID_experto,Mensaje) VALUES ('$id','$id_experto','$mensaje')";
if (mysqli_query($conexion, $sql)) {
      echo "Mensaje enviado correctamente";
//si la inserccion se ha realizado correctamente mostramos el mensaje
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
}


mysqli_close($conexion);
//redireccionamos a mostrarmensaje.html
$url ="http://localhost/preguntascategoria.html";
$tiempo_espera = 2;
header("refresh: $tiempo_espera; url=$url");
?>
