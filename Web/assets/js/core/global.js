$(document).ready(function(){


/////////////Camila ////////////////////////

$(document).on("click","#view", function(){
    var boton=$(this).val();
    if (boton=="v1") {
    $(this).attr('Class','far fa-eye-slash text-primary bg-dark btn btn-dark','Id','view');
    $(this).attr('value','v2');
    $(".gyg").attr('type','text');

     }else if (boton=="v2"){
        $(this).attr('Class','far fa-eye text-primary bg-dark btn btn-dark','Id','view');
        $(this).attr('value','v1');
        $(".gyg").attr('type','password'); 
     }
  });

$(document).on("click","#contra", function(){
    var boton=$(this).val();
    if (boton=="v1") {
    $(this).attr('Class','far fa-eye-slash text-primary bg-dark btn btn-dark','Id','contra');
    $(this).attr('value','v2');
    $(".cl1").attr('type','text');
    $("#cam").attr('Class','far fa-eye-slash text-primary bg-dark btn btn-dark');

     }else if (boton=="v2"){
        $(this).attr('Class','far fa-eye text-primary bg-dark btn btn-dark','Id','contra');
        $(this).attr('value','v1');
        $(".cl1").attr('type','password'); 
        $("#cam").attr('Class','far fa-eye text-primary bg-dark btn btn-dark');
     }
  });

  $(document).on("keyup","#correo2",function(){

 var correo=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/;

  if(correo.test($(this).val())){  
         $("#error1").html("");  
    }else{
         $("#error1").html("<h5 class='text-danger'>El correo es invalido</h5>");    
    }
 });

$(document).on("keyup",".campos",function(){
  
  var correo=$(".correo").val();
  var clave1=$(".clave1").val();
  var clave2=$(".clave2").val();
  
  if (correo.length == 0) {
     $(".actualizar").attr('disabled',true);          
     $("#error1").html("<h5 class='text-danger'>Debe llenar el correo electronico</h5>");        
  }else{
     $(".actualizar").attr('disabled',false);          
     $("#error1").html("");            
  }
  
  if (clave1.length == 0) {
     $(".actualizar").attr('disabled',true);          
     $("#error2").html("<h5 class='text-danger'>Debe llenar la contraseña</h5>");        
  }else{
     $(".actualizar").attr('disabled',false);          
     $("#error2").html("");            
  }

  if (clave2.length == 0) {
     $(".actualizar").attr('disabled',true);          
     $("#error3").html("<h5 class='text-danger'>Debe confirmar la contraseña</h5>");        
  }else{
     $(".actualizar").attr('disabled',false);          
     $("#error3").html("");            
  }

if (clave1.length>0 && clave2.length>0) {
   if (clave1!=clave2) {
     $(".actualizar").attr('disabled',true);          
     $("#error2").html("<h5 class='text-danger'>Las contraseñas no coinciden</h5>");        
     $("#error3").html("<h5 class='text-danger'>Las contraseñas no coinciden</h5>");        
  }else{
     $(".actualizar").attr('disabled',false);          
     $("#error3").html("");            
     $("#error3").html("");  
  } 
}    
});
//////////////////////////////////////////////////////////

//////////////////Daniel //////////////////

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

 $(document).on("click","#editar", function(){
  var id= $(this).val();
  var url=$(this).attr("data-url");  
  $.ajax({
    url:url,
    type: "POST",
    data: "id="+id,     
    success:function(datos){
      $("#contenido_editar").html(datos);
      $('#modal_editar').modal();}   
    });
  }); 

  $(document).on("click","#eliminar", function(){
  var id= $(this).val();
  var url=$(this).attr("data-url");  
  $.ajax({
    url:url,
    type: "POST",
    data: "id="+id,     
    success:function(datos){
      $("#cotenido_eliminar").html(datos);
      $('#modal_eliminar').modal();}   
    });
  }); 

////////////////////////////////////////////////////////////////////

    //Validacion de caracteres especiales en la interfaz "Olvidaste.php" correo electronico
    $(document).on("keyup", "#correo", function() {
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

    $(document).on("keyup", "#bor1", function() {
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

    // Funcion para la validacion de caracteres especiales en los inputs.
    $(document).on("change",".validacion",function(){
        let texto = $(this).val();
        let noValidos = '!"#$%/()=?¡¿+´{}[]-_,:,;@*|';
        let cont = 0;

        for (let i = 0; i < texto.length; i++) {
            for (let k = 0; k < noValidos.length; k++) {
                if (texto[i]==noValidos[k]) {
                    cont++;
                }
                
            }
        }

        if (cont > 0) {
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
            $("#enviar").attr('disabled',true);
            $("#error").html("<p class='text-danger'> No ingrese caracteres especiales</p>");
        } else {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
            $("#enviar").attr('disabled',false);
            $("#error").html("");
        }
    });

///////////////////////////Sandra Barrio ////////////////////////////

    //Se creo esta funcion para que NO ingrese el usuario caracteres especiales en la vista "Registrar"
    $(document).on("keyup", ".barrioN",function(){
        
        var barrioNom = $(this).val();
        var cont = 0;
        var noValidos = "!#$%&/()=?¡+{}[]°|',;:´¨*¿";
        for (let a = 0; a < barrioNom.length; a++) {
            for (let b = 0; b < noValidos.length; b++) {
                if (barrioNom[a] == noValidos[b]) {
                    cont++;
                }
            }
        }
        if (cont > 0) {
            $(this).val(barrioNom.substr(0, barrioNom.length - 1));
        }
    });
    // Se creo el filtro para tbl_barrio, No se puden recibir carcateres especiales tambien
    $(document).on("keyup","#filtroB",function(){
        var url=$(this).attr("data-url");
        var valor=$(this).val();
        var cont = 0;
        var noValidos = "!#$%&/()=?¡+{}[]°|',;:´¨*¿";

        //Validacion de caracteres especiales
        for (let a = 0; a < valor.length; a++) {
            for (let b = 0; b < noValidos.length; b++) {
                if (valor[a] == noValidos[b]) {
                    cont++;
                }
            }
        }
        if (cont > 0) {
            $(this).val(valor.substr(0, valor.length - 1));
        }
        
        //Validacion de Filtro
        $.ajax({
            url:url,
            type: "POST",
            data: "barrio=" + valor,
            success: function(datos){
                $("tbody").html(datos);
            }
        });
    });

    //Se creo esta funcion para que NO ingrese el usuario caracteres especiales en la vista "Editar"
    $(document).on("keyup", ".barrioEditar",function(){
        var barrioEdit = $(this).val();
        var cont = 0;
        var noValidos = "!#$%&/()=?¡+{}[]°|',;:´¨*¿";
        for (let a = 0; a < barrioEdit.length; a++) {
            for (let b = 0; b < noValidos.length; b++) {
                if (barrioEdit[a] == noValidos[b]) {
                    cont++;
                }
            }
        }
        if (cont > 0) {
            $(this).val(barrioEdit.substr(0, barrioEdit.length - 1));
        }
    });
   

    //Se creo esta funcion para el modal de "Eliminar"
    $(document).on("click", "#elimi",function(){
       
        var barrioElimi = $(this).val();
        var url = $(this).attr("data-url");

        // alert(barrioElimi);
        $.ajax({
            url:url,
            type: "POST",
            data: "barrioElimi=" + barrioElimi,
            success: function(datos){
                $("#eliminarB").html(datos);
                $("#eliminar").modal();
            }
        });

    });
///////////////////////Aqui termina las funciones de tbl_barrio///////////////////


});

// Funcion para enviar paramentos mediante la modal a la funcion userDelete
const userDelete = ( identificacion ) => {
    console.log(identificacion);
    input = document.getElementById('inputcito');
    input.value = identificacion;
}

// Funcion para enviar paramentos mediante la modal a la funcion userActivation
const userActivation = ( identificacion ) =>{
    console.log(identificacion);
    input = document.getElementById('inputcito2');
    input.value = identificacion;
}