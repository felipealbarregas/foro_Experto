<?php
include('../includes/dbconnection.php' );

//esta pagina obtiene los datos del formulario y actualizamos la tabla personas
$nombre=$_POST['nombre'];
$apellidos=$_POST['apellido'];
$provincia=$_POST['provincia'];
$ciudad=$_POST['ciudad'];
$nickname=$_POST['usu'];
$contrasena=$_POST['password'];
$email=$_POST['email'];


$sql = "Update personas set Nombre='$nombre',Apellidos='$apellidos',Provincia='$provincia',Ciudad='$ciudad',Password='$contrasena',Email='$email' where Nickname='$nickname'";
if (mysqli_query($conexion, $sql)) {

      echo "Usuario actualizado correctamente";

} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
}




mysqli_close($conexion);

?>
