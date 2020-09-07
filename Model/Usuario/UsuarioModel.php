<?php 
    include_once '../Model/MasterModel.php';

    class UsuarioModel extends MasterModel{


        function genereteUser($nombre,$apellido){
            $a = strtoupper(substr($nombre, 0, 1));
            $b = $apellido;

            return $a.$b;
        }
        
    }

?>