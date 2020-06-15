
<?php
//pagina que recibe el id  y envia la informacion de las respuestas de los mensajes que tiene el mensaje

include('../includes/dbconnection.php' );
if(isset($_GET['id']) && !empty($_GET['id'])){
  $id = $_GET['id'];
  }

    $consulta = "SELECT respuestas.ID ,Fecha, Mensaje,ID_experto, nickname FROM respuestas INNER JOIN expertos WHERE expertos.ID=ID_experto and respuestas.ID_pregunta='$id' ";
    $resultado = $conexion->query($consulta)or die($conexion->error);
      while($data = mysqli_fetch_array($resultado)){
        $respuesta[] =$array=array(
            'fecha'=>$data['Fecha'],
            'mensaje'=>$data['Mensaje'],
            'nickname'=>$data['nickname'],
            'idrespuesta'=>$data['ID'],
        );
    }
            echo json_encode($respuesta);
                mysqli_close($conexion);


?>
