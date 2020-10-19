
var informacionCasos = [];
$(document).ready(function(){

        let listaTabla = $(".inputsDefault");
        

        //console.log(listaTabla);

        for(var i = 0; i < listaTabla.length; i++){

             informacionCasos.push(listaTabla[i].value);
             acumulador =  $('#ordenesTabla').html();
             $('#ordenesTabla').html(acumulador + "<input type='hidden' name='list[]' value='"+informacionCasos[i]+"'>");

        }

        //console.log(informacionCasos);



        $(document).on("click",".selecOrd",function(){

            $('#ordenesTabla').html("");
            $('#casosAntiguos').html("");
          //alert("se dio click en el checkbox");
        //console.log(informacionCasos);

                if($(this).prop("checked")){

                    //alert("se agrego el caso");
                    informacionCasos.push($(this).val());

                }else{
                    indiceCasoEnArray = informacionCasos.indexOf($(this).val());

                    //alert('removiendo el caso que esta en la posicion: '+indiceCasoEnArray);

                    informacionCasos.splice(indiceCasoEnArray, 1);
                }
            

            for(var i = 0; i < informacionCasos.length; i++){
                acumulador =  $('#ordenesTabla').html();
                $('#ordenesTabla').html(acumulador+"<input type='hidden' name='list[]' value='"+informacionCasos[i]+"'>");
            }

            console.log("array global: ");
            console.log(informacionCasos);
        

    });
    

});
   