<?php
include('../includes/dbconnection.php' );
//pagina que obtiene el idrespuesta, y el rating(la valoracion de las respuestas)
//e iniciamos un contador a 0 y un total a 0 tambien
$rating=$_GET['rating'];
$id=$_GET['idrespuesta'];
$contador=0;
$total=0;


$sql = "UPDATE respuestas SET Valoracion='$rating' where ID='$id'";//actualizamos la valoracion de la respuesta
if (mysqli_query($conexion, $sql)) {
    echo"se ha actualizado el valor";

} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
}
$consulta = "SELECT ID_experto FROM respuestas where ID='$id'";//ahora obtenemos el id del experto
$resultado = $conexion->query($consulta)or die($conexion->error);
$fila = $resultado->fetch_assoc();
$id1 =$fila['ID_experto'];

$consulta = "SELECT valoracion FROM respuestas where ID_experto='$id1'";//y sacamos la valoracion de todas las respuestas del usuario
$resultado = $conexion->query($consulta)or die($conexion->error);
while($data = mysqli_fetch_array($resultado)){
      $total=$data['valoracion']+$total;//sumamos el valor total de las valoraciones incrementando el total mas la valoracion
      $contador++;//sumamos uno a contador

}
$valoracionusu=$total/$contador;//ahora dividimos el total de las valoraciones entre el contador para obtener la media
$sql = "UPDATE expertos SET puntuacion='$valoracionusu' where ID='$id1'";//actualizamos la tabla experto con su nueva valoracion
mysqli_query($conexion, $sql);

mysqli_close($conexion);

?>
