
// esta funcion va a ser llamada al cargar la pagina de autorizar a expertos
//y va a cargar el id y el nombre de los expertos en el select del formulario
function obtenerexperto(){
$.ajax({
   type: "GET",
   url: '../php/obtenerexpertos.php',

   dataType: "json",

   success: function(data){
          $.each(data,function(i,item) {
          $("#expertos").append('<option value='+item.experto_id+'>'+item.expertos_nickname+'</option>');
          return item;
   });
   },
   error: function(data) {
     alert('error');
   }
 });
}
