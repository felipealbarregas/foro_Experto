<?php
//pagina que recibe por parametro el nickname del usuario y obtenemos su id mediante consultas
//por ultimo obtenemos la informacion de las preguntas realizadas por el usuario
include('../includes/dbconnection.php' );
if(isset($_GET['id_mensaje']) && !empty($_GET['id_mensaje'])){
  $id=$_GET['id_mensaje'];
  }


      $consulta = "SELECT Tema, Fecha, Mensaje,ID_subcategoria,id_usuario  FROM preguntas where ID='$id'";
      $resultado = $conexion->query($consulta)or die($conexion->error);
  while($data = mysqli_fetch_array($resultado)){
      $mensajes[] =$array=array(
          'tema'=>$data['Tema'],
          'fecha'=>$data['Fecha'],
          'mensaje'=>$data['Mensaje'],
          'idpregunta'=>$id,
          'idusuario'=>$data['id_usuario'],
          'idsubcategoria'=>$data['ID_subcategoria']
      );
  }

    echo json_encode($mensajes);

      mysqli_close($conexion);
?>
