<?php 
    include_once '../Model/MasterModel.php';

    class CorreoModel extends MasterModel{

        // Funcion para generar los nicknames de los usuarios
        function Personalizado($email){
          $e1=substr($email,0,3);
          $e2 = strstr($email, '@');
          $ema=$e1."******".$e2;
            return $ema;
        }
        
    }

?>