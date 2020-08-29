$(document).ready(function(){
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