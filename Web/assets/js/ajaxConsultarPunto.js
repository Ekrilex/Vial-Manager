var peticion = null;
var coordenadaX = null;
var coordenadaY = null;
var url = null;


function inicializarPeticion(){

    if(window.XMLHttpRequest){
        return new XMLHttpRequest();

    }else if(window.ActiveXObject){
        return new ActiveXObject('Microsoft.XMLHTTP');
    }

}

function dataCoordenadas(){

    return "cx="+encodeURIComponent(coordenadaX)+
    "&cy="+encodeURIComponent(coordenadaY)+
    "&nocache="+Math.random();

}

function validaConsultar(cx, cy, urlControlador){

    peticion = inicializarPeticion();
    coordenadaX = cx;
    coordenadaY = cy;
    url = urlControlador;

    //alert(url+" : "+cx+" : "+cy);

    if(peticion){

        peticion.onreadystatechange = procesoConsulta;

        peticion.open("POST",url);

        peticion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

        var data = dataCoordenadas();

        //alert(data);

        peticion.send(data);
    }


}

function procesoConsulta(){

    if(peticion.readyState == 4){
        if(peticion.status == 200){
            //document.getElementById("salidaPrueba").innerHTML = peticion.responseText;
            $('#modalConsultarDanos').modal('show');
            document.getElementById("contenidoModalConsultar").innerHTML = peticion.responseText;
            //alert("se llego a la respuesta");
        }
    }

}