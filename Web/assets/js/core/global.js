$(document).ready(function(){

////////////////////DANIEL/////////////////
   $(document).on('click',"#g",function(){ 
    var valor=$(this).val();
    var url=$(this).attr("data-url");    
    $("#myModal").modal("show");           
    $.ajax({
      url:url,
      type: "POST",
      data: "id="+valor,      
      success:function(datos){
        $("#contenido").html(datos);}
    });      
  });

   $(document).on('click',"#e",function(){ 
    var valor=$(this).val();
    var url=$(this).attr("data-url");    
    $("#myModal2").modal("show");           
    $.ajax({
      url:url,
      type: "POST",
      data: "id="+valor,      
      success:function(datos){
        $("#contenido2").html(datos);}
    });      
  });

   $(document).on("keyup","#filtro",function(){

    var url=$(this).attr("data-url");
    var valor=$(this).val();
     
     $.ajax({
     url:url,
     type: "POST",
     data: "valor="+valor,
       
       success:function(datos){
          $("tbody").html(datos);}
     });
   });      

///////////////////////////////////////////////


    $(document).on("keyup", ".correo", function() {
        var cadena = $(this).val();
        var cont = 0;
        var noValidos = '!"#$%&/()=?¡+{}[]°|,;:´¨*¿';
        for (let a = 0; a < cadena.length; a++) {
            for (let b = 0; b < noValidos.length; b++) {
                if (cadena[a] == noValidos[b]) {
                    cont++;
                }
            }
        }
        if (cont > 0) {
            $(this).val(cadena.substr(0, cadena.length - 1));
        }
    });
});