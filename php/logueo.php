<?php
//pagina que comprueba que existe el usuario
include('../includes/dbconnection.php' );
if(isset($_POST['nickname']) && !empty($_POST['nickname']) AND isset($_POST['password']) && !empty($_POST['password'])){
  //obtenemos los datos del formulario
  $nickname=$_POST['nickname'];
  $contrasena=$_POST['password'];
  }
  $consulta = "SELECT password , ID_Roles FROM personas where Nickname='$nickname' and activo='1'";//lanzamos la select para obtener la contraseña y el id_rol
  $resultado = $conexion->query($consulta);
  $fila = $resultado->fetch_assoc();
  if($fila==null){//si no obtenemos resultado mostramos un mensaje
    echo "Lo sentimos su usuario no existe o su cuenta no esta activada";
    $url ="http://localhost/index.html"; //
    $tiempo_espera = 0; // Aconfiguramos el tiempo de espera en este caso 0.
    // y redireccionamos el url
    header("refresh: $tiempo_espera; url=$url");

  }else{
  if($fila['password']==$contrasena){//si la contraseña es igual a la del usuario
    if($fila['ID_Roles']==1){//si el id_roles es 1 enviamos al usuario a la pagina de inicio del administrador
      $url ="http://localhost/inicioadmin.html";
      $tiempo_espera = 0;
      header("refresh: $tiempo_espera; url=$url");
    }elseif ($fila['ID_Roles']==2) {//si el id_rol es igual a 2 enviamos a iniciousuario
      $url ="http://localhost/iniciousuarios.html";
      $tiempo_espera = 0;
      header("refresh: $tiempo_espera; url=$url");

    }else {//si  id_rol no es ni 1 ni 2 enviamos a inicioexperto
      $url ="http://localhost/inicioexpertos.html?nickname=$nickname";
      $tiempo_espera = 0;
      header("refresh: $tiempo_espera; url=$url");

    }
  }else{
    echo "el usuario no se ha podido loguear";//si no es igual mostramos el mensaje de error
  }

}
?>
