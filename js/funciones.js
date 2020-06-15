
//funcion que obtiene el parametro de la url que se pasa por el metodo get se le pasa por parametro el nombre
function parametroURL(_par) {
var _p = null;
if (location.search) location.search.substr(1).split("&").forEach(function(pllv) {
  var s = pllv.split("="), //separamos llave/valor
    ll = s[0],
    v = s[1] && decodeURIComponent(s[1]); //valor hacemos encode para prevenir url encode
  if (ll == _par) { //solo nos interesa si es el nombre del parametro a buscar
    if(_p==null){
    _p=v; //si es nula, quiere decir que no tiene valor, solo textual
    }else if(Array.isArray(_p)){
    _p.push(v); //si ya es arreglo, agregamos este valor
    }else{
    _p=[_p,v]; //si no es arreglo, lo convertimos y agregamos este valor
    }
  }
});
return _p;
}

// funcion que se llama al pulsar el boton de experto ver valoracion, realiza una consulta ajax para obtener
//la valoracion de la tabla experto y lo agrega a un apartado de la pagina que se llama vermisvaloraciones
function vervaloracion(){
var nickname=sessionStorage.getItem("usuario");//obtenemos el nombre almacenado en la sesion
var parametros = {"nickname":nickname};//creamos un parametro del nombre de usuario que preparamos para enviar
$.ajax({
 type: "GET",//declaramos el metodo get de la consulta ajax
 url: '../php/vermisvaloraciones.php',//ponemos la pagina php que va a recibir la peticion
 dataType: "json",//decimos que los datos recibidos son de tipo json
 data: parametros,//y le pasamos los datos de nickname

 success: function(data){//si se realiza la consulta correctamente recibiremos datos
        $.each(data,function(i,item) {//por cada datos que recibimos
          $("#valoraciones").append('<h2><strong> Valoracion Media:</strong><h2> <div id="media"></div>');
        $("#media").append(item);//agregamos a valoracion la media en un h2

 });
 },
 error: function (request, status, error) {
      alert("No tiene todavia una media o ha ocurrido un error");// mensaje de error si no tiene media o si ocurre un error
  }
});
  setTimeout(function(){eliminarmedia()}, 2000);//pasados dos segundos llamamos a la funcion eliminar media
}
//funcion que elimina del div valoracion la media
function eliminarmedia(){
  $('#valoraciones').remove();
}

// funcion que comprueba el experto para ver si esta autorizado o no, si esta autorizado no muestra la opcion de
//completar perfil y muestra las opciones de preguntas por categoria y ver valoraciones
// si no en la tabla muestra la opcion completar perfil y el resto de operaciones.
function comprobarusuario(proceso){
  var nickname =sessionStorage.getItem("usuario");//obtenemos el id de experto
  $.ajax({
      url:'http://localhost/php/comprobarexperto.php',//pagina que procesa la peticion
      data: {"nickname": nickname},//parametro que vamos a enviar
        type : 'POST',//tipo de peticion
      success: function(respuesta){//obtendremos una respuesta de 1 o 0 ya que consultamos si esta autorizado o no
        if(proceso==1){
        if (respuesta==0){
            // Obtenemos la referencia del elemento body
            var body = document.getElementsByTagName("body")[0];
            // Creamos un elemento <table> y un elemento <tbody>
            var tabla = document.createElement("table");
            var tblBody = document.createElement("tbody");
            // Creamos las celdas
            for (var i = 0; i < 1; i++){
              // Creamos las filas de la tabla
              var fila = document.createElement("tr");
              for (var j = 0; j < 1 ; j++) {
                // Crea un elemento <td> y un nodo de texto, hace que el nodo de
                // texto sea el contenido de <td>, ubica el elemento <td> al final
                // de la fila de la tabla
                var celda = document.createElement("td");
                var url = "<a href='verperfil.html'  onmouseout='eliminartabla()'>Mi perfil</a>";
                celda.innerHTML=url;
                fila.appendChild(celda);

              }
              // agregamos la fila al final de la tabla (al final del elemento tblbody)
              tblBody.appendChild(fila);
            }
              // Creamos las celdas
              for (var i = 0; i < 1; i++){
                // Creamos las filas de la tabla
                var fila = document.createElement("tr");
                for (var j = 0; j < 1 ; j++) {
                  // Crea un elemento <td> y un nodo de texto, hace que el nodo de
                  // texto sea el contenido de <td>, ubica el elemento <td> al final
                  // de la fila de la tabla
                  var celda = document.createElement("td");
                    var nickname = parametroURL("nickname");
                  var url = "<a href='completarperfil.html?nickname="+nickname+"'  onmouseout='eliminartabla()'>Completar Perfil</a>";
                  celda.innerHTML=url;
                  fila.appendChild(celda);

                }
            // agregamos la fila al final de la tabla (al final del elemento tblbody)
            tblBody.appendChild(fila);
            }

            for (var i = 0; i < 1; i++) {
              // Creamos las filas de la tabla
              var fila = document.createElement("tr");
              for (var j = 0; j < 1 ; j++) {
                // Crea un elemento <td> y un nodo de texto, hace que el nodo de
                // texto sea el contenido de <td>, ubica el elemento <td> al final
                // de la fila de la tabla
                var celda = document.createElement("td");
                var url = "<a href='cerrarsesion.html'  onmouseout='eliminartabla()'>Cerrar Sesion</a>";
                celda.innerHTML=url;
                fila.appendChild(celda);
              }
            // agregamos la fila al final de la tabla (al final del elemento tblbody)
            tblBody.appendChild(fila);
            }
            // posicionamos el <tbody> debajo del elemento <table>
            tabla.appendChild(tblBody);
            // appends <table> into <body>
            body.appendChild(tabla);
            // modifica el atributo "border" de la tabla y lo fija a "2";

            tabla.setAttribute("id", "tabla");

            var result = document.getElementById("menubar");
            result.appendChild(tabla);

        }else if(respuesta!=0){
            // Obtenemos la referencia del elemento body
            var body = document.getElementsByTagName("body")[0];
            // Creamos un elemento <table> y un elemento <tbody>
            var tabla = document.createElement("table");
            var tblBody = document.createElement("tbody");

            // Creamos las celdas
            for (var i = 0; i < 1; i++){
              // Creamos las filas de la tabla
              var fila = document.createElement("tr");
              for (var j = 0; j < 1 ; j++) {
                // Crea un elemento <td> y un nodo de texto, hace que el nodo de
                // texto sea el contenido de <td>, ubica el elemento <td> al final
                // de la fila de la tabla
                var celda = document.createElement("td");
                var url = "<a href='verperfil.html' onmouseout='eliminartabla()'>Mi perfil</a>";
                celda.innerHTML=url;
                fila.appendChild(celda);

              }

            // agregamos la fila al final de la tabla (al final del elemento tblbody)
            tblBody.appendChild(fila);
            }
            for (var i = 0; i < 1; i++) {
              // Creamos las filas de la tabla
              var fila = document.createElement("tr");
              for (var j = 0; j < 1 ; j++) {
                // Crea un elemento <td> y un nodo de texto, hace que el nodo de
                // texto sea el contenido de <td>, ubica el elemento <td> al final
                // de la fila de la tabla
                var celda = document.createElement("td");
                var url = "<a href='cerrarsesion.html' onmouseout='eliminartabla()'>Cerrar Sesion</a>";
                celda.innerHTML=url;
                fila.appendChild(celda);
              }
            // agregamos la fila al final de la tabla (al final del elemento tblbody)
            tblBody.appendChild(fila);
            }
            // posicionamos el <tbody> debajo del elemento <table>
            tabla.appendChild(tblBody);
            // appends <table> into <body>
            body.appendChild(tabla);
            // modifica el atributo "border" de la tabla y lo fija a "2";

            tabla.setAttribute("id", "tabla");

            var result = document.getElementById("menubar");
            result.appendChild(tabla);

          var body = document.getElementsByTagName("body")[0];
        var result = document.getElementById("menubar");
        var li=document.createElement('li');
          li.innerHTML="<li><a href='preguntascategoria.html'>Preguntas</a></li>";
          result.appendChild(li);

          var li=document.createElement('li');
            li.innerHTML="<li><a href='vermisvaloraciones.html'>valoraciones</a></li>";
            result.appendChild(li);
      }
    }else if(proceso==3){
          // Obtenemos la referencia del elemento body
          var body = document.getElementsByTagName("body")[0];
          // Creamos un elemento <table> y un elemento <tbody>
          var tabla = document.createElement("table");
          var tblBody = document.createElement("tbody");
          // Creamos las celdas
          for (var i = 0; i < 1; i++){
            // Creamos las filas de la tabla
            var fila = document.createElement("tr");
            for (var j = 0; j < 1 ; j++) {
              // Crea un elemento <td> y un nodo de texto, hace que el nodo de
              // texto sea el contenido de <td>, ubica el elemento <td> al final
              // de la fila de la tabla
              var celda = document.createElement("td");
              var url = "<a href='verperfil.html'  onmouseout='eliminartabla()'>Mi perfil</a>";
              celda.innerHTML=url;
              fila.appendChild(celda);

            }
            // agregamos la fila al final de la tabla (al final del elemento tblbody)
            tblBody.appendChild(fila);
          }
          for (var i = 0; i < 1; i++) {
            // Creamos las filas de la tabla
            var fila = document.createElement("tr");
            for (var j = 0; j < 1 ; j++) {
              // Crea un elemento <td> y un nodo de texto, hace que el nodo de
              // texto sea el contenido de <td>, ubica el elemento <td> al final
              // de la fila de la tabla
              var celda = document.createElement("td");
              var url = "<a href='cerrarsesion.html'  onmouseout='eliminartabla()'>Cerrar Sesion</a>";
              celda.innerHTML=url;
              fila.appendChild(celda);
            }
          // agregamos la fila al final de la tabla (al final del elemento tblbody)
          tblBody.appendChild(fila);
          }
          // posicionamos el <tbody> debajo del elemento <table>
          tabla.appendChild(tblBody);
          // appends <table> into <body>
          body.appendChild(tabla);
          // modifica el atributo "border" de la tabla y lo fija a "2";

          tabla.setAttribute("id", "tabla");

          var result = document.getElementById("menubar");
          result.appendChild(tabla);


    }
      },
      error: function(){
        alert("no se puede");
      },

  });

}
//funcion que elimina la tabla al salir con el cursor de ella
function eliminartabla(){
$("#tabla").remove();

}
// esta funcion nos sirve para comprobar cuando se clickea sobre el input de buscar
// al cliclkear hacemos una consulta ajax para obtener el las palabras en el tesauro
//y lo almacenamos en un array de lista que utilizaremos para el autocompletar
$(document).on('click', '#search', function () {
  list=[];
  $.ajax({
   type: "GET",
   url: '../php/obtenerpalabras.php',
   dataType: "json",

   success: function(data){
          $.each(data,function(i,item) {
          list.push(item.palabra);

   });
   },
   error: function (request, status, error) {
        alert(error);
    }
  });
      $(this).autocomplete({//con esta orden estamos seleccionando la barra de search y cuando tecleemos
        //el minLength configurado a 1 caracter mostramos las palabras que coincidan con las palabras obtenidas
        //del tesauro y ayudamos con el autocompletar
          source: list,
          minLength: 1
      });
  });

//al cliclkear sobre el boton de buscar vamos a guardar la palabra en el default y vamos a redireccionar
// a la pagina de mostrar mensaje.
  $(document).on('click','#btnbuscar',function(){
    var palabra = document.getElementById("search").value;
        sessionStorage.setItem("palabra", palabra);
event.preventDefault();
  setTimeout("location.href='mostrarmensajepalabra.html'", 1000);

  });

  //funcion que se llama al cargar el mensaje obtenemos la informacion del mensaje
  //que encontremos en esa categoria y agregamos los valores
  function  obtenermensaje(){


  }
