<?php
//pagina que recibe el id de la subcategoria y tras lanzar la consulta devuelve el nombre y el id de subcategoria

include('../includes/dbconnection.php' );
if(isset($_GET['id']) && !empty($_GET['id'])){
  $idsubcategoria = $_GET['id'];
  }

      $consulta = "SELECT ID, Nombre FROM subcategoria  where ID='$idsubcategoria'";
      $resultado = $conexion->query($consulta)or die($conexion->error);
  while($data = mysqli_fetch_array($resultado)){
      $subcategoria[] =$array=array(
          'subcategoria_id'=>$data['ID'],
          'subcategoria_nombre'=>$data['Nombre'],
      );
  }

    echo json_encode($subcategoria);

      mysqli_close($conexion);
?>
