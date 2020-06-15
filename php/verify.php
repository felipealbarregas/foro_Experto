<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>foro_expertos > alta</title>
</head>
<body>
  <!--estamos creando una pagina web que verifica que el codigo hash que se envia al usuario coincide con el
que tenemos en la base de datos  -->
    <div id="header">
        <h3>Bienvenidos a foro expertos tiene usted su cuenta activada</h3>
    </div>
    <div id="wrap">
        <!-- inicio del codigo php -->
        <?php
        include('../includes/dbconnection.php' );

            if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
              // comprobamos que hemos recibido los datos
              $email = $_GET['email']; // guardamos la variable email
              $hash = $_GET['hash']; // guardamos el hash recibido
              }

              $consulta = "SELECT hash FROM personas where Email='$email' and activo='0'";// lanzamos una consulta en la que obtenemos el hash cuando el email sea el enviado y se encuentre inactivo
              $resultado = $conexion->query($consulta);//lanzamos la consulta
              $fila = $resultado->fetch_assoc();//realizamos un array
              if($fila['hash']==$hash){
                $sql="UPDATE personas SET activo='1' WHERE Email='$email' AND hash='$hash' AND activo='0'";//ahora actualizamos al experto para activarlo
                $conexion->query($sql);//lanzamos la consulta
                echo '<div class="statusmsg">Tu cuenta ha sido activada, ahora puedes loguearte</div>';//como se ha actualizado lanzo un mensaje
              }else{
                echo '<div class="statusmsg">No se ha encontrado el usuario o el usuario ya esta activo</div>';// si no coincide el hash o el usuario ya esta activado se lanza el mensaje
              }

        ?>



    </div>
    <!-- end wrap div -->

</body>
</html>
