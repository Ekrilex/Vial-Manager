<?php
//agregar el helpers para el MVC

@session_start();

    function redirect($url){
        echo "<script type='text/javascript'>"
            ."window.location.href='$url'"
            ."</script>";
    }

    function add($var){
        echo "<pre>";
        die(print_r($var));
    }

    function getUrl($modulo,$controlador,$funcion,$parametros=false,$pagina=false){
       
        if($pagina==false){
            $pagina="index";
        }
        $url="$pagina.php?modulo=$modulo&controlador=$controlador&funcion=$funcion";

        if($parametros!=false){
            foreach($parametros as $key => $valor){ // se la crea para poder ingresar mas parametros y no solo una
                $url.="&$key=$valor";
            }
        }
        return $url;
    }
    //resolver coge la url del modulo para verificar si existe la funcion
    function resolve(){
        $modulo=ucwords($_GET['modulo']);
        $controlador=ucwords($_GET['controlador']);//UsuarioController.php
        $funcion=$_GET['funcion'];

        if(is_dir("../controller/$modulo")){//si existe la carpeta
            if(file_exists("../controller/$modulo/".$controlador."Controller.php")){
                include_once "../controller/$modulo/".$controlador."Controller.php";
                $nombreClase=$controlador."Controller";
                $objClase=new $nombreClase();

                if(method_exists($objClase,$funcion)){
                    $objClase->$funcion();
                }else{
                    echo "La funcion especificada no existe";
                }
            }else{
                echo "El controlador especificado no existe";
            }
        }else{
            echo "El modulo especificado no existe";
        }
    }





    // is_dir //para saber si existe una carpeta es una function
    // file_exists //para saber si existe una archivo es una function
    // file_exists //para saber si existe una metodo es una function
    // ucwords /crea la primero letra en mayuscula , para los modulos,es una function
?>