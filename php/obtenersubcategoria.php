<?php
//pagina que recibe por parametro el id de categoria y lanzamos una subconsulta para obtener el nombre y el id
//de la subconsulta
subcategoria[];
include('../includes/dbconnection.php' );
$categoria="";
if(isset($_GET['id']) && !empty($_GET['id'])){

  $categoria = $_GET['id'];
  }
      $consulta = "SELECT ID, Nombre FROM subcategoria where ID_categoria='$categoria'";
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
