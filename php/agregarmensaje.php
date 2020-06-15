<?php
include('../includes/dbconnection.php' );
//obtenemos los datos del formulario y lanzamos la consulta

$nombre=$_POST['usuario'];
$tema=$_POST['tema'];
$mensaje=$_POST['mensaje'];
$Subcategoria=$_POST['Subcategoria'];
$consulta = "SELECT ID FROM personas where Nickname='$nombre'";
$resultado = $conexion->query($consulta);
$fila = $resultado->fetch_assoc();
$id_personas =$fila['ID'];
$consulta = "SELECT ID FROM usuario where ID_Personas='$id_personas'";
$resultado = $conexion->query($consulta);
$fila1 = $resultado->fetch_assoc();
$id =$fila1['ID'];
$sql = "INSERT INTO preguntas (ID_Usuario, ID_Subcategoria,Tema,Mensaje) VALUES ('$id', '$Subcategoria','$tema','$mensaje')";
if (mysqli_query($conexion, $sql)) {
      echo "Mensaje enviado correctamente";

} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
}





mysqli_close($conexion);
$url ="http://localhost/vermispreguntas.html"; // aqui pones la url
$tiempo_espera = 0; // Aquí se configura cuántos segundos hasta la actualización.
// Declaramos la funcion apra la redirección
header("refresh: $tiempo_espera; url=$url");
?>
