<?php 
    include_once '../Model/MasterModel.php';

    class UsuarioModel extends MasterModel{

        // Funcion para generar los nicknames de los usuarios
        function genereteUser($nombre,$apellido){
            $a = strtoupper(substr($nombre, 0, 1));
            $b = $apellido;

            return $a.$b;
        }
        
    }

?>