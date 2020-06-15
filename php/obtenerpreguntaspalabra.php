<?php
//pagina que recibe por parametros la palabra y lanza una consulta para obtener la informacion para el mensaje
include('../includes/dbconnection.php' );
$id=0;
if(isset($_GET['palabra']) && !empty($_GET['palabra'])){
  $palabra=$_GET['palabra'];
  }


      $consulta = "SELECT ID,ID_Usuario,ID_Subcategoria,Tema, Fecha,  Mensaje  FROM preguntas where preguntas.ID in (SELECT ID_pregunta from tesauro_preguntas where id_tesauro=(SELECT ID FROM tesauro where tesauro.Palabra='$palabra'))";
      $resultado = $conexion->query($consulta)or die($conexion->error);
  while($data = mysqli_fetch_array($resultado)){
      $mensajes[] =$array=array(
          'id'=>$data['ID'],
          'idusuario'=>$data['ID_Usuario'],
          'idsubcategoria'=>$data['ID_Subcategoria'],
          'tema'=>$data['Tema'],
          'fecha'=>$data['Fecha'],
          'mensaje'=>$data['Mensaje'],
      );
  }

    echo json_encode($mensajes);

      mysqli_close($conexion);
?>
