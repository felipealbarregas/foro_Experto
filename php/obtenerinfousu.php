<?php

//pagina que obtiene el nickname del usuario y devuelve todos los datos del usuario
include('../includes/dbconnection.php' );
if(isset($_GET['nickname']) && !empty($_GET['nickname'])){
  $nickname= $_GET['nickname'];
  }

    $consulta = "SELECT * FROM personas where Nickname='$nickname' ";
    $resultado = $conexion->query($consulta)or die($conexion->error);
      while($data = mysqli_fetch_array($resultado)){
        $respuesta[] =$array=array(
            'nombre'=>$data['Nombre'],
            'apellidos'=>$data['Apellidos'],
            'provincia'=>$data['Provincia'],
            'ciudad'=>$data['Ciudad'],
            'nickname'=>$data['Nickname'],
            'password'=>$data['Password'],
            'email'=>$data['Email'],
        );
    }
            echo json_encode($respuesta);
                mysqli_close($conexion);

                sleep(5);
                header('Location:http://localhost/index.html');

?>
