$(document).ready(function(){

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
    $(document).on("keyup",".validacion",function(){
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

    $(document).on("keyup","#search",function(){
        let url = $(this).attr("data-url");
        let value = $(this).val();
        

        $.ajax({
            url: url,
            type: 'POST',
            data: 'value=' + value,
            success: function( data ){
                $('tbody').html( data );
            }
        });
    });



});

// Funcion para enviar paramentos mediante la modal a la funcion userDelete
const userDelete = ( identificacion ) => {
    console.log(identificacion);
    input = document.getElementById('inputcito');
    input.value = identificacion;
}

// Funcion para enviar paramentos mediante la modal a la funcion userActivation
const userActivation = ( identificacion) =>{
    console.log(identificacion);
    input = document.getElementById('inputcito2');
    input.value = identificacion;
}

const mostrarContraseña = () => {
    // alert('hola');
    let value = document.getElementById('password');
    if (value.type == 'password') {
        value.type = 'text';
    } else {
        value.type = 'password';
    }
}

const mostrarContraseña2 = () => {
    // alert('hola');
    let value = document.getElementById('confirmation');
    if (value.type == 'password') {
        value.type = 'text';
    } else {
        value.type = 'password';
    }
}