
// esta funcion se manda con un proceso 1 o 2 dependiendo de la opcion que se elija se realiza una tabla u otra
function desplegarmenu( proceso){
  if(proceso==2){
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
      // Crea un elemento <td> y un nodo de texto en el que incluimos un enlace a una pagina y una opcion que al
      // quitar el cursor del raton fuera de la tabla se llama a la funcion eliminartabla
      // hace que el nodo de texto sea el contenido de <td>, ubica el elemento <td> al final de la fila de la tabla
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
      // Crea un elemento <td> y un nodo de texto en el que incluimos un enlace a una pagina y una opcion que al
      // quitar el cursor del raton fuera de la tabla se llama a la funcion eliminartabla
      // hace que el nodo de texto sea el contenido de <td>, ubica el elemento <td> al final de la fila de la tabla
      var celda = document.createElement("td");
      var url = "<a href='index.html' onmouseout='eliminartabla()'>Cerrar Sesion</a>";
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
  // modifica el atributo "id" de la tabla y lo llamamos tabla
  tabla.setAttribute("id", "tabla");
//agregamos a la barra de menu la tabla
  var result = document.getElementById("menubar");
  result.appendChild(tabla);

}else if (proceso==1) {
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
      // Crea un elemento <td> y un nodo de texto en el que incluimos un enlace a una pagina y una opcion que al
      // quitar el cursor del raton fuera de la tabla se llama a la funcion eliminartabla
      // hace que el nodo de texto sea el contenido de <td>, ubica el elemento <td> al final de la fila de la tabla
      var celda = document.createElement("td");
      var url = "<a href='verperfilusuario.html' onmouseout='eliminartabla()'>Mi perfil</a>";
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
      // Crea un elemento <td> y un nodo de texto en el que incluimos un enlace a una pagina y una opcion que al
      // quitar el cursor del raton fuera de la tabla se llama a la funcion eliminartabla
      // hace que el nodo de texto sea el contenido de <td>, ubica el elemento <td> al final de la fila de la tabla
      var celda = document.createElement("td");
      var url = "<a href='index.html' onmouseout='eliminartabla()'>Cerrar Sesion</a>";
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

  // modifica el atributo "id" de la tabla y la nombramos como "tabla";
  tabla.setAttribute("id", "tabla");
  var result = document.getElementById("menubar");
  result.appendChild(tabla);

}
}
// funcion que quita la tabla al salir de la tabla
function eliminartabla(){
$("#tabla").remove();

}
