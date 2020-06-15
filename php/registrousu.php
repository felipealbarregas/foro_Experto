<?php
include('../includes/dbconnection.php' );//incluimos la conexion a base de datos

if($_POST['roles']=='Expertos'){//comprobamos si el rol es experto
  $rol=3;//si el rol seleccionado es experto lo ponemos como un 3
}else{
  $rol=2;//sino ponemos el rol como 2
}
//obtenemos los datos del formulario y los almacenamos en variables
$nombre=$_POST['nombre'];
$apellidos=$_POST['apellido'];
$provincia=$_POST['provincia'];
$ciudad=$_POST['ciudad'];
$nickname=$_POST['Nickname'];
$contrasena=$_POST['password'];
$email=$_POST['email'];
$hash = md5( rand(0,1000) );

$sql = "INSERT INTO personas (ID_Roles, Nombre,Apellidos,Provincia,Ciudad,Nickname,Password, Email,hash,activo) VALUES ('$rol', '$nombre','$apellidos','$provincia','$ciudad','$nickname','$contrasena','$email','$hash','0')";//consulta de insercion de los datos del usuario
if (mysqli_query($conexion, $sql)) {//si no existen errores
      echo "Usuario creado correctamente";//lanzamos el mensaje de usuaro
      echo "<br>";
      echo "Debera verificar su correo electronico que ha sido enviado";//lanzamos el mensaje de que debe verificar su identidad

} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conexion);//lanzamos un mensaje de error si se produce
}
$consulta = "SELECT ID FROM personas where Nickname='$nickname'";//selecionamos el id de la persona
$resultado = $conexion->query($consulta);//lanzamos la consulta
$fila = $resultado->fetch_assoc();

if($rol==2){//si el rol es = a 2
      $id=$fila['ID'];//obtenemos el id del usuario
        $sql = "INSERT INTO usuario (ID_Personas) VALUES ('$id')";//insertamos en la tabla usuario el valor del id
          if (mysqli_query($conexion, $sql)) {//si la conexion se ha hecho bien lanzalos el mensaje
              echo "Usuario agregado a la tabla usuario";
            }
          }

mysqli_close($conexion);


$to      = $email; // preparamos el mensaje que vamos a enviar para ello obtenemos el email
$subject = 'Verificacion en foro_expertos'; // agregamos el tema del mensaje y el mensaje
$message = '

Gracias por registrarse!
Acaba de registrarse en foro_expertos, Usted se acaba de registrar con las siguiente credenciales, pulse en el siguiente enlace para verificar su cuenta.

------------------------
Username: '.$nickname.'
Password: '.$contrasena.'
------------------------

Please click this link to activate your account:
http://localhost/php/verify.php?email='.$email.'&hash='.$hash.'

'; // agregamos la direccion de la verificacion

$headers = 'From:foroexpertofelipe@foro_expertos.com' . "\r\n"; // ponemos el correo del foro
mail($to, $subject, $message, $headers); // llamamos al metodo para enviar el email

sleep(4);//esperamos 4 segudos y redirigimos al index 
header('Location:http://localhost/index.html');
?>
