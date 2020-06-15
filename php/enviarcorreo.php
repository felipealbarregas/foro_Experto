<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"&amp;gt;>
    <title>Foro Expertos su lugar de busqueda</title>
<link rel="stylesheet" type="text/css" href="../css/stylescabecera.css">
<link rel="stylesheet" type="text/css" href="../css/stylefooter.css">
<link rel="stylesheet" type="text/css" href="../css/stylecorreo.css">

</head>
<body>
  <header id="main-header">
    <img src="../imagenes/logo.png"></img>
    <a class="boton_personalizado" href="../registrar.html">Registrarse</a>
        <a class="boton_personalizado1" href=../loguearse.html>Loguearse</a>
    <form id="buscar" action="" method="">
      <input type="search" placeholder="Buscar...">
      <button>Buscar</button>
    </form>
  </header>

  <ul id="menubar">
  <li><a href="../index.html">Inicio</a></li>
  <li><a href="php/enviarcorreo.php">Contacto</a></li>
  </ul>

<?php
    if(isset($_POST['enviar'])){
        $cuerpo = '
        <!DOCTYPE html>
        <html>
        <head>
         <title></title>
        </head>
        <body>
        '.$_POST['cuerpo'].'
        </body>
        </html>';

        //para el envío en formato HTML
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

        //dirección del remitente
        $headers .= "From: ".$_POST['nombre']." <".$_POST['emisor'].">\r\n";

        //Una Dirección de respuesta, si queremos que sea distinta que la del remitente
        $headers .= "Reply-To: ".$_POST['emisor']."\r\n";

        //direcciones que recibirán copia oculta
        //$headers .= "Bcc: ejemplo3@yahoo.com\r\n";
        if(mail($_POST['receptor'],$_POST['asunto'],$cuerpo,$headers)){
    		echo "<script>alert('Funcion \"mail()\" ejecutada, por favor verifique su bandeja de correo.');</script>";
    	}else{
    		echo "<script>alert('No se pudo enviar el mail, por favor verifique su configuracion de correo SMTP saliente.');</script>";
    	}
    }
?>
	<form id="formulario" method="post">
    	<div>
        	<h1>Contacta con nosotros</h1>
            <label>Asunto</label><br>
            <input type="text" name="asunto" value="" required autofocus style="" placeholder="Asunto" ><br>
            <label>De</label><br>
            <input type="text"  name="nombre" value="" required style="" placeholder="Tu Nombre" >
            <input type="email" name="emisor" required style="" placeholder="Email remitente" value=""><br>
            <label>Para</label><br>
            <input type="text" name="receptor" required style=""  value="foroexpertofelipe@gmail.com">
            <textarea name="cuerpo" style="" placeholder="Contenido del mensaje" cols="57" rows="10"></textarea><br>
            <input type="submit" name="enviar" value="Enviar">
            <br><br>
        </div>
    </form>
	</body>
	  <footer>
	  <div id="footer">

	          <p>&#169; 2020 All Rights Reserverd</p>
	          <p> Diseñado por Felipe Cendrero Diaz</p>
	   </div>
	  </footer>
	  </html>
