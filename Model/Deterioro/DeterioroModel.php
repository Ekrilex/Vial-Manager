<?php 
    include_once '../Model/MasterModel.php';

    class DeterioroModel extends MasterModel{
   
        function Tipos(){
         $tipos= array(
         	"Fisuras",
         	"Deformidades",
         	"Pérdida de capas estructurales",
         	"Daños superficiales",
            "Desprendimientos",
         	"Otros deterioros"
         );
         return $tipos;  
        }
        

        function Clasificacion(){
         $cla= array("A","B");
         return $cla;           
        }

        function validaTipo($valor){
         
         $t=$valor; $c=0; 

         $a=array(
         	"Fisuras",
         	"Deformidades",
         	"Pérdida de capas estructurales",
         	"Daños superficiales",
         	"Otros daños"
         );

         foreach ($a as $key => $val) {
         	if ($val==$t) {
         	   $c++;
         	}
         }
        
         if ($c>0) { $r=$t;}else{ $r=""; }
          return $r;
        
        }

        
        function validaClasi($valor){
         
         $cl=$valor; $con=0; 
         $b=array("A","B");

         foreach ($b as $key => $vale) {
         	if ($vale==$cl) {
         	   $con++;
         	}
         }
        
         if ($con>0) { $rr=$cl;}else{ $rr=""; }
          return $rr;
        
        }

        function Rect($nombre,$tipo,$clasificacion){
       
       $c=0;
    
       if (!$nombre!="") {
        $_SESSION['result']['nombre']="<h3 class='text-danger'>(*)Debe llenar el nombre del deterioro</h3>";
            $c++;}

      if (!$tipo!="") {
         $_SESSION['result']['tipo']="<h3 class='text-danger'>(*)Debe seleccionar el tipo de deteriro</h3>";
        $c++;    
      }     
    
     if (!$clasificacion!="") {
           $_SESSION['result']['clasificacion']="<h3 class='text-danger'>(*)Debe seleccionar la clasificación</h3>";
        $c++;    
     }
       
     return $c;

    }        

    }

?>