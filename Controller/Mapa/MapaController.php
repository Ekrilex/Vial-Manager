<?php 
    include_once '../Model/Mapa/MapaModel.php';

    class MapaController{

        public function getMapa(){
            $obj= new MapaModel();
        
           include_once '../View/Mapa/Mapa.php';
            
        }

        public function indexPoint(){
            $objetoModel= new MapaModel();

            $cx = $_POST['cx'];
            $cy = $_POST['cy'];

            $sqlCoordenadas = "SELECT coordenadax, coordenaday FROM puntos_geovisor";
            $consultaCoordenadas = $objetoModel->consultar($sqlCoordenadas);
            
            //$cx = $cx + 200;
            //$cy = $cy - 200;

            // echo ($cx+10)." : ".($cx-10)." \n".
            // ($cy+10)." : ".($cy-10);

            // $cx = 1061378.9767333334;
            // $cy = 870619.1795666666;
            $huboUnaCoincidencia = false;
            while($coordenadas = pg_fetch_assoc($consultaCoordenadas)){

                if($cx >= ($coordenadas['coordenadax']-50) && $cx <= ($coordenadas['coordenadax']+50)){
                    //echo "x coincide";
                    if($cy >= ($coordenadas['coordenaday']-50) && $cy <= ($coordenadas['coordenaday']+50)){
                        //echo "y coincide";
                        $huboUnaCoincidencia = true;

                        $sqlCoincidencia = "SELECT cas_id FROM puntos_geovisor WHERE coordenadax = '".$coordenadas['coordenadax']."' AND coordenaday = '".$coordenadas['coordenaday']."'";
                        $consultaCoincidencia = $objetoModel->consultar($sqlCoincidencia);

                        $caso = pg_fetch_row($consultaCoincidencia);

                        $sqlCaso = "SELECT * FROM tbl_caso WHERE cas_id = ".$caso[0]."";
                        $sqlCaso = "SELECT C.*,E.*,U.*,T.*,TP.*,EN.* FROM tbl_caso AS C, tbl_estado AS E, tbl_usuario AS U, tbl_tramo AS T, tbl_tipo_de_pavimento AS TP, tbl_entorno AS EN WHERE cas_id = ".$caso[0]." AND C.usuario_id = U.usu_id AND C.estado_id = E.est_id AND C.tramo_id = T.tra_id AND C.tipo_pavimento_id = TP.pav_id AND C.entorno_id = EN.ent_id;";
                        $sqlCasoDeterioro = "SELECT CD.*,D.*,C.cas_id FROM tbl_caso_deterioro AS CD, tbl_deterioro AS D, tbl_caso AS C WHERE C.cas_id = ".$caso[0]." AND D.det_id = CD.deterioro_id AND C.cas_id = CD.caso_id";
                        $casoConsultado = $objetoModel->consultar($sqlCaso);
                        $deteriorosConsulta = $objetoModel->consultar($sqlCasoDeterioro);
                        if($casoConsultado){
                            //echo "se encontro un caso";
                            while($casoEncontrado = pg_fetch_assoc($casoConsultado)){
                                include_once '../View/Mapa/ContenidoConsulta.php';
                            
                                    //include_once 'modalFotoInicio.php';
                            }
                        }

                    }
                    
                }

            }

            if(!$huboUnaCoincidencia){
                echo "No se encontro ningun caso, por favor intente nuevamente";
            }

        }

        
    }
?>