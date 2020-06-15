<?php
//consulta si el experto esta activo o no para mostrar el completar perfil
include('../includes/dbconnection.php' );
  $mensaje=0;

    if(isset($_POST['nickname']) && !empty($_POST['nickname'])){
      $usuario = $_POST['nickname'];

      }
      $consulta = "SELECT ID FROM expertos where Nickname='$usuario' and activo='1'";
      $resultado = $conexion->query($consulta)or die($conexion->error);
      echo $resultado->num_rows;

      mysqli_close($conexion);
?>
