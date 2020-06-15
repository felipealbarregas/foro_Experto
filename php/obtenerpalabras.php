<?php

//pagina que lanza una consulta para obtener la lista de palabras de la tabla tesauro
include('../includes/dbconnection.php' );


    $consulta = "SELECT ID , Palabra FROM tesauro";
    $resultado = $conexion->query($consulta)or die($conexion->error);
      while($data = mysqli_fetch_array($resultado)){
        $respuesta[] =$array=array(
            'id'=>$data['ID'],
            'palabra'=>$data['Palabra'],
        );
    }
            echo json_encode($respuesta);
                mysqli_close($conexion);


?>
