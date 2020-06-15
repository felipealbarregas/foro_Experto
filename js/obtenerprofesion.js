//funcion que se llama despues de seleccionar la subcategoria, obtenemos la subcategoria y obtenemos la profesiones
//que encontremos en esa subcategoria
function  obtenerprofesion(){
  for (let i = document.getElementById('profesion').options.length; i >= 0; i--) {
    document.getElementById('profesion').remove(i);
};
  var id=document.getElementById('subcategoria').value;
  var parametros = {"id":id};
$.ajax({
   type: "GET",
   url: '../php/obtenerprofesion.php',
   dataType: "json",
   data: parametros,

   success: function(data){
          $.each(data,function(i,item) {
          $("#profesion").append('<option value='+item.profesion_id+'>'+item.profesion_nombre+'</option>');
   });
   },
   error: function(data) {
     alert('error');
   }
 });

}
