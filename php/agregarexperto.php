<?php
include('../includes/dbconnection.php' );
//obtenemos los datos y seleccionamos el id del experto en la tabla usuario
$nickname=$_POST['nickname'];
$Subcategoria=$_POST['Subcategoria'];
$profesion=$_POST['Profesion'];

$consulta = "SELECT ID FROM personas where Nickname='$nickname'";
$resultado = $conexion->query($consulta);
$fila = $resultado->fetch_assoc();
$id =$fila['ID'];



//insertamos en la tabla experto con los datos obtenidos
$sql = "INSERT INTO expertos (ID_persona, Nickname,ID_Subcategoria,ID_Profesion) VALUES ('$id', '$nickname','$Subcategoria','$profesion')";
if (mysqli_query($conexion, $sql)) {
      echo "Experto creado correctamente";

} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
}


mysqli_close($conexion);

$to      = "foroexpertosfelipe@gmail.com"; // Send email to our user
$subject = 'verificar experto '.$nickname; // Give the email a subject
$message = '

El usuario  quiere darse de alta como experto.
Ponte en contacto con el.



'; // Our message above including the link

$headers = 'From:noreply@foro_expertos.com' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email

sleep(10);
  $url ="http://localhost/inicioexpertos.html?nickname=$nickname";
  $tiempo_espera = 3; // Aquí se configura cuántos segundos hasta la actualización.
  // Declaramos la funcion apra la redirección
  header("refresh: $tiempo_espera; url=$url");

?>
