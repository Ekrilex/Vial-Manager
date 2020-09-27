<?php 
    include_once '../Model/Acerca/AcercaModel.php';

    class AcercaController{

        public function getAcerca(){
            $obj= new AcercaModel();
         
           include_once '../View/Acerca/Acerca.php';
            
        }

        
    }
?>