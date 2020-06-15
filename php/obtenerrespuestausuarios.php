<?php

//consulta que recibiendo por parametro el id de de los mensaje obtenemos las respuestas guardadas por esa pregunta
include('../includes/dbconnection.php' );
if(isset($_GET['id']) && !empty($_GET['id'])){
  $id = $_GET['id'];
  }

    $consulta = "SELECT Fecha, Mensaje,ID_experto, nickname FROM respuestas INNER JOIN expertos WHERE expertos.ID=ID_experto and respuestas.ID_pregunta='$id' ";
    $resultado = $conexion->query($consulta)or die($conexion->error);
      while($data = mysqli_fetch_array($resultado)){
        $mensaje[] =$array=array(
            'fecha'=>$data['Fecha'],
            'mensaje'=>$data['Mensaje'],
            'nickname'=>$data['nickname'],
        );
    }
            echo json_encode($mensaje);
                mysqli_close($conexion);


?>
