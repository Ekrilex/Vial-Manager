<?php 
    include_once '../Model/Mapa/MapaModel.php';

    class MapaController{

        public function getMapa(){
            $obj= new MapaModel();
        
           include_once '../View/Mapa/Mapa.php';
            
        }

        
    }
?>