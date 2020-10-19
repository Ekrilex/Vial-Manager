$(document).ready(function() {


    //////////////// INICIO DE ORDENES DE MANTENIMIENTO  /////////
    
    $('#Tbl-orden').DataTable({
        "pageLength": 10,
        initComplete: function() {
            this.api().columns().every(function() {
                var column = this;
                var select = $('<select class="form-control"><option value=""></option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
    
                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });
    
                column.data().unique().sort().each(function(d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
        }
    });
    
    
    $(document).on("click",".foto", function(){
    var url = $(this).attr("data-url");
    var id = $(this).attr("data-id");
    
    $.ajax({
      url: url,
      type: "POST",
      data: "cas_id=" + id,
       success:function(datos){
       $("#foto").html(datos);
       $("#modal-foto").modal();
       }
    });   
    
    });
    
    
    $(document).on("click",".registrar", function(){
    
    var url = $(this).attr("data-url");
    
    var arr = $('[name="list[]"]').map(function(){
      return this.value;
    }).get();
    
    
    swal({
    title: "Registrar Orden",
    text: "Esta seguro de registrar orden?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
    })
    .then((registrar) => {
    if (registrar) {
    
        var total = arr.length;
    
    if (total>=2 && total<=5) {
    
        $.ajax({
        url: url,
        type: "POST",
        data: "sel=" + arr,
        success:function(datos){
            swal({
            title: "Orden Emitida",
            text: "La orden ha sido registrada correctamente",
            icon: "success",
            }).then(function() {
            location.reload();
            });
        }
        });    
    
        }else{
    
        swal({
            title: 'Orden incompleta',
            text: 'Debe de seleccionar minimo 2 y maximo 5 casos a la orden',
            icon: 'error',
            buttons: {
                confirm: {
                className: 'btn btn-success'
                }
            }
        });
        }  
    
    }
    
    });
    
    
    });
    
    $(document).on("click",".editarOrd", function(){
    
    var ord_id=$("#ord_id").val();
    var url = $(this).attr("data-url");   
    var arr = $('[name="list[]"]').map(function(){
       return this.value;
     }).get();
    
    swal({
       title: "Actualizacion de orden",
       text: "Esta seguro de actualizar esta orden?",
       icon: "warning",
       buttons: true,
       dangerMode: true,
    }).then((actualizar) => {
     
        if (actualizar) {
    
            var total = arr.length;
    
            if (total>=2 && total<6) {
    
                $.ajax({
                    url: url,
                    type: "POST",
                    data: "sell="+ arr + "&ord_id=" + ord_id,
                    success:function(datos){      
                
                        swal({
                            title: "Orden actualizada",
                            text: "La orden ha sido actualizada correctamente",
                            icon: "success",
                        }).then(function() {
                            location.reload();
                        });
                    }
                });   
    
            }else{
    
                swal({
                    title: 'Orden incompleta',
                    text: 'Debe de seleccionar minimo 2 y maximo 5 casos a la orden para actualizar esta orden',
                    icon: 'error',
                    buttons: {
                        confirm: {
                            className: 'btn btn-success'
                        }
                    }
                });
    
            }
        }
    
    });
    
    });
    
    
    $(document).on("click",".eliminarOrd" , function(){
    
        var ord_id=$("#ord_id").val();
        var titulo = $(this).attr('data-titulo');
        var url=$(this).attr("data-url");
       
        swal({
             title: titulo,
             text: "Esta seguro de modificar esta orden?",
             icon: "warning",
             buttons: true,
             dangerMode: true,
         }).then((eliminar) => {
    
            if(eliminar){
    
                var textarea = document.createElement('textarea');
                textarea.rows = 6;
                textarea.className = 'swal-content__textarea';
              
                // Set swal return value every time an onkeyup event is fired in this textarea
                textarea.onkeyup = function () {
                  swal.setActionValue({
                    confirm: this.value
                  });
                };
              
                swal({
                  text: titulo,
                  content: textarea,
                  buttons: {
                    cancel: {
                      text: 'Cancel',
                      visible: true
                    },
                    confirm: {
                      text: titulo,
                      closeModal: false
                    }
                  }
                }).then(function (value) {
                    var g = value;               
                    if (g.length>0 && g.length<301) {
                    $.ajax({
                        url:url,
                        type: "POST",
                        data: "ord_id=" + ord_id + "&justificacion=" + g,
                        success: function(datos){
                             swal({
                                 title: "Orden modificada",
                                 text: "La orden se ha modificado correctamente",
                                 icon: "success",
                             }).then(function() {
                                window.location.href = "indexAdmin.php?modulo=Orden&controlador=Orden&funcion=index&ord_id=2";
                             });
                        }
                    });
    
                  }else{
                    swal('Error', 'Por favor diligencie el campo , puede ingresar como maximo 300 caracteres.', 'error');
                  }
              
    
                });
    
            }else{
                swal({
                    title: 'Orden Cancelada',
                    text: 'Se Cancelo la modificacon de la Orden',
                    icon: 'error',
                    buttons: {
                        confirm: {
                            className: 'btn btn-danger'
                        }
                    }
                });
            }
         });
    
    });
    
    $(document).on("click",".deterioros", function(){
    var url = $(this).attr("data-url");
    var id = $(this).attr("data-id");
    
    $.ajax({
      url: url,
      type: "POST",
      data: "cas_id=" + id,
       success:function(datos){
       $("#deterioros").html(datos);
       $("#modal-deterioros").modal();
       }
    });   
    
    });
    
    
    
    $(document).on("click",".habilitar", function(){
    
    var ord_id=$("#ord_id").val();
    var url = $(this).attr("data-url");   
    var arr = $('[name="list[]"]:checked').map(function(){
       return this.value;
     }).get();
    
    swal({
       title: "Habilitar orden",
       text: "Esta seguro de habilitar esta orden?",
       icon: "warning",
       buttons: true,
       dangerMode: true,
    }).then((actualizar) => {
     
        if (actualizar) {
    
            var total = arr.length;
    
            if (total>=2 && total<6) {
    
                $.ajax({
                    url: url,
                    type: "POST",
                    data: "sell="+ arr + "&ord_id=" + ord_id,
                    success:function(datos){      
                
                        swal({
                            title: "Orden actualizada",
                            text: "La orden ha sido habilitada correctamente",
                            icon: "success",
                        }).then(function() {
                            window.location.href = "indexAdmin.php?modulo=Orden&controlador=Orden&funcion=index&ord_id=2";
    
                        });
                    }
                });   
    
            }else{
    
                swal({
                    title: 'Orden incompleta',
                    text: 'Debe de seleccionar minimo 2 y maximo 5 casos a la orden para habilitar esta orden',
                    icon: 'error',
                    buttons: {
                        confirm: {
                            className: 'btn btn-success'
                        }
                    }
                });
    
            }
        }
    
    });
    
    });
    
    $(document).on("click",".aprobarOrd" , function(){
    var url = $(this).attr("data-url");
    var ord_id=$("#ord_id").val();
    
    swal({
        title: "Aprobar orden",
        text: "Esta seguro de aprobar esta orden?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
     }).then((actualizar) => {
      
         if (actualizar) {
     
                 $.ajax({
                     url: url,
                     type: "POST",
                     data: "ord_id=" + ord_id,
                     success:function(datos){      
                 
                         swal({
                             title: "Orden aprobada",
                             text: "La orden ha sido aprobada correctamente",
                             icon: "success",
                         }).then(function() {
                             location.reload();
                         });
                     }
                 });   
             
         }else{
            swal({
                title: 'proceso Cancelado',
                text: 'Se Cancelo la aprobacion de la Orden',
                icon: 'error',
                buttons: {
                    confirm: {
                        className: 'btn btn-danger'
                    }
                }
            });
    
         }
    
     });
    
    });
    
    
    $(document).on("click",".finalizarOrd" , function(){
    var url = $(this).attr("data-url");
    var ord_id=$("#ord_id").val();
    
    swal({
        title: "Finalizar orden",
        text: "Si se finaliza una orden, y esta contiene casos sin cerrar dichos casos se desvincularan de esta orden,  Esta seguro de finalizar esta orden?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
     }).then((actualizar) => {
      
         if (actualizar) {
     
    
            var textarea = document.createElement('textarea');
            textarea.rows = 6;
            textarea.className = 'swal-content__textarea';
          
            // Set swal return value every time an onkeyup event is fired in this textarea
            textarea.onkeyup = function () {
              swal.setActionValue({
                confirm: this.value
              });
            };
          
            swal({
              text: 'Finalizar orden',
              content: textarea,
              buttons: {
                cancel: {
                  text: 'Cancel',
                  visible: true
                },
                confirm: {
                  text: 'button',
                  closeModal: false
                }
              }
            }).then(function (value) {
                var g = value;               
                if (g.length>0 && g.length<301) {
    
                $.ajax({
                    url: url,
                    type: "POST",
                    data: "ord_id=" + ord_id + "&justificacion=" + g,
                    success:function(datos){      
                
                        swal({
                            title: "Orden Finalizada",
                            text: "La orden ha sido finalizada correctamente",
                            icon: "success",
                        }).then(function() {
                            location.reload();
                        });
                    }
                }); 
    
    
              }else{
                swal('Error', 'Por favor diligencie el campo , puede ingresar como maximo 300 caracteres.', 'error');
              }
          
    
            });  
             
         }else{
            swal({
                title: 'proceso Cancelado',
                text: 'Se Cancelo la finalizacion de la Orden',
                icon: 'error',
                buttons: {
                    confirm: {
                        className: 'btn btn-danger'
                    }
                }
            });
    
         }
    
     });
    
    });
    
    /////////////////////////////   FIN DE ORDEN   ///////////////////////////////////////////////// 
    
        
        // Declaracion variables
        var arr = [];
    
      /////////////Camila ////////////////////////
        $(document).on("click",".confirmar", function(){
         var url = $(this).attr("data-url");
         var clave=$(".confir").val();
          $.ajax({
           url: url,
           type: "POST",
           data: "confir=" + clave,
            success:function(datos){
            $("#cambios").html(datos);
            }
          }); 
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
        
        
          $(".correo2").on('paste', function(e){
            e.preventDefault();
          });
          
          $(".correo2").on('copy', function(e){
            e.preventDefault();
          });
        
          $(".campos").on('paste', function(e){
            e.preventDefault();
          });
          
          $(".campos").on('copy', function(e){
            e.preventDefault();
          });
        
          $(document).on("click",".botonDatos",function(){
            $(".Datos").attr('disabled',true);          
          });
        
         $(document).on("click",".clo",function(){
            location.reload();
         });
    
          $(document).on("click",".Datos",function(){
           var correo = $(".correo2").val();
           var url = $(this).attr("data-url");
           var clave1=$(".clave1").val();
           var clave2=$(".clave2").val();
           
           if (correo.length>0 && clave1.length==7) {
               $.ajax({
                    url: url,
                    type: "POST",
                    data: "correo2=" + correo + "&clave1=" + clave1 + "&clave2=" + clave2,
                    success: function(datos) {                                                        
                    
                    }       
                });
        
              location.reload();
           }
        
           if(correo.length>0 && clave1.length!=7){
               $.ajax({
                    url: url,
                    type: "POST",
                    data: "correo2=" + correo,
                    success: function(datos) {
                                                                
                      }       
                });
                 location.reload();
           }
        
        
           if (clave1.length==7 && clave2.length==7 && correo.length==0) {
           
               $.ajax({
                    url: url,
                    type: "POST",
                    data: "clave1=" + clave1 + "&clave2=" + clave2,
                    success: function(datos) {
                                                                
                      }       
                });
                 location.reload();
           }
              
          });  
        
          $(document).on("keyup",".correo2",function(){
           
           var correo = $(".correo2").val();
           var clave1=$(".clave1").val();
           var url = $(this).attr("data-url");
           var expC=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/;
           var correo = $(this).val();
           $(this).attr('autocomplete','off')
           var cont = 0;
           var noValidos = '!"#$ª%&/·()=?¡<>~¬ç+{}[]°º^¨¨Ç`|,;:`´¨*¿'+"'";
                for (let a = 0; a < correo.length; a++) {
                    for (let b = 0; b < noValidos.length; b++) {
                        if (correo[a] == noValidos[b]) {
                            cont++;
                        }
                    }
                }
        
          error=0;      
        
          if (correo.length == 0) {
            error=error+1;
            $("#error1").html("<h5 class='text-danger'>Debe llenar el correo electronico</h5>");        
            $(".correo2").attr('class','form-control correo2 border border-danger');        
          }else if(correo.length>0){
            $("#error1").html("");        
            $(".correo2").attr('class','form-control correo2 border border-primary');        
          }
        
          if (correo.length>0) {
        
            if (!expC.test(correo)) {
             $("#error1").html("<h5 class='text-danger'>Definiendo el correo..</h5>");    
             error=error+1;      
            }else if(expC.test(correo)){
                $.ajax({
                    url: url,
                    type: "POST",
                    data: "correo3=" + correo,
                    success: function(datos) {
                      
                      if(datos!="") {
                       $("#error1").html(datos);
                       $(".Datos").attr('disabled',true);                    
                       error=error+1;                                           
                      $(".correo2").attr('class','form-control correo2 border border-danger');        
                      }else{
                      $(".correo2").attr('class','form-control correo2 border border-primary');        
                      }
                    }
                });
            }
          }  
        
            if (cont>0) {
              $("#error1").html("<h5 class='text-danger'>correo invalido</h5>");
              $(".correo2").attr('class','form-control correo2 border border-danger');        
                              
             error=error+1;
             }else{
            $(".correo2").attr('class','form-control correo2 border border-primary');        
             } 
        
           if (clave1.length==7){
            $.ajax({
              url: url,
              type: "POST",
              data: "clave1=" + clave1,
              success: function(datos) {
               if (datos!="") {
                $(".Datos").attr('disabled',true);  
             $(".correo2").attr('class','form-control correo2 border border-danger');        
                error=error+1;      
                }else{
                $(".correo2").attr('class','form-control correo2 border border-primary');          
                }
               }
              });
            }
        
           if (error>0) {
              $(".Datos").attr('disabled',true);          
              $("#error4").html("<h5 class='text-danger'>Debe llenar los campos correctamente</h5>");     
            }else{
              $(".Datos").attr('disabled',false);          
              $("#error4").html("");               
            }
          
          });
          
        
          $(document).on("keyup",".campos",function(){
        
          var clave1=$(".clave1").val();
          var clave2=$(".clave2").val();
          var url = $(".clave1").attr("data-url");
          var exp=/([A-Z]{1}[a-z]{1}[0-9]{5})+$/;
          var exp2=/([0-9]{5}[A-Z]{1}[a-z]{1})+$/;
          var correo = $(".correo2").val();
          var expC=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/;
        
          $(".clave1").attr('maxlength','7');
          $(".clave2").attr('maxlength','7');
        
          if (exp.test($(".clave1").val())) {
              var exp3=/([A-Z]{1}[a-z]{1}[0-9]{5})+$/;
            }else if (exp2.test($(".clave1").val())){
              var exp3=/([0-9]{5}[A-Z]{1}[a-z]{1})+$/;
            }
        
          errores=0;      
          
        
            if (clave1.length !=7) {
            $("#error2").html("<h5 class='text-danger'>Debe llenar la contrase&ntilde;a correctamente</h5>"); 
            $("#error1").html("");        
              errores=errores+1;
            }else if (clave1.length==7){
            $.ajax({
              url: url,
              type: "POST",
              data: "clave1=" + clave1,
              success: function(datos) {
               if (datos!="") {
                $("#error2").html(datos);        
                $(".Datos").attr('disabled',true);                        
                errores=errores+1;      
                }
               }
              });
            }
        
         if (exp3.test(clave1)) {
         }else{
              $("#error2").html("<h5 class='text-danger'>Contrase&ntilde;a invalida</h5>"); 
               errores=errores+1;
             }
        
           if (clave1.length > 0 && !exp3.test(clave1)) {
              $("#error2").html("<h5 class='text-danger'>Contrase&ntilde;a invalida</h5>"); 
              errores=errores+1;
           }else if (clave1.length > 0 && exp3.test(clave1)){
              $("#error2").html(""); 
           }
           
           if ( clave2.length !=7) {
             $("#error3").html("<h5 class='text-danger'>Debe confirmar la contrase&ntilde;a</h5>"); 
            $("#error1").html("");              
              errores=errores+1;
           }else{
           $("#error3").html("");        
           }
        
           if (clave1!=clave2) { 
              errores=errores+1;
             $("#error2").html("<h5 class='text-danger'>Las contrase&ntilde;as no coinciden</h5>");       
             $("#error3").html("<h5 class='text-danger'>Las contrase&ntilde;as no coinciden</h5>"); 
           }else{
           $("#error2").html("");        
           $("#error3").html("");            
           }
        
          if(expC.test(correo)){
                $.ajax({
                    url: url,
                    type: "POST",
                    data: "correo3=" + correo,
                    success: function(datos) {
                      if(datos!="") {
                       $(".Datos").attr('disabled',true);                    
                       errores=errores+1;                                           
                      }
                    }
                });
            }
        
           if (errores>0) {
              $(".Datos").attr('disabled',true);          
              $("#error4").html("<h5 class='text-danger'>Debe llenar los campos correctamente</h5>");
              $(".clave1").attr('class','form-control cl1 campos  clave1 border border-danger');                    
              $(".clave2").attr('class','form-control cl1 campos  clave2 border border-danger');                    
           }else{
              $(".Datos").attr('disabled',false); 
              $("#error4").html("");   
              $(".clave1").attr('class','form-control cl1 campos  clave1 border border-primary');                    
              $(".clave2").attr('class','form-control cl1 campos  clave2 border border-primary');                    
        
           }
          
         });
      
    
        //////////////////////////////////////////////////////////
    
      //////////////////Daniel //////////////////
    
      $('#Tbl-deterioro').DataTable({
        "pageLength": 5,
        initComplete: function() {
            this.api().columns().every(function() {
                var column = this;
                var select = $('<select class="form-control"><option value=""></option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
    
                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });
    
                column.data().unique().sort().each(function(d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
        }
    });
    
    
    $(document).on("click", ".cerrar", function() { location.reload(); });
    
    $(document).on("click", ".guardar", function() {
        var url = $(this).attr("data-url");
        var nom = $(".nombreD").val();
        var dan = $(".Dano").val();
        var cla = $(".Clasi").val();
        $.ajax({
            url: url,
            type: "POST",
            data: "det_nombre=" + nom + "&det_tipo_deterioro=" + dan + "&det_clasificacion=" + cla,
            success: function(datos) {
                $("#formEjemplo")[0].reset();
                $("#errores").html(datos);
            }
        });
    });
    
    $(document).on("keyup", "#filtro", function() {
        var url = $(this).attr("data-url");
        var valor = $(this).val();
        $.ajax({
            url: url,
            type: "POST",
            data: "valor=" + valor,
            success: function(datos) {
                $("tbody").html(datos);
            }
        });
    });
    
    $(document).on("click", "#editar", function() {
        var id = $(this).val();
        var url = $(this).attr("data-url");
        $.ajax({
            url: url,
            type: "POST",
            data: "id=" + id,
            success: function(datos) {
                $("#contenido_editar").html(datos);
                $('#modal_editar').modal();
            }
        });
    });
    
      //Se creo esta funcion para el modal de "Eliminar"(Swit-Alert->Nuevo)
      $(document).on("click", "#eliminar", function() {
    
        var id = $(this).val();
        var url = $(this).attr("data-url");
        var deterioros_id=$("#deterioros_id").val();
        var cont=0;
    
        arreglo = deterioros_id.split(",");
        // alert(id);
    
        for(x=0; x < deterioros_id.length; x++){
            if(id==arreglo[x]){
                // alert(deterioros_id[x]);
                 cont=1;
            }
        }
        swal({
            title: "Eliminacion de deterioro",
            text: "Esta seguro de eliminar esta deterioro?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((eliminar) => {
    
            if(cont==0 && eliminar){
              
                $.ajax({
                    url: url,
                    type: "POST",
                    data: "id=" + id,
                    success: function(datos) {
                        swal({
                            title: "Deterioro Eliminada",
                            text: "El deterioro se ha eliminado correctamente",
                            icon: "success",
                        }).then(function() {
                            location.reload();
                        });
                    }
                });
      
            }else if(cont==1){
                swal({
                    title: 'Deterioro Cancelada',
                    text: 'El deterioro esta Vinculado a un Caso',
                    icon: 'error',
                    buttons: {
                        confirm: {
                            className: 'btn btn-danger'
                        }
                    }
                });
    
            }
        })
    
    
    });
    
    
    $(document).on("keyup", ".nombred", function() {
    
        var nombre = $(".nombred").val();
        var expD = '!"#$%&/()=?¡+{}çÇ+-_`@ª^~€<>.·[]°|,;:´¨*¿';
        var c = 0;
        for (let l = 0; l < nombre.length; l++) {
            for (let k = 0; k < expD.length; k++) {
                if (nombre[l] == expD[k]) {
                    c++;
                }
            }
        }
    
        if (nombre.length == 0) {
            $(".actualizar").attr('disabled', true);
            $("#errord").html("<h5 class='text-danger'>(*) Debe llenar el nombre del detrioro</h5>");
        }
        if (nombre.length > 0 && c > 0) {
            $(".actualizar").attr('disabled', true);
            $(this).val(nombre.substr(0, nombre.length - 1));
        }
        if (nombre.length > 0 && c == 0) {
            $(".actualizar").attr('disabled', false);
            $("#errord").html("");
        }
    });
    
    $(document).on("keyup", ".nombreD", function() {
    
        var nombre = $(".nombreD").val();
        var expD = '!"#$%&/()=?¡+{}çÇ+-_`@çª<>~€.·[]°|,^;:´¨*¿';
        var c = 0;
        for (let l = 0; l < nombre.length; l++) {
            for (let k = 0; k < expD.length; k++) {
                if (nombre[l] == expD[k]) {
                    c++;
                }
            }
        }
    
        if (c > 0) {
            $(".guardar").attr('disabled', true);
            $(this).val(nombre.substr(0, nombre.length - 1));
        } else if (nombre.length > 0 && c == 0) {
            $(".guardar").attr('disabled', false);
        }
    
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
    
        ///////////////// Kevin Usuarios ///////////////////////
    
        $(document).on("keyup", "#search", function() {
            let url = $(this).attr("data-url");
            let value = $(this).val();
    
    
            $.ajax({
                url: url,
                type: 'POST',
                data: 'value=' + value,
                success: function(data) {
                    $('tbody').html(data);
    
                }
            });
        });
    
        // Funcion para validar si un correo esta disponible.
        $(document).on("change", "#correo", function() {
            let url = $(this).attr("data-url");
            let value = $(this).val();
    
            $.ajax({
                url: url,
                type: 'POST',
                data: 'value=' + value,
                success: function(data) {
                    $('#confirm').html(data);
                }
            });
        })
    
        // Funcion necesaria para las datatables
        $('#users-table').DataTable({
            "pageLength": 5,
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    var select = $('<select class="form-control"><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
    
                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
    
                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }
        });
    
        // Funcion para eliminar a un usuario
        $('tr td #delete').click(function(ev) {
    
            ev.preventDefault();
            let name = $(this).parents('tr').find('td:first').text();
            let id = $(this).attr('data-id');
            let url = $(this).attr('data-url');
            let self = this;
    
            swal({
                title: 'Realmente quieres eliminar al usuario ' + name + ' ?',
                text: 'El usuario sera inhabilitado del sistema',
                icon: 'warning',
                buttons: {
                    cancel: {
                        className: 'btn btn-danger',
                        visible: true
                    },
                    confirm: {
                        className: 'btn btn-success'
                    }
                }
            }).then((result) => {
                if (result) {
                    // console.log('hola');
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: 'value=' + id,
                        success: function() {
                            swal({
                                title: 'Eliminado!',
                                text: 'El usuario ha sido eliminado correctamente',
                                type: 'success',
                                buttons: {
                                    confirm: {
                                        className: 'btn btn-success'
                                    }
                                }
                            }).then(function() {
                                location.reload();
                            });
                        }
                    });
                }
            });
    
        });
    
        // Funcion para activar a un usuario
        $('tr td #activate').click(function(ev) {
    
            ev.preventDefault();
            let name = $(this).parents('tr').find('td:first').text();
            let id = $(this).attr('data-id');
            let url = $(this).attr('data-url');
            let self = this;
    
            swal({
                title: 'Realmente quieres activar al usuario ' + name + ' ?',
                text: 'El usuario sera activado nuevamente en el sistema',
                icon: 'warning',
                buttons: {
                    cancel: {
                        className: 'btn btn-danger',
                        visible: true
                    },
                    confirm: {
                        className: 'btn btn-success'
                    }
                }
            }).then((result) => {
                if (result) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: 'value=' + id,
                        success: function() {
                            swal({
                                title: 'Reactivado!',
                                text: 'El usuario ha sido activado correctamente',
                                type: 'success',
                                buttons: {
                                    confirm: {
                                        className: 'btn btn-success'
                                    }
                                }
                            }).then(function() {
                                location.reload();
                            })
                        }
                    });
                }
            });
    
        });
    
        $(document).on("submit","#form_user_edit",function(){
            valid = true;
    
            form = document.getElementsByClassName("validEdit");
    
            for (let i = 0; i < form.length; i++) {
                if (form[i].value == "") {
                    swal("Advertencia", "Ningun campo debe estar vacio:",{
                        icon : "warning",
                        buttons: {        			
                            confirm: {
                                className : 'btn btn-danger'
                            }
                        },
                    });
                    valid = false;
                }
            }
            return valid;
        });
        
       ///////////////////////////Sandra Barrio ////////////////////////////
    
        //Se creo esta funcion para que NO ingrese el usuario caracteres especiales en la vista "Registrar"
        $(document).on("keyup", ".barrioN", function() {
    
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
                // $(this).val(barrioNom.substr(0, barrioNom.length - 1));
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
                //$(this).attr('Class','form-control is-invalid validacion');
                $("#Registrar").attr('disabled', true);
                $("#error").html("<p class='text-danger'>No ingrese caracteres especiales</p>");
            } else {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
                //$(this).attr('Class','form-control is-valid validacion');
                $("#Registrar").attr('disabled', false);
                $("#error").html("");
            }
        });
    
        //Se creo esta funcion para que NO ingrese el usuario caracteres especiales en la vista "Editar"
        //y para validacion de campos vacios
        $(document).on("keyup", ".barrioEditar", function() {
    
            var barrioNom = $(this).val();
            var barDes = $("#bar_descripcion").val();
            var cont = 0;
    
            var noValidos = "!#$%&/()=?¡+{}[]°|',;:´¨*¿";
            for (let a = 0; a < barrioNom.length; a++) {
                for (let b = 0; b < noValidos.length; b++) {
                    if (barrioNom[a] == noValidos[b]) {
                        cont++;
    
                    }
                }
            }
            if (barDes == '') {
    
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
                $("#Actualizar").attr('disabled', true);
                $("#errorEdit").html("<span class='text-danger'>No puede Dejar Campos Vacios</span>");
    
                $("#bar_descripcion").focus();
                return false;
            }
            if (cont > 0) {
    
                // $(this).val(barrioNom.substr(0, barrioNom.length - 1));
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
                //$(this).attr('Class','form-control is-invalid validacion');
                $("#Actualizar").attr('disabled', true);
                $("#errorEdit").html("<p class='text-danger'>No ingrese caracteres especiales</p>");
    
            } else {
    
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
                // $(this).attr('Class','form-control is-valid validacion');
                $("#Actualizar").attr('disabled', false);
                $("#errorEdit").html("");
            }
    
    
    
        });
        //Funcion para select
        $(document).on("click", ".barrioSelect",function(){
            var select = $(this).val();
           
            if (select > 0) {
            
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
                // $(this).attr('Class','form-control is-valid validacion');
                $("#Actualizar").attr('disabled',false);
                $("#errorSelect").html("");
              
            }
            else {
              // $(this).val(barrioNom.substr(0, barrioNom.length - 1));
              $(this).removeClass('is-valid');
              $(this).addClass('is-invalid');
              //$(this).attr('Class','form-control is-invalid validacion');
              $("#Actualizar").attr('disabled',true);
              $("#errorSelect").html("<span class='text-danger'>Debe seleccionar una comuna</span>");
            }
      
        }); 
        //Se creo esta funcion para el modal de "Editar"
        $(document).on("click", "#actuali", function() {
    
            var bar_id = $(this).val();
            var url = $(this).attr("data-url");
    
    
            $.ajax({
                url: url,
                type: "POST",
                data: "bar_id=" + bar_id,
                success: function(datos) {
                    $("#editarB").html(datos);
                    $("#Actualizacion").modal();
    
                }
            });
    
        });
       
        //Se creo esta funcion para el modal de "Eliminar"(Swit-Alert->Nuevo)
        $(document).on("click", "#elimi", function() {
    
            var barrioElimi = $(this).val();
            var url = $(this).attr("data-url");
            var barrios_id=$("#barrios_id").val();
            var cont=0;
            arreglo = barrios_id.split(",");
            // alert(barrioElimi);
            for(x=0; x < barrios_id.length; x++){
                if(barrioElimi==arreglo[x]){
                    // alert(barrios_id[x]);
                     cont=1;
                }
            }
            swal({
                title: "Eliminacion de barrio",
                text: "Esta seguro de eliminar este barrio?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((eliminar) => {
    
                if(cont==0 && eliminar){
                  
                    $.ajax({
                        url:url,
                        type: "POST",
                        data: "barrioElimi=" + barrioElimi,
                        success: function(datos){
                            swal({
                                title: "Barrio Eliminada",
                                text: "El barrio se ha eliminado correctamente",
                                icon: "success",
                            }).then(function() {
                                location.reload();
                            });
                        }
                    });
          
                }else if(cont==1){
                    swal({
                        title: 'Barrio Cancelada',
                        text: 'El barrio esta Vinculado a un Tramo',
                        icon: 'error',
                        buttons: {
                            confirm: {
                                className: 'btn btn-danger'
                            }
                        }
                    });
    
                }
            })
    
    
        });
    
    
        //filtro con datatables  y paginacion
        $('#multi-filter-select').DataTable({
            "pageLength": 5,
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    var select = $('<select class="form-control"><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
    
                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
    
                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }
        });
        ///////////////////////Aqui termina las funciones de tbl_barrio///////////////////
    
        ////////Sebastian//
    
        $(document).on("change", "#tipoCalzada", function() {
    
            var tipoCalzada = $(this).val();
            var url = $(this).attr("data-url");
    
            $.ajax({
    
                url: url,
                type: "POST",
                data: "tipoCalzadaSelect=" + tipoCalzada,
                success: function(dato) {
                    $('#calzada').html(dato);
                }
    
            });
    
        });
    
        //////jquery para el modal de BARRIO
    
        $(document).on("keyup", "#buscadorBarrio", function() {
            var url = $(this).attr("data-url");
            var Busqueda = $(this).val();
    
            $.ajax({
    
                url: url,
                type: "POST",
                data: "barrioBuscado=" + Busqueda,
                success: function(busqueda) {
                    $("#contenidoModalBarrio").html(busqueda);
                }
    
    
            })
    
    
        });
    
        $(document).on("keyup", "#buscadorBarrio", function() {
            var url = $(this).attr("data-paginacionUrl");
            var Busqueda = $(this).val();
    
            $.ajax({
    
                url: url,
                type: "POST",
                data: "barrioBuscado=" + Busqueda,
                success: function(paginacion) {
                    $("#contenidoPaginacionBarrio").html(paginacion);
                }
    
    
            })
    
    
        });
    
        //Reflejar la seleccion del barrio del modal al input del formulario
        $(document).on("click", "#seleccionarBarrio", function() {
    
            var url = $(this).attr("data-url");
            var barrio = $(this).val();
    
            $.ajax({
    
                url: url,
                type: "POST",
                data: "barrioSeleccionado=" + barrio,
                success: function(dato) {
                    $('#modalBarrio').modal('hide');
                    $('#campoBarrio').attr("value", dato);
                    $('#barrio_id').val(barrio);
    
                }
    
            });
    
        });
    
        ////////jquery para el modal de EJE VIAL
    
        $(document).on("click", "#buscarEje", function() {
    
            var url = $(this).attr("data-paginacionUrl");
            var jerarquia = $("#jerarquiaSelect").val();
    
            $.ajax({
    
                url: url,
                type: "POST",
                data: "JerarquiaSelect=" + jerarquia,
                success: function(dato) {
    
                    $("#contenidoPaginacion").html(dato);
    
    
                }
    
            });
    
        });
    
        //Funcion que realiza la consulta de los ejes viales para el modal
        $(document).on("click", "#buscarEje", function() {
    
            var url = $(this).attr("data-url");
            var jerarquia = $("#jerarquiaSelect").val();
    
    
            if (jerarquia != "") {
    
                $.ajax({
    
                    url: url,
                    type: "POST",
                    data: "JerarquiaSelect=" + jerarquia,
                    success: function(dato) {
    
                        $("#contenidoEje").html(dato);
    
    
                    }
    
                });
    
            } else {
                $("#modalEje").modal('hide');
    
    
                swal("Error", "Seleccione una Jerarquia Vial Previamente para definir los ejes viales", {
                    icon: "error",
                    buttons: {
                        confirm: {
                            className: 'btn btn-danger'
                        }
                    },
                });
            }
    
        });
    
        //JQUERY para seleccionar el eje y ponerlo ene l input
        $(document).on("click", "#seleccionarEje", function() {
    
            var url = $(this).attr("data-url");
            var Eje = $(this).val();
    
            $.ajax({
    
                url: url,
                type: "POST",
                data: "ejeSeleccionado=" + Eje,
                success: function(dato) {
                    $('#modalEje').modal('hide');
                    $('#campoEje').attr("value", dato);
                    $('#eje_vial_id').val(Eje);
    
                }
    
            });
    
        });
    
        //filtro de lo eje en el modal
        $(document).on("keyup", "#barraBuscarEje", function() {
            var url = $(this).attr("data-url");
            var Busqueda = $(this).val();
            var jerarquia = $("#jerarquiaSelect").val();
    
            $.ajax({
    
                url: url,
                type: "POST",
                data: "EjeBuscado=" + Busqueda + "&JerarquiaSelect=" + jerarquia,
                success: function(busqueda) {
                    $("#contenidoEje").html(busqueda);
                }
    
    
            })
    
    
        });
    
        //funcion que adecúa la paginacion segun el filtro
        $(document).on("keyup", "#barraBuscarEje", function() {
    
            var url = $(this).attr("data-paginacionUrl");
            var Busqueda = $(this).val();
            var jerarquia = $("#jerarquiaSelect").val();
    
            $.ajax({
    
                url: url,
                type: "POST",
                data: "JerarquiaSelect=" + jerarquia + "&EjeBuscado=" + Busqueda,
                success: function(dato) {
    
                    $("#contenidoPaginacion").html(dato);
    
    
                }
    
            });
    
        });
    
        //jquery usado para la parte del detalle del tramo
    
        //funcion que reemplaza el formulario de detalle por el formulario para editar tramo en una misma interfaz
        $(document).on("click", "#editarTramo", function() {
    
            var url = $(this).attr("data-url");
            var tra_id = $(this).attr("data-id");
    
            $.ajax({
    
                url: url,
                type: "POST",
                data: "tra_id=" + tra_id,
                success: function(formulario) {
                    $("#contenidoFormulario").html(formulario);
                }
    
    
            });
    
        });
    
        ///JQUERY VALIDACIONES DE TRAMOS///////////////////////////////////////////////////
    
        //validacion del nombre de la via en tramo
        $(document).on("keyup", ".valCaracteresEspeciales", function() {
    
            var valorInput = $(this).val();
            var cont = 0;
            var noValidos = '!"#$%&/()=?¡+{}[]°|,;:´¨*¿/*-+<>_';
            for (let a = 0; a < valorInput.length; a++) {
                for (let b = 0; b < noValidos.length; b++) {
                    if (valorInput[a] == noValidos[b]) {
                        cont++;
                    }
                }
            }
            if (cont > 0) {
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
                $('#error').html("<h5 style='color:rgb(250,0,0);'><i class='fas fa-exclamation-circle'></i>No ingrese caracteres especiales</h5>");
                $('#guardarRegistro').attr('disabled', true);
    
            } else {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
                $('#error').html("");
                $('#guardarRegistro').attr('disabled', false);
    
            }
    
        });
    
        //validacion del campo del segmento
        $(document).on("keyup", ".valSegmento", function() {
    
            var valorInput = $(this).val();
            var regExp = /\d{6}/;
    
    
            $('.vacio').html("");
            if (regExp.test(valorInput)) {
    
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
                $('#errorSegmento').html("<h5 style='color:rgb(250,0,0);'><i class='fas fa-exclamation-circle'></i>la longitud del segmento debe ser no mayor a 5 digitos</h5>");
                $('#guardarRegistro').attr('disabled', true);
            } else {
    
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
                $('#errorSegmento').html("");
                $('#guardarRegistro').attr('disabled', false);
    
            }
    
        });
    
        //validacion de los campos del ancho de via
        $(document).on("keyup", ".valAncho", function() {
    
            var valorInput = $(this).val();
    
    
            if (valorInput > 10 || valorInput < 1) {
    
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
                $('#errorAncho').html("<h5 style='color:rgb(250,0,0);'><i class='fas fa-exclamation-circle'></i>no debe sobrepasar los 10 metros o ser menor que 1</h5>");
                $('#guardarRegistro').attr('disabled', true);
            } else {
    
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
                $('#errorAncho').html("");
                $('#guardarRegistro').attr('disabled', false);
    
            }
    
        });
    
        //funcion que avisa al usuario del cambio del eje vial
        $(document).on("change", "#jerarquiaSelect", function() {
    
    
            $('#contenidoEje').html("");
            $('#cambiarEje').html("<h5 style='color:rgb(64,191,255);'><i class='fas fa-exclamation-circle'></i>Por favor debe seleccionar un eje vial antes de enviar el formulario</h5>");
    
            $('#guardarRegistro').attr('disabled', true);
    
        });
    
        //funcion que detecta que el usuario ya eligio un eje vial adecuado y activa el formulario
        $(document).on("click", "#seleccionarEje", function() {
            $('#guardarRegistro').attr('disabled', false);
            $('#cambiarEje').html("");
        });
    
        //funcion que valida que ningun campo en el formulario este vacio
        $(document).on("submit", ".form", function() {
    
            var valorNombre = $("#inputNombreVia").val();
            var valorNomen = $("#inputNomenclatura").val();
            var valorTipc = $("#tipoCalzada").val();
            var valorElemento = $("#elementoSelect").val();
            var valorCalzada = $("#calzada").val();
            var valorSegmento = $("#inputSegmento").val();
            var valorJerarquia = $("#jerarquiaSelect").val();
            var barrio = $("#campoBarrio").val();
            var eje = $("#campoEje").val();
    
            let elFormularioEsValido = true;
    
            if (valorNombre == "" || valorNomen == "" || valorTipc == "" || valorElemento == "" || valorCalzada == "" || valorSegmento == "" || valorJerarquia == "" || barrio == "" || eje == "") {
    
                swal("Error", "Por favor no deje campos sin diligenciar", {
                    icon: "error",
                    buttons: {
                        confirm: {
                            className: 'btn btn-danger'
                        }
                    },
                });
                //$('#vacio').html("<h5 style='color:rgb(250,0,0);'><i class='fas fa-exclamation-circle'></i>Por favor Diligencie los campos vacios</h5>");
                elFormularioEsValido = false;
    
    
            }
            return elFormularioEsValido;
        });
    
        //datatable de la vista de consultar con 20 registros por pagina
        $('#basic-datatables-consultar').DataTable({
            "pageLength": 20,
        });
    
        //FUNCIONES PERTENECIENTES A LA PAGINACION DE LOS MODALES
    
    
        $(document).on("click", ".elemPaginacion", function() {
    
            /* funcion que muestraa la pagina a la cual el usuario le dio click en el modal de eje vial
            tambien detecta si la tabla esta filtrada para realizar la paginacion respectiva*/
    
            var url = $(this).attr("data-urlPagina");
            var pagina = $(this).attr("data-numeroPagina");
            var jerarquia = $("#jerarquiaSelect").val();
            var limiteFor = $(this).attr("data-paginasTotales");
    
            //por si se encuentra filtrada la tabla
            var seUsoElFiltro = $(this).attr("data-filtro");
            var busqueda = $(this).attr("data-busqueda");
            var urlFiltro = "";
    
            //alert("pagina select: " + pagina);
            var paginaId = parseInt(pagina) + 1;
    
            for ($i = 1; $i <= limiteFor; $i++) {
                $("#pagina" + $i).removeClass("active");
                $("#pagina" + $i).addClass("text-dark");
            }
            $("#pagina" + paginaId).removeClass("text-dark");
            $("#pagina" + paginaId).addClass("active");
    
            if (pagina == limiteFor - 1) {
                $("#siguiente").addClass("disabled");
            } else {
                $("#siguiente").removeClass("disabled");
            }
    
            if (pagina <= 0) {
                $("#anterior").addClass("disabled");
            } else {
    
                $("#anterior").removeClass("disabled");
            }
    
            if (typeof(seUsoElFiltro) != "undefined" && busqueda != "") {
                //alert("se uso el filtro");
                urlFiltro = "&seUsoElFiltro=" + seUsoElFiltro + "&busqueda=" + busqueda;
            }
    
            $("#cuentaPaginas").html("Pagina: " + paginaId + " De " + limiteFor);
    
            $.ajax({
    
                url: url,
                type: "POST",
                data: "pagina=" + pagina + "&JerarquiaSelect=" + jerarquia + urlFiltro,
                success: function(dato) {
    
                    $("#contenidoEje").html(dato);
    
                }
    
    
            })
        });
    
        $(document).on("click", ".paginacionStatic", function() {
    
            /* funcion de la paginacion de los eje de los botones de "siguiente" y "anterior"
            tambien funciona cuando la tabla esta filtradad*/
    
            var url = $(this).attr("data-urlPagina");
            var jerarquia = $("#jerarquiaSelect").val();
            var accion = $(this).attr("data-accion");
            var limiteFor = $(this).attr("data-paginasTotales");
    
            //por si la longitud de la paginacion es muy grande, ir "rotando" la paginaciona  medida qe se avanza
            var inicioCuentaPaginacion = $("#inicioCuentaEje").val();
            var finCuentaPaginacion = $("#finCuentaEje").val();
    
            //por si se encuentra filtrada la tabla
            var seUsoElFiltro = $(this).attr("data-filtro");
            var busqueda = $(this).attr("data-busqueda");
            var urlFiltro = "";
    
            var pagina = null;
    
            for ($i = 1; $i <= limiteFor; $i++) {
    
                //alert($("#pagina" + $i).hasClass("active"));
    
                if ($("#pagina" + $i).hasClass("active")) {
    
                    if (accion == 1) {
                        pagina = $i + 1;
                    } else {
                        pagina = $i - 1;
                    }
    
                    //alert("pagina: " + pagina);
    
    
                }
                $("#pagina" + $i).removeClass("active");
                $("#pagina" + $i).addClass("text-dark");
    
    
            }
    
            $("#pagina" + pagina).addClass("active");
            $("#pagina" + pagina).removeClass("text-dark");
    
            pagina--; //se decrementa la pagina para realizar la consulta correcta en el controlador
    
            //alert("pagina: " + (pagina + 1) + " numeroPaginas: " + limiteFor);
    
    
    
            if (pagina + 1 >= limiteFor) {
                $("#siguiente").addClass("disabled");
    
                if (limiteFor > finCuentaPaginacion) {
                    /*condicion para cuando el numero de paginas excede las 7 paginas y se necesita que se vaya rotando
                    los botones de la paginacion, se ejecuta cuando se llega a la penultima pagina y se quiere pasar a la ultima*/
                    $("#pagina" + inicioCuentaPaginacion).css('display', 'none');
                    inicioCuentaPaginacion++;
                    finCuentaPaginacion++;
                    $("#pagina" + finCuentaPaginacion).css('display', 'inline');
                }
            } else {
                $("#siguiente").removeClass("disabled");
    
                //por si la paginacion es demasiado larga para la interfaz
                if (pagina + 1 > finCuentaPaginacion) {
    
                    //alert("prueba");
                    $("#pagina" + inicioCuentaPaginacion).css('display', 'none');
                    inicioCuentaPaginacion++;
                    finCuentaPaginacion++;
                    $("#pagina" + finCuentaPaginacion).css('display', 'inline');
    
    
                }
            }
    
    
            if (pagina + 1 <= 1) {
                $("#anterior").addClass("disabled");
    
                if (pagina + 1 < inicioCuentaPaginacion) {
                    //alert("prueba");
    
                    $("#pagina" + finCuentaPaginacion).css('display', 'none');
                    inicioCuentaPaginacion--;
                    finCuentaPaginacion--;
                    $("#pagina" + inicioCuentaPaginacion).css('display', 'inline');
                }
            } else {
    
                $("#anterior").removeClass("disabled");
    
                if (pagina + 1 < inicioCuentaPaginacion) {
    
                    $("#pagina" + finCuentaPaginacion).css('display', 'none');
                    inicioCuentaPaginacion--;
                    finCuentaPaginacion--;
                    $("#pagina" + inicioCuentaPaginacion).css('display', 'inline');
                }
            }
    
    
    
    
            $("#inicioCuentaEje").val(inicioCuentaPaginacion);
            $("#finCuentaEje").val(finCuentaPaginacion);
    
            //alert("paginaInicio: " + inicioCuentaPaginacion + " paginaFin: " + finCuentaPaginacion);
    
    
            if (typeof(seUsoElFiltro) != "undefined" && busqueda != "") {
                //alert("se uso el filtro");
                urlFiltro = "&seUsoElFiltro=" + seUsoElFiltro + "&busqueda=" + busqueda;
            }
    
            $("#cuentaPaginas").html("Pagina: " + (pagina + 1) + " De " + limiteFor);
    
            $.ajax({
    
                url: url,
                type: "POST",
                data: "pagina=" + pagina + "&JerarquiaSelect=" + jerarquia + urlFiltro,
                success: function(dato) {
    
                    $("#contenidoEje").html(dato);
    
                }
    
            })
    
        });
    
        $(document).on("click", ".elemPaginacionB", function() {
            /*funcion para las paginas de los registros del modal de barrio (funciona igual que el de los ejes)*/
    
            var url = $(this).attr("data-urlPagina");
            var pagina = $(this).attr("data-numeroPagina");
            var limiteFor = $(this).attr("data-paginasTotales");
    
            //por si se encuentra filtrada la tabla
            var seUsoElFiltro = $(this).attr("data-filtro");
            var busqueda = $(this).attr("data-busqueda");
            var urlFiltro = "";
    
            //alert("pagina select: " + pagina);
            var paginaId = parseInt(pagina) + 1;
    
            for ($i = 1; $i <= limiteFor; $i++) {
                $("#paginaB" + $i).removeClass("active");
                $("#paginaB" + $i).addClass("text-dark");
            }
            $("#paginaB" + paginaId).removeClass("text-dark");
            $("#paginaB" + paginaId).addClass("active");
    
            if (pagina == limiteFor - 1) {
                $("#siguienteB").addClass("disabled");
            } else {
                $("#siguienteB").removeClass("disabled");
            }
    
            if (pagina <= 0) {
                $("#anteriorB").addClass("disabled");
            } else {
    
                $("#anteriorB").removeClass("disabled");
            }
    
            if (typeof(seUsoElFiltro) != "undefined" && busqueda != "") {
                //alert("se uso el filtro");
                urlFiltro = "&seUsoElFiltro=" + seUsoElFiltro + "&busqueda=" + busqueda;
            }
    
            $("#cuentaPaginasB").html("Pagina: " + paginaId + " De " + limiteFor);
    
            $.ajax({
    
                url: url,
                type: "POST",
                data: "pagina=" + pagina + urlFiltro,
                success: function(dato) {
    
                    $("#contenidoModalBarrio").html(dato);
    
                }
    
    
            })
        });
    
        $(document).on("click", ".paginacionStaticB", function() {
    
            /*funcion para los botones de "anterior" y "siguiente" en la paginacion del modal de barrio*/
    
            var url = $(this).attr("data-urlPagina");
            var accion = $(this).attr("data-accion");
            var limiteFor = $(this).attr("data-paginasTotales");
    
            //por si la longitud de la paginacion es muy grande, ir "rotando" la paginaciona  medida qe se avanza
            var inicioCuentaPaginacion = $("#inicioCuentaBarrio").val();
            var finCuentaPaginacion = $("#finCuentaBarrio").val();
    
            //por si se encuentra filtrada la tabla
            var seUsoElFiltro = $(this).attr("data-filtro");
            var busqueda = $(this).attr("data-busqueda");
            var urlFiltro = "";
    
            var pagina = null;
    
            for ($i = 1; $i <= limiteFor; $i++) {
    
                //alert($("#pagina" + $i).hasClass("active"));
    
                if ($("#paginaB" + $i).hasClass("active")) {
    
                    if (accion == 1) {
                        pagina = $i + 1;
                    } else {
                        pagina = $i - 1;
                    }
    
                    //alert("pagina: " + pagina);
    
    
                }
                $("#paginaB" + $i).removeClass("active");
                $("#paginaB" + $i).addClass("text-dark");
    
    
            }
    
            $("#paginaB" + pagina).addClass("active");
            $("#paginaB" + pagina).removeClass("text-dark");
    
            pagina--;
    
            if (pagina + 1 >= limiteFor) {
                $("#siguienteB").addClass("disabled");
    
                if (limiteFor > finCuentaPaginacion) {
                    /*condicion para cuando el numero de paginas excede las 7 paginas y se necesita que se vaya rotando
                    los botones de la paginacion, se ejecuta cuando se llega a la penultima pagina y se quiere pasar a la ultima*/
                    $("#paginaB" + inicioCuentaPaginacion).css('display', 'none');
                    inicioCuentaPaginacion++;
                    finCuentaPaginacion++;
                    $("#paginaB" + finCuentaPaginacion).css('display', 'inline');
                }
            } else {
                $("#siguienteB").removeClass("disabled");
    
                if (pagina + 1 > finCuentaPaginacion) {
    
                    //alert("prueba");
                    $("#paginaB" + inicioCuentaPaginacion).css('display', 'none');
                    inicioCuentaPaginacion++;
                    finCuentaPaginacion++;
                    $("#paginaB" + finCuentaPaginacion).css('display', 'inline');
    
    
                }
            }
    
            if (pagina + 1 <= 1) {
                $("#anteriorB").addClass("disabled");
    
                if (pagina + 1 < inicioCuentaPaginacion) {
                    //alert("prueba");
    
                    $("#paginaB" + finCuentaPaginacion).css('display', 'none');
                    inicioCuentaPaginacion--;
                    finCuentaPaginacion--;
                    $("#paginaB" + inicioCuentaPaginacion).css('display', 'inline');
                }
            } else {
    
                $("#anteriorB").removeClass("disabled");
    
                if (pagina + 1 < inicioCuentaPaginacion) {
    
                    $("#paginaB" + finCuentaPaginacion).css('display', 'none');
                    inicioCuentaPaginacion--;
                    finCuentaPaginacion--;
                    $("#paginaB" + inicioCuentaPaginacion).css('display', 'inline');
                }
            }
    
            $("#inicioCuentaBarrio").val(inicioCuentaPaginacion);
            $("#finCuentaBarrio").val(finCuentaPaginacion);
    
            //alert("paginaInicio: " + inicioCuentaPaginacion + " paginaFin: " + finCuentaPaginacion);
    
    
            if (typeof(seUsoElFiltro) != "undefined" && busqueda != "") {
                //alert("se uso el filtro");
                urlFiltro = "&seUsoElFiltro=" + seUsoElFiltro + "&busqueda=" + busqueda;
            }
    
            $("#cuentaPaginasB").html("Pagina: " + (pagina + 1) + " De " + limiteFor);
    
    
            $.ajax({
    
                url: url,
                type: "POST",
                data: "pagina=" + pagina + urlFiltro,
                success: function(dato) {
    
                    $("#contenidoModalBarrio").html(dato);
    
                }
    
    
            })
    
    
        });
    
        /////////////fin jquery tramo////////////////////////////////////////////
    
    
        /////Jquery para el modulo de Caso Sebastian/Kevin/Daniel//////////
    
        $('#datatable-entorno').DataTable({
            "pageLength": 5,
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    var select = $('<select class="form-control"><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
    
                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
    
                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }
        });
    
        $('#datatable-deterioro').DataTable({
             "pageLength": 5,
             initComplete: function() {
                 this.api().columns().every(function() {
                     var column = this;
                     var select = $('<select class="form-control"><option value=""></option></select>')
                         .appendTo($(column.footer()).empty())
                         .on('change', function() {
                             var val = $.fn.dataTable.util.escapeRegex(
                                 $(this).val()
                             );
    
                             column
                                 .search(val ? '^' + val + '$' : '', true, false)
                                 .draw();
                        });
    
                     column.data().unique().sort().each(function(d, j) {
                         select.append('<option value="' + d + '">' + d + '</option>')
                    });
                 });
            }
         });
    
        $('#datatable-tramo').DataTable({
            "pageLength": 5,
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    var select = $('<select class="form-control"><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
    
                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
    
                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }
        });
        
        $('#basic-datatables-caso').DataTable({
            "pageLength": 5,
            "ordering": false,
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    var select = $('<select class="form-control"><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
    
                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
    
                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            
            }
            
        });
        
        $(document).on("click", "#seleccionarEntorno", function() {
    
            var entornoSeleccionado = $(this).val();
            var nombre = $(this).attr("data-name");
    
            
            $('#modalEntorno').modal('hide');
            $('#entorno').attr("value", nombre);
            $('#entorno_id').val(entornoSeleccionado);
    
        });
    
        
        
        $(document).on("click","#selectDeterioro", function(){
    
            var inputDestino = "inputDeterioro"+$("#inputDestino").val();
            var hiddenDestino = "deterioro_id"+$("#inputDestino").val();
            var codigoDeterioro = $(this).attr("data-id");
            var nombreDeterioro = $(this).attr("data-name");
            var tipoDeterioro = $(this).attr("data-tipo");
    
    
            
    
            $('#modalDeterioro').modal('hide');
            $('#modalDeterioroEditar').modal('hide');
            $('#'+inputDestino).attr("value",nombreDeterioro);
            $('#'+inputDestino).attr("data-tipo",tipoDeterioro);
            $('#'+hiddenDestino).attr("value",codigoDeterioro);
    
        });
        
        $(document).on("click","#selectTramo", function(){
    
            var tramoSeleccionado = $(this).val();
            var codigoTramo = $(this).attr("data-codigo");
            var anchoInicio = $(this).attr("data-anchoInicio");
            var anchoFin = $(this).attr("data-anchoFin");
    
            //alert("id: " + tramoSeleccionado + " codigo: " + codigoTramo);
            //alert("ancho1: " + anchoInicio + "ancho2: " + anchoFin);
            $('#modalTramo').modal('hide');
            $('#tramo').attr("value",codigoTramo);
            $('#tramo_id').val(tramoSeleccionado);
            $('#ancho_inicio').val(anchoInicio);
            $('#ancho_fin').val(anchoFin);
    
        });
        
        $("#search_det").click(function(){
            let campo = $("#d1").html();
            let campo2 = $("#d2").html();
            let campo3 = $("#d3").html();
            
            
            $("#copy").append("<div class='form-row'>"
                                +"<div class='col-md-5 form-group'>"+campo+"</div>"
                                +"<div class='form-group col-md-2' style='padding: 15px'>"+campo2+"</div>"
                                +"<div class='form-group' style='padding: 12px'>"+campo3+"</div>"
                                +"<div class='col-md-1 col-ms-1 col-xs-12'>"
                                    +"<button class='btn btn-icon btn-round btn-danger quitarDeterioro' type='button' style='margin-top: 40px;'><i class='fas fa-minus-circle'></i></button>"
                                +"</div>"
                             +"</div>")
            
            
        });
    
        $("#search_det").click(function(){
            let count = 1;
            let count2 = 3;
    
            $(".inputcito").each(function(){
                $(this).attr("id","inputDeterioro"+count);
                count++;
            });
    
            count = 1;
            
            $(".inputcito_hidden").each(function(){
                $(this).attr("id","deterioro_id"+count)
                $(this).attr("data-count", count)
                count++;
            })
    
            count = 1;
    
            $(".botonInput").each(function(){
                $(this).attr("id",count)
                count++;
            })
    
            $(".quitarDeterioro").each(function(){
                $(this).attr("value",count2)
                count2++;
            })
    
        });
    
        $(document).on("click","#anadirDeterioro",function(){
            let campo = $("#d1").html();
            let campo2 = $("#d2").html();
            let campo3 = $("#d3").html();
    
            $("#copy").append("<div class='form-row'>"
                                +"<div class='col-md-5 form-group'>"+campo+"</div>"
                                +"<div class='form-group col-md-2' style='padding: 15px'>"+campo2+"</div>"
                                +"<div class='form-group' style='padding: 12px'>"+campo3+"</div>"
                                +"<div class='col-md-1 col-ms-1 col-xs-12'>"
                                    +"<button class='btn btn-icon btn-round btn-danger quitarDeterioro' type='button' id='quitarDeterioro' style='margin-top: 40px;'><i class='fas fa-minus-circle'></i></button>"
                                +"</div>"
                             +"</div>")
        })
    
        $(document).on("click","#anadirDeterioro",function(){
            let count = 1;
            $(".inputcito").each(function(){
                $(this).attr("id","inputDeterioro"+count);
                count++;
            });
    
            count = 1;
            
            $(".inputcito_hidden").each(function(){
                $(this).attr("id","deterioro_id"+count)
                $(this).attr("data-count", count)
                count++;
            })
    
            count = 1;
    
            $(".botonInput").each(function(){
                $(this).attr("id",count)
                count++;
            })
    
        });
        
        $(document).on("click",".quitarDeterioro",function(){
            $(this).parent().parent().remove();
            
        })
        
        $(document).on("submit", "#formularioParte2", function(){
    
            let mapa = document.getElementsByClassName("validacionMap");
            var elFormularioEsValido = true;
    
            for (let x = 0; x < mapa.length; x++) {
                if (mapa[x].value.length == 0) {
                    swal("Error!", "Por favor valide que haya andjuntado una imagen y seleccionado un punto en el mapa", {
                        icon : "error",
                        buttons: {        			
                            confirm: {
                                className : 'btn btn-danger'
                            }
                        },
                    });
                    elFormularioEsValido = false;
                    break;
                }
                
            }
    
            return elFormularioEsValido;
    
            
        });
    
    
    
        // Validaciones de formulario de registro de casos.
        $(document).on("click", "#envioData", function() {
    
    
            let elFormularioEsValido = true;
            let formulario = document.getElementsByClassName("validacion");
            
            let deterioros = document.getElementsByClassName("inputcito");
            let count = 1;
            let count2 = 0;
            let count3 = 1;
            let countTipoDef = 0
            let countTipoFis = 0
            let array = [];
        
            // Ciclo para validar que ningun campo este vacio
            for (let i = 0; i < formulario.length; i++) {
                
                if (formulario[i].value.length == 0) {
                    swal("Error!", "Ningun campo debe estar vacio:", {
                        icon : "error",
                        buttons: {        			
                            confirm: {
                                className : 'btn btn-danger'
                            }
                        },
                    });
                    elFormularioEsValido = false;
                    break;
                }
    
                if (formulario[i].name == "tipo_pavimento_id" && formulario[i].value == 2 ) {
                    swal("Advertencia", "De momento no esta disponible el pavimento Rigido", {
                        icon : "warning",
                        buttons: {        			
                            confirm: {
                                className : 'btn btn-warning'
                            }
                        },
                    });
                    elFormularioEsValido = false;
                    break;
                }
                
            }
    
    
            // Ciclo para a&ntilde;adir en un arreglo los deterioros seleccionados
            for (let i = 0; i < deterioros.length; i++) {
                array.push(deterioros[i].value);
                count2++;
                count3++;
            }
    
    
            // Ciclo que valida que ningun deterioro se repita
           for (let j = 0; j < array.length; j++) {
                for (let x = count; x < array.length; x++) {
                    if (array[j] == array[x]) {
                        swal("Advertencia", "No se puede repetir deterioros", {
                            icon : "warning",
                            buttons: {        			
                                confirm: {
                                    className : 'btn btn-warning'
                                }
                            },
                        });
                        elFormularioEsValido = false;
                        break;
                    }
                }
                count++;
           }
    
           if (count2 <= 1) {
            swal("Advertencia", "Deben de haber minimo 2 deterioros seleccionados", {
                icon : "warning",
                buttons: {        			
                    confirm: {
                        className : 'btn btn-warning'
                    }
                },
            });
            elFormularioEsValido = false;
           }
    
           if (count3 > 10) {
            swal("Advertencia", "Limite de deterioros seleccionados", {
                icon : "warning",
                buttons: {        			
                    confirm: {
                        className : 'btn btn-warning'
                    }
                },
            });
            elFormularioEsValido = false;
           }
    
           for (let f = 0; f < deterioros.length; f++) {
               if (deterioros[f].getAttribute('data-tipo') == "Otros deterioros" || deterioros[f].getAttribute('data-tipo') == "Deformaciones" || deterioros[f].getAttribute('data-tipo') == "Perdida de capas estructurales" ) {
                    countTipoDef++;
               } else if (deterioros[f].getAttribute('data-tipo') == "Fisuras" || deterioros[f].getAttribute('data-tipo') == "Desprendimientos" || deterioros[f].getAttribute('data-tipo') == "Da&ntilde;os superficiales" ) {
                    countTipoFis++;
               }
           }
    
           //console.log(countTipoDef, countTipoFis);
    
           /*if (countTipoDef > 0 && countTipoFis > 0) {} else {
            swal("Error!", "Escoger deterioro de fisuracion y deformacion", {
                icon : "error",
                buttons: {        			
                    confirm: {
                        className : 'btn btn-danger'
                    }
                },
            });
            elFormularioEsValido = false;
           }*/
           
            if(elFormularioEsValido){
    
                let dataArrayDet   =  [];
                let dataArrayGra   =  [];
                let dataArrayArea  =  [];
                let dataArrayTramo =  [];
                let dataDeterioros = document.getElementsByClassName("deteriorosValue");
                let dataGravedades = document.getElementsByClassName("gravedadValue");
                let dataAreas      = document.getElementsByClassName("areaValue");
                let dataTramo      = document.getElementsByClassName("tramoValue");
                let dataEntorno    = document.getElementById("entorno_id").value;
                let dataPavimento  = document.getElementById("tipo_pavimento_id").value;
                let dataCausa      = document.getElementById("cas_causa").value;
    
                for (let i = 0; i < dataDeterioros.length; i++) {
                    dataArrayDet.push(parseInt(dataDeterioros[i].value));
                    dataArrayGra.push(parseInt(dataGravedades[i].value));
                    dataArrayArea.push(parseInt(dataAreas[i].value));
                }
    
                for (let j = 0; j < dataTramo.length; j++) {dataArrayTramo.push(dataTramo[j].value)}
                    
                var formData = new FormData($('#form_case')[0]);
    
                //console.log(formData);
    
                    $.ajax({
    
                        url: 'ajax.php?modulo=Caso&controlador=Caso&funcion=getCreateMap',
                        type: "POST",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(data){ 
                            $("#formularioParte1").html(data);
                            
                        }
                    });        
            }
            
        });
    
        $(document).on("submit", "#form_case_edit", function() {
    
    
            let elFormularioEsValido = true;
    
            let formulario = document.getElementsByClassName("validacion2");
            let deterioros = document.getElementsByClassName("inputcito");
    
            // Ciclo para validar que ningun campo este vacio
            for (let i = 0; i < formulario.length; i++) {
                
                if (formulario[i].value == "") {
                    swal("Error!", "Ningun campo debe estar vacio: " + formulario[i].type, {
                        icon : "error",
                        buttons: {        			
                            confirm: {
                                className : 'btn btn-danger'
                            }
                        },
                    });
                    elFormularioEsValido = false;
                    break;
                }
    
                if (formulario[i].name == "tipo_pavimento_id" && formulario[i].value == 2 ) {
                    swal("Advertencia", "De momento no esta disponible el pavimento Rigido", {
                        icon : "warning",
                        buttons: {        			
                            confirm: {
                                className : 'btn btn-warning'
                            }
                        },
                    });
                    elFormularioEsValido = false;
                    break;
                }   
            }
    
    
            array = [];
            let count = 1;
            let count2 = 0;
            let count3 = 1;
    
            // Ciclo para a&ntilde;adir en un arreglo los deterioros seleccionados
            for (let i = 0; i < deterioros.length; i++) {
                array.push(deterioros[i].value);
                count2++;
                count3++;
            }
    
    
    
            // Ciclo que valida que ningun deterioro se repita
           for (let j = 0; j < array.length; j++) {
                for (let x = count; x < array.length; x++) {
                    if (array[j] == array[x]) {
                        swal("Advertencia", "No se puede repetir deterioros", {
                            icon : "warning",
                            buttons: {        			
                                confirm: {
                                    className : 'btn btn-warning'
                                }
                            },
                        });
                        elFormularioEsValido = false;
                        break;
                    }
                }
                count++;
           }
    
           if (count2 <= 1) {
            swal("Advertencia", "Deben de haber minimo 2 deterioros seleccionados", {
                icon : "warning",
                buttons: {        			
                    confirm: {
                        className : 'btn btn-warning'
                    }
                },
            });
            elFormularioEsValido = false;
           }
    
           if (count3 > 10) {
            swal("Advertencia", "Limite de deterioros seleccionados", {
                icon : "warning",
                buttons: {        			
                    confirm: {
                        className : 'btn btn-warning'
                    }
                },
            });
            elFormularioEsValido = false;
           }
    
    
            return elFormularioEsValido;
        });
    
        // Cambiar el estado del caso 
        $(document).on("click",".cambiarEstadoCaso",function(){
    
            var url = $(this).attr("data-url");
            var id = $(this).attr("data-id");
            var estado = $(".botonCambiarEstado").attr("data-estado");
    
            if (estado == 3) {
                var observacion = document.getElementById("cas_inhab_just").value;
            } else if (estado == 2){
                var observacion = document.getElementById("cas_hab_just").value;
            }
    
            var contenidoBoton = "";
    
            if( observacion.length == 0 ){
                swal("Modificacion", "El campo de la justificacion debe ser diligenciado", {
                    icon : "warning",
                    buttons: {
                        confirm: {
                            className : 'btn btn-warning'
                        }
                    },
                });
            } else {
                if(estado == 3){
                    contenidoBoton = "<button class='btn btn-success botonCambiarEstado' data-toggle='modal' id='botonHabilitarCaso' data-estado='2' data-target='#modalHabilitarCaso'>Habilitar</button>";  
                    $('#modalInhabilitarCaso').modal('hide');
                }else if(estado == 2){
                    contenidoBoton = "<button class='btn btn-danger botonCambiarEstado' data-toggle='modal' id='botonInhabilitarCaso' data-estado='3' data-target='#modalInhabilitarCaso'>Inhabilitar</button>";
                    $('#modalHabilitarCaso').modal('hide');
                }
        
                $('#inhabilitarHabilitar').html(contenidoBoton);
        
                $.ajax({
        
                    url: url,
                    type: "POST",
                    data: "cas_id="+id+"&estado_id="+estado+"&observacion="+observacion,
                    success: function(estado){
                        swal("Modificacion", "El estado del caso se ha modificado", {
                            icon : "success",
                            buttons: {
                                confirm: {
                                    className : 'btn btn-success'
                                }
                            },
                        });
                        $('#form-estado').html(estado);
                    }
                })
            }
             
    
        });
    
        // Editar el caso
        $("#editarCaso").click(function(){
            let url = $(this).attr("data-url");
            let caso_id = $(this).attr("data-id");
            
            $.ajax({
                type: "POST",
                url: url,
                data: "caso_id="+caso_id,
                success: function (response) {
                    $('#contenidoFormulario').html(response);
                }
            });
            
        });
    
        $('#datatable-deterioro-editar').DataTable({
            "pageLength": 5,
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    var select = $('<select class="form-control"><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
    
                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                       });
    
                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                   });
                });
           }
        });
    
        $(document).on("click","#boton_imagen_inicio",function(){
            $("#contenido").html("<input type='file' class='form-control validacion2' name='foto_inicio'>")
        });
    
        $(document).on("click","#boton_imagen_fin",function(){
            $("#contenido2").html("<input type='file' class='form-control validacion2' name='foto_fin'>")
        });
    
        $(document).on("submit","#form_finish",function(){
            let campos = document.getElementsByClassName("valid");
            let isvalid = true;
    
            for (let i = 0; i < campos.length; i++) {
                if (campos[i].value.length == 0) {
                    swal("Error!", "Ningun campo debe estar vacio", {
                        icon : "error",
                        buttons: {        			
                            confirm: {
                                className : 'btn btn-danger'
                            }
                        },
                    });
                    isvalid = false;
                }
            }
    
            return isvalid;
        });
    
        $(document).on("click","#cambiarPrioridad",function(){
            urlControlador = $(this).attr("data-url");
            
            contenido = "<div class='input-group ml-3'>"+
                            "<select class='form-control' class='col-md-1' id='selectPrioridad' data-url='"+urlControlador+"'>"+
                                "<option value=''>seleccione</option>"+
                                "<option value='1'>1</option>"+
                                "<option value='2'>2</option>"+
                                "<option value='3'>3</option>"+
                                "<option value='4'>4</option>"+
                                "<option value='5'>5</option>"+
                                "<option value='6'>6</option>"+
                                "<option value='7'>7</option>"+
                            "</select><span data-toggle='tooltip' data-placement='right' title='Prioridades: 1 y 2 - baja, 3 y 4 - media, 5,6 y 7 - alta' class='mt-2 ml-2'><i class='fas fa-info-circle text-info'></i></span>"+
                        "</div>";
            //alert(contenido);
            $('#textoPrioridad').addClass("mt-2");
            $('#divEntorno').removeClass("mt-4");
            $('#divSelectPrioridad').html(contenido);
    
        });
    
        $(document).on("change","#selectPrioridad",function(){
    
            var prioridadSeleccionada = $(this).val();
            var url = $(this).attr("data-url");
            var cas_id = $('#cas_id').val();
    
            if(prioridadSeleccionada != ""){
                $.ajax({
    
                    url: url,
                    type: "POST",
                    data: "cas_prioridad="+prioridadSeleccionada+"&cas_id="+cas_id,
                    success: function(response){
                        $('#textoPrioridad').html(response);
                    }
                });
    
            }
        });
    
        // $(document).on("submit","form_case",function(){
    
        // });
    
        ///////////////////////////Fin Jquery Casos//////////////////////////////
    });
    
    
    //////////////////////Funciones de modulo de usuarios - Kevin///////////////////
    
    
    // Funcion para mostrar contrase&ntilde;a
    const mostrarContrasenia = () => {
        let value = document.getElementById('password');
        if (value.type == 'password') {
            value.type = 'text';
        } else {
            value.type = 'password';
        }
    }
    
    // Funcion para mostrar contrase&ntilde;a
    const mostrarContrasenia2 = () => {
        let value = document.getElementById('confirmation');
        if (value.type == 'password') {
            value.type = 'text';
        } else {
            value.type = 'password';
        }
    }
    
    // Funcion que valida que unicamente hayan letras en un determinado input
    const valVarchar = (valor, small, input) => {
        value = valor.value;
        value2 = small;
        value3 = document.getElementById(input);
    
        if (/^[a-zA-z]+$/.test(value) || value=='') {
            document.getElementById(value2).innerHTML = '';
            value3.classList.remove("has-error");
            value3.classList.add("has-success");
        } else {
            document.getElementById(value2).innerHTML = '<i class="fas fa-exclamation-circle"></i> Ingrese solo letras';
            value3.classList.remove("has-success");
            value3.classList.add("has-error");
        }
    
    }
    
    // Funcion que valida que unicamente hayan numeros en un determinado input
    const valInt = (valor, small, input) => {
        value = valor.value;
        value2 = small;
        value3 = document.getElementById(input);
    
        if (/^[0-9]+$/.test(value)) {
            document.getElementById(value2).innerHTML = '';
            value3.classList.remove("has-error");
            value3.classList.add("has-success");
        } else {
            document.getElementById(value2).innerHTML = '<i class="fas fa-exclamation-circle"></i> Ingrese solo numeros';
            value3.classList.remove("has-success");
            value3.classList.add("has-error");
        }
    }
    
    // Funcion que validad que no hayan campos vacios en el formulario de registro de usuario
    const mainValidationRegister = () => {
    
        let firts_name = document.getElementById('pri_nombre').value;
        let second_name = document.getElementById('seg_nombre').value;
        let firts_last = document.getElementById('pri_apellido').value;
        let second_last = document.getElementById('seg_apellido').value;
        let mail = document.getElementById('correo').value;
        let phone = document.getElementById('telefono').value;
        let numb_document = document.getElementById('num_documento').value;
        let type_document = document.getElementById('tipo_documento').value;
        let type_role = document.getElementById('tipo_rol').value;
        let password1 = document.getElementById('password').value;
        let password2 = document.getElementById('confirmation').value;
        
    
        count = 0;
    
        if (firts_name == '') {
            document.getElementById('ad1').innerHTML = '<i class="fas fa-exclamation-circle"></i> Ingrese el primer nombre';
            count++;
        }
    
        // if (second_name == '') {
        //     document.getElementById('ad2').innerHTML = '<i class="fas fa-exclamation-circle"></i> Ingrese el segundo nombre';
        //     count++;
        // }
    
        if (firts_last == '') {
            document.getElementById('ad3').innerHTML = '<i class="fas fa-exclamation-circle"></i> Ingrese el primer apellido';
            count++;
        }
    
       /*  if (second_last == '') {
            document.getElementById('ad4').innerHTML = '<i class="fas fa-exclamation-circle"></i> Ingrese el segundo apellido';
            count++;
        }*/
    
        if (mail == '') {
            document.getElementById('ad5').innerHTML = '<i class="fas fa-exclamation-circle"></i> Ingrese el correo electronico';
            count++;
        }
    
        if (phone == '') {
            document.getElementById('ad7').innerHTML = '<i class="fas fa-exclamation-circle"></i> Ingrese el numero de telefono';
            count++;
        }
    
        if (numb_document == '') {
            document.getElementById('ad8').innerHTML = '<i class="fas fa-exclamation-circle"></i> Ingrese el numero de identificacion';
            count++;
        }
    
        if (type_document == '') {
            document.getElementById('ad9').innerHTML = '<i class="fas fa-exclamation-circle"></i> Seleccione algun documento';
            count++;
        }
    
        if (type_role == '') {
            document.getElementById('ad10').innerHTML = '<i class="fas fa-exclamation-circle"></i> Seleccione algun rol';
            count++;
        }
    
        if (password1 == '') {
            document.getElementById('ad12').innerHTML = '<i class="fas fa-exclamation-circle"></i> Ingrese una contrase&ntilde;a';
            count++;
        }
    
        if (password2 == '') {
            document.getElementById('ad13').innerHTML = '<i class="fas fa-exclamation-circle"></i> Ingrese una contrase&ntilde;a';
            count++;
        }
    
        if (password1 != password2) {
            document.getElementById('ad12').innerHTML = '<i class="fas fa-exclamation-circle"></i> Las contrase&ntilde;as deben de coincidir';
            document.getElementById('ad13').innerHTML = '<i class="fas fa-exclamation-circle"></i> Las contrase&ntilde;as deben de coincidir';
            count++;
        }
    
        /*if (!/^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/.test(mail)) {
            document.getElementById('ad5').innerHTML = '<i class="fas fa-exclamation-circle"></i> Error el correo electronico es invalido';
            count++;
        }*/
    
        if (count > 0) {
            return false;
        } else {
            return true;
        }
    
    }
    
    // Funcion que validad que no hayan campos vacios en el formulario de modificacion de usuario
    const mainValidationEdit = () => {
    
        value1 = document.getElementById('pri_nombre').value;
        value2 = document.getElementById('seg_nombre').value;
        value3 = document.getElementById('pri_apellido').value;
        value4 = document.getElementById('seg_apellido').value;
        value5 = document.getElementById('correo').value;
        value6 = document.getElementById('telefono').value;
        value7 = document.getElementById('num_documento').value;
    
        count = 0;
    
        if (value1 == '') {
            document.getElementById('ad1').innerHTML = '<i class="fas fa-exclamation-circle"></i> Ingrese el primer nombre';
            count++;
        }
    
        if (value2 == '') {
            document.getElementById('ad2').innerHTML = '<i class="fas fa-exclamation-circle"></i> Ingrese el segundo nombre';
            count++;
        }
    
        if (value3 == '') {
            document.getElementById('ad3').innerHTML = '<i class="fas fa-exclamation-circle"></i> Ingrese el primer apellido';
            count++;
        }
    
        if (value4 == '') {
            document.getElementById('ad4').innerHTML = '<i class="fas fa-exclamation-circle"></i> Ingrese el segundo apellido';
            count++;
        }
    
        if (value5 == '') {
            document.getElementById('ad5').innerHTML = '<i class="fas fa-exclamation-circle"></i> Ingrese el correo electronico';
            count++;
        }
    
        if (value6 == '') {
            document.getElementById('ad6').innerHTML = '<i class="fas fa-exclamation-circle"></i> Ingrese el numero de telefono';
            count++;
        }
    
        if (value7 == '') {
            document.getElementById('ad7').innerHTML = '<i class="fas fa-exclamation-circle"></i> Ingrese el numero de documento';
            count++;
        }
    
        if (count > 0) {
            return false
        } else {
            return true;
        }
    
        // return false;
    }
    
    function enviarID(id){
        
        let value = id;
        
    
        let inputDestino = document.getElementById("inputDestino");
        
        //alert("inputDestino: " + value);
        inputDestino.value = value;
    
    }
    
    
            