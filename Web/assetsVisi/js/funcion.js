$(document).ready(function(){
    
 $(document).on("click", ".sena", function() {
    var url = $(this).attr("data-url");

      var visible=1;
      $.ajax({
       url: url,
       type: "POST",
       data: "menu=" + visible,
            success: function(datos) {                                                        
            
            }        
      }); 

  });


 $(document).on("click", ".otro", function() {
    var url = $(this).attr("data-url");

      var visible=0;
      $.ajax({
       url: url,
       type: "POST",
       data: "menu=" + visible,
            success: function(datos) {                                                        
            
            }        
      }); 

  });

$(document).on("submit",".enviar",function(){
         $("input[type=text], textarea").val("");

 


   
});



});