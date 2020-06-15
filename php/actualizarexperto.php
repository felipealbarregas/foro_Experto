<?php

//pagina para autorizar a los expertos poniendo el id en 1
include('../includes/dbconnection.php' );
if(isset($_GET['id']) && !empty($_GET['id'])){
  $id=$_GET['id'];
  }


      $consulta = "Update expertos Set activo='1' Where ID='$id' ";
      $resultado = $conexion->query($consulta)or die($conexion->error);
   mysqli_query($conexion,$resultado);

      mysqli_close($conexion);
?>
