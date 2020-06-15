
//esta funcion es llamada cuando se cargan los mensajes y sirve para obtener la informacion, tanto de usuarios
//como  expertos, lanza una consulta y va guardando las respuestas en los distintos input del formulario
function  obtenerinfousu(nickname){

  var parametros = {"nickname":nickname};
$.ajax({
   type: "GET",
   url: '../php/obtenerinfousu.php',
   dataType: "json",
   data: parametros,

   success: function(data){
          $.each(data,function(i,item) {
          $("#nombre").val(item.nombre);
          $("#apellido").val(item.apellidos);
          $("#provincia").val(item.provincia);
          $("#ciudad").val(item.ciudad);
          $("#usuario").val(item.nickname);
          $("#usu").val(item.nickname);
          $("#password").val(item.password);
          $("#email").val(item.email);
   });
   },
   error: function(data) {
     alert('error');
   }
 });

}
