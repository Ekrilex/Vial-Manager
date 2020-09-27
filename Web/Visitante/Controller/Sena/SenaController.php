<?php 
    include_once '../Model/Sena/SenaModel.php';

    class SenaController{

        public function getSena(){
            $obj= new SenaModel();

            @$menu=$_POST['menu'];
            if ($menu==1) {
            @$_SESSION['menu']="1";
            }else if($menu==0){
            @$_SESSION['menu']="0";

            }
            include_once '../View/Sena/Organizacion.php';
            
        }
 
    }
?>