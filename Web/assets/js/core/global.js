$(document).ready(function() {


    /////////////Camila ////////////////////////

    $(document).on("click", "#view", function() {
        var boton = $(this).val();
        if (boton == "v1") {
            $(this).attr('Class', 'far fa-eye-slash text-primary bg-dark btn btn-dark', 'Id', 'view');
            $(this).attr('value', 'v2');
            $(".gyg").attr('type', 'text');

        } else if (boton == "v2") {
            $(this).attr('Class', 'far fa-eye text-primary bg-dark btn btn-dark', 'Id', 'view');
            $(this).attr('value', 'v1');
            $(".gyg").attr('type', 'password');
        }
    });

    $(document).on("click", "#contra", function() {
        var boton = $(this).val();
        if (boton == "v1") {
            $(this).attr('Class', 'far fa-eye-slash text-primary bg-dark btn btn-dark', 'Id', 'contra');
            $(this).attr('value', 'v2');
            $(".cl1").attr('type', 'text');
            $("#cam").attr('Class', 'far fa-eye-slash text-primary bg-dark btn btn-dark');

        } else if (boton == "v2") {
            $(this).attr('Class', 'far fa-eye text-primary bg-dark btn btn-dark', 'Id', 'contra');
            $(this).attr('value', 'v1');
            $(".cl1").attr('type', 'password');
            $("#cam").attr('Class', 'far fa-eye text-primary bg-dark btn btn-dark');
        }
    });

    $(document).on("keyup", "#correo2", function() {

        var correo = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/;

        if (correo.test($(this).val())) {
            $("#error1").html("");
        } else {
            $("#error1").html("<h5 class='text-danger'>El correo es invalido</h5>");
        }
    });

    $(document).on("keyup", ".campos", function() {

        var correo = $(".correo").val();
        var clave1 = $(".clave1").val();
        var clave2 = $(".clave2").val();

        if (correo.length == 0) {
            $(".actualizar").attr('disabled', true);
            $("#error1").html("<h5 class='text-danger'>Debe llenar el correo electronico</h5>");
        } else {
            $(".actualizar").attr('disabled', false);
            $("#error1").html("");
        }

        if (clave1.length == 0) {
            $(".actualizar").attr('disabled', true);
            $("#error2").html("<h5 class='text-danger'>Debe llenar la contraseña</h5>");
        } else {
            $(".actualizar").attr('disabled', false);
            $("#error2").html("");
        }

        if (clave2.length == 0) {
            $(".actualizar").attr('disabled', true);
            $("#error3").html("<h5 class='text-danger'>Debe confirmar la contraseña</h5>");
        } else {
            $(".actualizar").attr('disabled', false);
            $("#error3").html("");
        }

        if (clave1.length > 0 && clave2.length > 0) {
            if (clave1 != clave2) {
                $(".actualizar").attr('disabled', true);
                $("#error2").html("<h5 class='text-danger'>Las contraseñas no coinciden</h5>");
                $("#error3").html("<h5 class='text-danger'>Las contraseñas no coinciden</h5>");
            } else {
                $(".actualizar").attr('disabled', false);
                $("#error3").html("");
                $("#error3").html("");
            }
        }
    });
    //////////////////////////////////////////////////////////

    //////////////////Daniel //////////////////


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

    $(document).on("click", "#eliminar", function() {
        var id = $(this).val();
        var url = $(this).attr("data-url");
        $.ajax({
            url: url,
            type: "POST",
            data: "id=" + id,
            success: function(datos) {
                $("#cotenido_eliminar").html(datos);
                $('#modal_eliminar').modal();
            }
        });
    });

    $(document).on("keyup", ".nombred", function() {

        var nombre = $(".nombred").val();

        if (nombre.length == 0) {
            $(".actualizar").attr('disabled', true);
            $("#errord").html("<h5 class='text-danger'>Debe llenar el nombre del detrioro</h5>");
        } else {
            $(".actualizar").attr('disabled', false);
            $("#errord").html("");
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
    $(document).on("change","#correo", function(){
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
    $('#users-table').DataTable( {
        "pageLength": 5,
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select class="form-control"><option value=""></option></select>')
                .appendTo( $(column.footer()).empty() )
                .on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                        );

                    column
                    .search( val ? '^'+val+'$' : '', true, false )
                    .draw();
                } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    });

    // Funcion para eliminar a un usuario
    $('tr td #delete').click(function(ev){

        ev.preventDefault();
        let name = $(this).parents('tr').find('td:first').text();
        let id = $(this).attr('data-id');
        let url = $(this).attr('data-url');
        let self = this;

        swal({
            title: '¿Realmente quieres eliminar al usuario '+ name +' ?',
            text: 'El usuario sera inhabilitado del sistema',
            icon: 'warning',
            buttons:{
                cancel:{
                    className: 'btn btn-danger',
                    visible: true
                },
                confirm:{
                    className: 'btn btn-success'
                }
            }
        }).then((result) => {
            if(result){
                console.log('hola');
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: 'value='+id,
                    success: function(){
                        swal({
                            title: 'Eliminado!',
                            text: 'El usuario ha sido eliminado correctamente',
                            type: 'success',
                            buttons: {
                                confirm: {
                                    className: 'btn btn-success'
                                }
                            }
                        }).then(function(){
                            location.reload();
                        })
                    }
                });
            }
        });

    });

    // Funcion para activar a un usuario
    $('tr td #activate').click(function(ev){

        ev.preventDefault();
        let name = $(this).parents('tr').find('td:first').text();
        let id = $(this).attr('data-id');
        let url = $(this).attr('data-url');
        let self = this;

        swal({
            title: '¿Realmente quieres activar al usuario '+ name +' ?',
            text: 'El usuario sera activado nuevamente en el sistema',
            icon: 'warning',
            buttons:{
                cancel:{
                    className: 'btn btn-danger',
                    visible: true
                },
                confirm:{
                    className: 'btn btn-success'
                }
            }
        }).then((result) => {
            if(result){
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: 'value='+id,
                    success: function(){
                        swal({
                            title: 'Reactivado!',
                            text: 'El usuario ha sido activado correctamente',
                            type: 'success',
                            buttons: {
                                confirm: {
                                    className: 'btn btn-success'
                                }
                            }
                        }).then(function(){
                            location.reload();
                        })
                    }
                });
            }
        });

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
            $(this).val(barrioNom.substr(0, barrioNom.length - 1));
        }
    });
    // Se creo el filtro para tbl_barrio, No se puden recibir carcateres especiales tambien
    $(document).on("keyup", "#filtroB", function() {
        var url = $(this).attr("data-url");
        var valor = $(this).val();
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
            url: url,
            type: "POST",
            data: "barrio=" + valor,
            success: function(datos) {
                $("tbody").html(datos);
            }
        });
    });

    //Se creo esta funcion para que NO ingrese el usuario caracteres especiales en la vista "Editar"
    $(document).on("keyup", ".barrioEditar", function() {
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

    //Se creo esta funcion para el modal de "Editar"
    $(document).on("click", "#actuali", function() {

        var barrioActuali = $(this).val();
        var url = $(this).attr("data-url");

        // alert(barrioActuali);
        $.ajax({
            url: url,
            type: "POST",
            data: "barrioActuali=" + barrioActuali,
            success: function(datos) {
                $("#editarB").html(datos);
                $("#actualizar").modal();
            }
        });

    });

    //Se creo esta funcion para el modal de "Eliminar"
    $(document).on("click", "#elimi", function() {

        var barrioElimi = $(this).val();
        var url = $(this).attr("data-url");

        // alert(barrioElimi);
        $.ajax({
            url: url,
            type: "POST",
            data: "barrioElimi=" + barrioElimi,
            success: function(datos) {
                $("#eliminarB").html(datos);
                $("#eliminar").modal();
            }
        });

    });

    //filtro con datatables 
    $('#multi-filter-select').DataTable( {
        "pageLength": 5,
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select class="form-control"><option value=""></option></select>')
                .appendTo( $(column.footer()).empty() )
                .on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                        );

                    column
                    .search( val ? '^'+val+'$' : '', true, false )
                    .draw();
                } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
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
                $("tbody").html(busqueda);
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
            alert("Debe seleccionar una Jerarquia Vial Previamente para definir los ejes viales");
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

    //jquery para el formulario de editar



    /////////////

});

//////////////////////Funciones de modulo de usuarios - Kevin///////////////////


// Funcion para mostrar contraseña
const mostrarContraseña = () => {
    let value = document.getElementById('password');
    if (value.type == 'password') {
        value.type = 'text';
    } else {
        value.type = 'password';
    }
}

// Funcion para mostrar contraseña
const mostrarContraseña2 = () => {
    let value = document.getElementById('confirmation');
    if (value.type == 'password') {
        value.type = 'text';
    } else {
        value.type = 'password';
    }
}

// Funcion que valida que unicamente hayan letras en un determinado input
const valVarchar = (valor, small, input ) => {
    value = valor.value;
    value2 = small;
    value3 = document.getElementById(input);

    if (/^[a-zA-z]+$/.test(value)) {
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
const valInt = ( valor, small, input ) => {
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

    if (second_name == '') {
        document.getElementById('ad2').innerHTML = '<i class="fas fa-exclamation-circle"></i> Ingrese el segundo nombre';
        count++;
    }

    if (firts_last == '') {
        document.getElementById('ad3').innerHTML = '<i class="fas fa-exclamation-circle"></i> Ingrese el primer apellido';
        count++;
    }

    if (second_last == '') {
        document.getElementById('ad4').innerHTML = '<i class="fas fa-exclamation-circle"></i> Ingrese el segundo apellido';
        count++;
    }

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
        document.getElementById('ad12').innerHTML = '<i class="fas fa-exclamation-circle"></i> Ingrese una contraseña';
        count++;
    }

    if (password2 == '') {
        document.getElementById('ad13').innerHTML = '<i class="fas fa-exclamation-circle"></i> Ingrese una contraseña';
        count++;
    }

    if (password1 != password2) {
        document.getElementById('ad12').innerHTML = '<i class="fas fa-exclamation-circle"></i> Las contraseñas deben de coincidir';
        document.getElementById('ad13').innerHTML = '<i class="fas fa-exclamation-circle"></i> Las contraseñas deben de coincidir';
        count++;
    }

    if (!/^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/.test(mail)){
        document.getElementById('ad5').innerHTML = '<i class="fas fa-exclamation-circle"></i> Error el corre electronico es invalido';
        count++;
    }

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

    alert(count);

    if (count > 0) {
        return false
    } else {
        return true;
    }

    // return false;

}
