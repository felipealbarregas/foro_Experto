<?php


include('../includes/dbconnection.php' );//incluimos la conexion a la base de datos
if(isset($_GET['nickname']) && !empty($_GET['nickname'])){//comprobamos si recibimos el nickname
  $nickname = $_GET['nickname'];//guardamos en una variable el nickname esto es recomendable para no tener problemas
  //con la base de datos
  }

      $consulta = "SELECT Puntuacion FROM expertos where nickname='$nickname'";//consulta que obtiene la puntuacion de experto
      $resultado = $conexion->query($consulta)or die($conexion->error);//lanza la consulta
      while($data1 = mysqli_fetch_array($resultado)){//mientras que existan datos
            $puntuacion =$array=array(//creamos un array
                'puntuacion'=>$data1['Puntuacion'],//almacenamos en el valor puntuacion el dato
            );
          }

              echo json_encode($puntuacion);//enviamos los datos por json
      mysqli_close($conexion);//cerramos la conexion 
?>
