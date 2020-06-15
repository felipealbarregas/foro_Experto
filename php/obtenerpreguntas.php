<?php
//pagina que recibe por parametro el nickname del usuario y obtenemos su id mediante consultas
//por ultimo obtenemos la informacion de las preguntas realizadas por el usuario 
include('../includes/dbconnection.php' );
$categoria="";
if(isset($_GET['nickname']) && !empty($_GET['nickname'])){
  $nombre=$_GET['nickname'];
  }
  $consulta = "SELECT ID FROM personas where Nickname='$nombre'";
  $resultado = $conexion->query($consulta);
  $fila = $resultado->fetch_assoc();
  $id_personas =$fila['ID'];
  $consulta = "SELECT ID FROM usuario where ID_Personas='$id_personas'";
  $resultado = $conexion->query($consulta);
  $fila1 = $resultado->fetch_assoc();
  $id =$fila1['ID'];


      $consulta = "SELECT ID,Tema, Fecha,  Mensaje,ID_subcategoria  FROM preguntas where ID_Usuario='$id'";
      $resultado = $conexion->query($consulta)or die($conexion->error);
  while($data = mysqli_fetch_array($resultado)){
      $mensajes[] =$array=array(
          'tema'=>$data['Tema'],
          'fecha'=>$data['Fecha'],
          'mensaje'=>$data['Mensaje'],
          'idpregunta'=>$data['ID'],
          'idsubcategoria'=>$data['ID_subcategoria']
      );
  }

    echo json_encode($mensajes);

      mysqli_close($conexion);
?>
