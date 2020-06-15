<?php

//pagina que devuelve el nombre y el id de la categoria 
include('../includes/dbconnection.php' );


      $consulta = "SELECT ID, Nombre FROM categoria ";
      $resultado = $conexion->query($consulta)or die($conexion->error);
  while($data = mysqli_fetch_array($resultado)){
      $subcategoria[] =$array=array(
          'categoria_id'=>$data['ID'],
          'categoria_nombre'=>$data['Nombre'],
      );
  }

    echo json_encode($subcategoria);

      mysqli_close($conexion);
?>
