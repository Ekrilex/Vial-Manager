<?php

    include_once '../Model/MasterModel.php';

    class CasoModel extends MasterModel{
        
        public function getDeterioros($idCaso){

            $sql = "SELECT CD.*,D.*,C.cas_id FROM tbl_caso_deterioro AS CD, tbl_deterioro AS D, tbl_caso AS C WHERE C.cas_id = ".$idCaso." AND D.det_id = CD.deterioro_id AND C.cas_id = CD.caso_id";

            //dd($sql);

            $deteriorosConsulta = $this->consultar($sql);
            
            if($deteriorosConsulta){
                return $deteriorosConsulta;
            }else{
                echo "<script>alert('".pg_last_error($this->getConnect())."');</script>";
            }
           
        }

        private function getTipoDeterioros($deterioros){

            $tiposDeterioros = array();

            for($i = 0; $i < COUNT($deterioros); $i++){

                $sql = "SELECT det_tipo_deterioro FROM tbl_deterioro WHERE det_id = ".$deterioros[$i]."";
                $consulta = $this->consultar($sql);

                $tipoDeterioroConsulta = pg_fetch_row($consulta);

                array_push($tiposDeterioros, $tipoDeterioroConsulta[0]);

            }

            return $tiposDeterioros;
            
        }

        public function calcularMetodologiaVizir($deterioros,$gravedades,$areas,$extensiones, $areaTramo){

            //calculo de la extension de cada deterioro
            //Tipos de deterioros:

            /*
            -Fisuras - IF 1
            -Deformaciones - ID 2
            -Perdida de capas estructurales - ID 3
            -Desprendimientos - IF 4
            -Daños superficiales - IF 5
            -Otros deterioros - ID 6
            */

            $tiposDeDeterioros = $this->getTipoDeterioros($deterioros);

            $indiceDeterioro = array(
                1 => array(10 => 1, 50 => 2, 100 => 3), 
                2 => array(10 => 2, 50 => 3, 100 => 4), 
                3 => array(10 => 3, 50 => 4, 100 => 5)
            );

            $indicesFisuracion = array();
            $indicesDeformacion = array();

            for($i = 0; $i < COUNT($gravedades);$i++){
                $seEncontroElIndice = false;

                foreach($indiceDeterioro[$gravedades[$i]] as $porcentaje => $valor){
                    //echo "<script>alert('extension: ".$extensiones[$i]."' + ' porcentaje: ".$porcentaje."' + ' se encontro el indice: ".$seEncontroElIndice."')</script>";

                    if($extensiones[$i] <= $porcentaje && $seEncontroElIndice == false){
                        $seEncontroElIndice = true;
                        //echo "<script>alert('".$tiposDeDeterioros[$i]."')</script>";

                        if ($tiposDeDeterioros[$i] == "Perdida de capas estructurales" or $tiposDeDeterioros[$i] == "Otros deterioros"  or $tiposDeDeterioros[$i]== "Deformaciones" ) {
                            array_push($indicesDeformacion,$valor);
                        }

                        if($tiposDeDeterioros[$i] == "Fisuras" or $tiposDeDeterioros[$i] == "Desprendimientos" or $tiposDeDeterioros[$i] == "Daños superficiales" ){
                            
                            array_push($indicesFisuracion,$valor);
                            

                        }


                    }

                }
            }
            
            $IF = 0;
            for($i = 0; $i < COUNT($indicesFisuracion); $i++){
                
                if($indicesFisuracion[$i]>=$IF){
                    $IF = $indicesFisuracion[$i];
                }
            }
            
            $ID = 0;
            for ($i=0; $i < COUNT($indicesDeformacion) ; $i++) { 
                if ($indicesDeformacion[$i] >= $ID ) {
                    $ID = $indicesDeformacion[$i];
                }
            }

            //echo "<script>alert('IF: ".$IF."' + ' ID: ".$ID."')</script>";

            $columnaIndiceSuperficial = array(
                0 => array(0 => 1, 1 => 2,2 => 2,3 => 3,4 => 4,5 => 4),
        
                1 => array(0 => 3, 1 => 3,2 => 3,3 => 4,4 => 5,5 => 5),
        
                2 => array(0 => 3, 1 => 3,2 => 3,3 => 4,4 => 5,5 => 5),
        
                3 => array(0 => 4, 1 => 5,2 => 5,3 => 5,4 => 6,5 => 6),
        
                4 => array(0 => 5, 1 => 6, 2 => 6, 3 => 7, 4 => 7, 5 => 7),
        
                5 => array(0 => 5, 1 => 6, 2 => 6, 3 => 7, 4 => 7, 5 => 7),
            );

            $IS = $columnaIndiceSuperficial[$IF][$ID];

            return $IS;

            /*print_r($deterioros);
            echo "<br>";
            
            
            print_r($tiposDeDeterioros);
            echo "<br>";

            
            print_r($gravedades);
            echo "<br>";

            
            print_r($areas);
            echo "<br>";
            
            
            print_r($extensiones);
            echo "<br>";
            
            
            print_r($indicesFisuracion);
            echo "<br>";

            
            print_r($indicesDeformacion);

            echo "<br>";

            echo "IF: ".$IF." ID: ".$ID;

            echo "<br>";

            echo "IS: ".$IS;

            echo "<script>alert('IS: ".$IS."')</script>";*/

            

        }

        

    }

?>