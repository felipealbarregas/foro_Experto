
// esta accion al cargar la pagina va a lanzar una consulta ajax para obtener el nombre de la categoria
//y va a cargar el id y el nombre de la categoria en el select del formulario
$.ajax({
   type: "GET",
   url: '../php/obtenercategoria.php',

   dataType: "json",

   success: function(data){
          $.each(data,function(i,item) {
          $("#categoria").append('<option value='+item.categoria_id+'>'+item.categoria_nombre+'</option>');
          return item;
   });
   },
   error: function(data) {
     alert('error');
   }
 });
