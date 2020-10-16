<?php 
    include_once '../Model/Cali/CaliModel.php';

    class CaliController{

        public function getHistoria(){
            $obj= new CaliModel();
         
           include_once '../View/Cali/Historia.php';
            
        }
        public function getBe(){
            $obj= new CaliModel();
         
           include_once '../View/Cali/BanderaEscudo.php';
            
        }
        public function getIg(){
            $obj= new CaliModel();
         
           include_once '../View/Cali/InformacionGeo.php';
            
        }
        public function getIv(){
            $obj= new CaliModel();
         
           include_once '../View/Cali/InfrastructuraVial.php';
            
        }
        public function getMa(){
            $obj= new CaliModel();
         
           include_once '../View/Cali/Mantenimiento.php';
            
        }
        public function getCv(){
            $obj= new CaliModel();
         
           include_once '../View/Cali/ClasificacionVia.php';
            
        }
        public function getBc(){
            $obj= new CaliModel();
         
           include_once '../View/Cali/BarrioComuna.php';
            
        }
        
    }
?>