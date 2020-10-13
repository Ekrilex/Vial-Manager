<?php
    /*
        OBSERVACION: 
        se tendran que implementar las variables de sesion en los procesos 
        que implique registrar el usuario actual que realiza una modificacion en el sistema
    */

    include_once '../Model/Caso/CasoModel.php';

    class CasoController {
        
        public function getCreate(){

            $objetoModel = new CasoModel();

            $queryEntorno = "SELECT * FROM tbl_entorno";
            $queryPavimento = "SELECT * FROM tbl_tipo_de_pavimento";
            $queryDeterioro = "SELECT * FROM tbl_deterioro";
            $queryTramo = "SELECT * FROM tbl_tramo,tbl_barrio,tbl_estado,tbl_jerarquia_vial WHERE Barrio_id = bar_id AND Estado_id = est_id AND jerarquia_vial_id = jer_id";
            $eject = $objetoModel->consultar($queryEntorno);
            $eject2 = $objetoModel->consultar($queryPavimento);
            $deterioro = $objetoModel->consultar($queryDeterioro);
            $tramo = $objetoModel->consultar($queryTramo);            

            if($eject && $eject2 && $deterioro && $tramo){
                include_once '../View/Caso/registrar.php';
            } else {
                pg_last_error($eject);
            }
        }

        public static function obtenerCaso($tra_id){

            $objetoModel = new CasoModel();

            $query = "SELECT tramo_id FROM tbl_caso WHERE tramo_id = ".$tra_id."";
            $consultaCasos = $objetoModel->consultar($query);

            if(pg_num_rows($consultaCasos) > 0){
                return true;
            }else{
                return false;
            }

        }

        public function postCreate(){
            
            $objetoModel = new CasoModel();

            $cas_id = $objetoModel->autoincrement("tbl_caso","cas_id");
        
            $entorno_id        = $_POST['entorno_id'];
            $anchoInicio       = $_POST['tra_ancho_inicio'];
            $anchoFin          = $_POST['tra_ancho_fin'];
            $tramo_id          = $_POST['tramo_id'];
            $tipo_pavimento    = $_POST['tipo_pavimento_id'];
            $causa             = $_POST['cas_causa'];
            $deterioros        = $_POST['deterioros'];
            $gravedades        = $_POST['gravedades'];
            $areas             = $_POST['areas'];
            $coordenadasX      = $_POST['coordenadasx'];
            $coordenadasY      = $_POST['coordenadasy'];
            $foto_inicio       = $_FILES['img_caso']['name'];
            $img_inicio        = "assets/img/imagenesCasos/".$foto_inicio;

            $fecha_vencimiento = (date("Y") + 1)."-".date("m")."-".date("d");
            //echo "<script>alert('".$_POST['cas_fotografia_inicio_tmp']."');</script>";
            move_uploaded_file($_FILES['img_caso']['tmp_name'], $img_inicio);

            $arrayDeterioros = array();
            $extensiones     = array();
            $areaTramo       = ($anchoInicio+$anchoFin);
            $areaTramo      *= 500 / 10;

            for($i = 0; $i < count($areas); $i++){ $extensiones[$i] = ($areas[$i]*100)/$areaTramo; }

            $prioridad         = $objetoModel->calcularMetodologiaVizir($deterioros, $gravedades, $areas,$extensiones,$areaTramo);
            $autoincrementable = $objetoModel->autoincrement("puntos_geovisor","id");
            
            $sqlCaso     =  "INSERT INTO tbl_caso (cas_id, cas_fecha_creacion, cas_fecha_vencimiento,cas_fotografia_inicio,cas_prioridad,cas_causa,cas_disponibilidad,tipo_pavimento_id,estado_id,usuario_id,tramo_id,entorno_id) VALUES(".$cas_id.", 'now()','".$fecha_vencimiento."','".$img_inicio."','".$prioridad."','".$causa."',0,".$tipo_pavimento.",3,".$_SESSION['id'].",".$tramo_id.",".$entorno_id.")";
            $coordenadas =  "INSERT INTO puntos_geovisor (id,nombre,cas_id,geometry,coordenadax,coordenaday) VALUES($autoincrementable, 'coordenada".$cas_id."', $cas_id, GeomFromText('POINT($coordenadasX $coordenadasY)'), '".$coordenadasX."', '".$coordenadasY."')";

            $cas_det_id          = $objetoModel->autoincrement("tbl_caso_deterioro","cas_det_id");
            $insertarCaso        = $objetoModel->insertar($sqlCaso);
            $insertarCoordenadas = $objetoModel->insertar($coordenadas);

            if($insertarCaso && $insertarCoordenadas){
        
                for($i = 0; $i < COUNT($deterioros);$i++){
                        
                    $sqlCasoDeterioro = "INSERT INTO tbl_caso_deterioro VALUES(".$cas_det_id.",".$gravedades[$i].",".$areas[$i].",".$extensiones[$i].",".$deterioros[$i].",".$cas_id.")";
                        
                    $insertarCasoDeterioro = $objetoModel->insertar($sqlCasoDeterioro);

                    $cas_det_id++;
                }

                $_SESSION['resultRegistrar'] = "<span class='text-success'>el Caso <b>".$cas_id."</b> se ha Registrado Satisfactoriamente</span>";

                
            }else{
                $_SESSION['resultRegistrarError'] = "<span class='text-danger'>Error al Registrar el Caso <b>".$cas_id."</b>, Por Favor intente nuevamente</span>";

            }

            redirect(getUrl("Caso","Caso","getCreate"));
            
        }

        public function getCreateMap(){

            
            /*$deterioros = json_decode($_POST['arrayDet']);
            $gravedades = json_decode($_POST['arrayGra']);
            $areas      = json_decode($_POST['arrayArea']);
            $tramo      = $_POST['arrayTramo'];
            $causa      = $_POST['causa'];
            $entorno    = $_POST['entorno'];
            //$img        = $_POST['img'];
            $pavimento  = $_POST['pav'];*/

            $causa = $_POST['cas_causa'];
            $entorno = $_POST['entorno_id'];
            $pavimento = $_POST['tipo_pavimento_id'];
            $deterioros  = $_POST['deterioros'];
            $gravedades  = $_POST['gravedades'];
            $areas       = $_POST['areas'];
            $anchoInicio = $_POST['tra_ancho_inicio'];
            $anchoFin    = $_POST['tra_ancho_fin'];
            $tramo_id    = $_POST['tramo_id'];


            echo "<form id='formularioParte2' action='".getUrl("Caso", "Caso", "postCreate")."' method='POST' enctype='multipart/form-data'>";
                include_once '../View/Caso/VisorCasoRegistro.php';

                echo "<input type='hidden' name='cas_causa' value='$causa'>";
                echo "<input type='hidden' name='entorno_id' value='$entorno'>";
                echo "<input type='hidden' name='tipo_pavimento_id' value='$pavimento'>";
                echo "<input type='hidden' name='tra_ancho_inicio' value='$anchoInicio'>";
                echo "<input type='hidden' name='tra_ancho_fin' value='$anchoFin'>";
                echo "<input type='hidden' name='tramo_id' value='$tramo_id'>";

                for ($i=0; $i < COUNT($deterioros) ; $i++) { 
                    echo "<input type='hidden' name='deterioros[]' value='$deterioros[$i]'>";
                    echo "<input type='hidden' name='gravedades[]' value='$gravedades[$i]'>";
                    echo "<input type='hidden' name='areas[]' value='$areas[$i]'>"; 
                }

            echo "</form>";

            

        }

        public function index(){
            $objetoModel = new CasoModel();

            $sql = "SELECT C.*,E.*,U.* FROM tbl_caso AS C, tbl_estado AS E, tbl_usuario AS U WHERE C.usuario_id = U.usu_id AND C.estado_id = E.est_id ORDER BY cas_prioridad DESC";

            $casosConsulta = $objetoModel->consultar($sql);

            include_once '../View/Caso/index.php';
        }

        public function getDetail(){
            $objetoModel = new CasoModel();
            $cas_id = $_GET['cas_id'];

            $sql = "SELECT C.*,E.*,U.*,T.*,TP.*,EN.* FROM tbl_caso AS C, tbl_estado AS E, tbl_usuario AS U, tbl_tramo AS T, tbl_tipo_de_pavimento AS TP, tbl_entorno AS EN WHERE cas_id = ".$cas_id." AND C.usuario_id = U.usu_id AND C.estado_id = E.est_id AND C.tramo_id = T.tra_id AND C.tipo_pavimento_id = TP.pav_id AND C.entorno_id = EN.ent_id;";

            $casoConsulta = $objetoModel->consultar($sql);
            $deteriorosConsulta = $objetoModel->getDeterioros($cas_id);

           

            include_once '../View/Caso/detalle.php';
        }

        public function postFinalize(){

            $objetoModel = new CasoModel();
            
            $cas_id = $_POST['cas_id'];
            $foto_fin = $_FILES['cas_fotografia_fin']['name'];
            $observacion = $_POST['cas_fin_observacion'];

            $cas_fotografia_fin = "assets/img/imagenesCasos/".$foto_fin;

            move_uploaded_file($_FILES['cas_fotografia_fin']['tmp_name'], $cas_fotografia_fin);

            $sql = "UPDATE tbl_caso SET cas_fotografia_fin = '".$cas_fotografia_fin."', cas_observacion = '".$observacion."', estado_id = 5, usuario_id = ".$_SESSION['id']." WHERE cas_id = ".$cas_id."";

            //$sql = "UPDATE tbl_caso SET cas_fotografia_fin = '".$cas_fotografia_fin."', estado_id = 5, cas_prioridad = 1, usuario_id = ".$_SESSION['usu_id']." WHERE cas_id = ".$cas_id."";

            //los casos finalizados tendran la prioridad mas baja
            $finalizarCaso = $objetoModel->editar($sql);

            if($finalizarCaso){

                $_SESSION['resultFinalizar'] = "<span class='text-success'>el Caso <b>".$cas_id."</b> se ha Finalizado Satisfactoriamente</span>";

            }else{

                $_SESSION['resultFinalizarError'] = "<span class='text-danger'>Error al Finalizar el Caso <b>".$cas_id."</b>, Por Favor intente nuevamente</span>";


            }

            redirect(getUrl("Caso","Caso","getDetail",array("cas_id" => $cas_id)));

        }
        
        public function postDelete(){

            $objetoModel = new CasoModel();

            $cas_id      = $_POST['cas_id'];
            $estado_id   = $_POST['estado_id'];

            if($estado_id == 3){
                $cas_observacion = $_POST['observacion'];
                $sql = "UPDATE tbl_caso SET estado_id = 2, cas_observacion = '".$cas_observacion."', cas_disponibilidad = 1, usuario_id = ".$_SESSION['id']." WHERE cas_id= ".$cas_id."";
                $colorEstado = "rgb(250,0,0)";
                $nombreEstado = "Inhabilitado";

            } else if($estado_id == 2){
                $cas_observacion = $_POST['observacion'];
                $sql = "UPDATE tbl_caso SET estado_id = 3, cas_observacion = '".$cas_observacion."', cas_disponibilidad = 0, usuario_id = ".$_SESSION['id']." WHERE cas_id= ".$cas_id."";
                $colorEstado = "rgb(255, 119, 0)";
                $nombreEstado = "Pendiente";
                
            }

            //$_SESSION['usu_id'];

            $cambioDeEstado = $objetoModel->editar($sql);

            echo "<label>Estado: </label>"
            ."<input type='text' class='form-control' style='color:".$colorEstado."; font-weight:bold;' placeholder='Estado' value='".$nombreEstado."' readonly>";

        }

        public function getUpdate(){

            $objetoModel = new CasoModel();

            $caso_id = $_POST['caso_id'];
            
            $sqlCaso= "SELECT C.*,E.*,U.*,T.*,TP.*,EN.* FROM tbl_caso AS C, tbl_estado AS E, tbl_usuario AS U, tbl_tramo AS T, tbl_tipo_de_pavimento AS TP, tbl_entorno AS EN WHERE cas_id = ".$caso_id." AND C.usuario_id = U.usu_id AND C.estado_id = E.est_id AND C.tramo_id = T.tra_id AND C.tipo_pavimento_id = TP.pav_id AND C.entorno_id = EN.ent_id;";
            $casoConsulta = $objetoModel->consultar($sqlCaso);

            $sqlEntornos = "SELECT * FROM tbl_entorno";
            $sqlTramos = "SELECT * FROM tbl_tramo,tbl_barrio,tbl_estado,tbl_jerarquia_vial WHERE Barrio_id = bar_id AND Estado_id = est_id AND jerarquia_vial_id = jer_id";
            $sqlDeterioros = "SELECT * FROM tbl_Deterioro ORDER BY det_clasificacion ASC";
            $sqlDeteriorosCaso = "SELECT * FROM tbl_caso_deterioro AS CD, tbl_deterioro AS D WHERE CD.caso_id = ".$caso_id." AND CD.deterioro_id = D.det_id ORDER BY det_clasificacion ASC;";

            $eject = $objetoModel->consultar($sqlEntornos);
            $tramo = $objetoModel->consultar($sqlTramos);
            $deterioro = $objetoModel->consultar($sqlDeterioros);
            $deteriorosCasoConsulta = $objetoModel->consultar($sqlDeteriorosCaso);

            include_once '../View/Caso/editar.php';

        }

        public function postUpdate(){

            $obj = new CasoModel();

            $caso             =  $_POST['caso'];
            $estado           =  $_POST['estado'];
            $entorno          =  $_POST['entorno_id'];
            $tramo            =  $_POST['tramo_id'];
            $ancho_inicio     =  $_POST['tra_ancho_inicio'];
            $ancho_fin        =  $_POST['tra_ancho_fin'];
            $causa            =  $_POST['cas_causa'];
            $deterioros       =  $_POST['deterioros'];
            $areas            =  $_POST['areas'];
            $gravedades       =  $_POST['gravedades'];
            $img_vieja_inicio =  $_POST['foto_inicio_backup'];

            $areaTramo = ($ancho_inicio+$ancho_fin);
            $areaTramo *= (500 / 10);

            $extensiones = array();

            for($i = 0; $i < count($areas); $i++){
                $extensiones[$i] = ($areas[$i]*100)/$areaTramo;
            }

            $prioridad = $obj->calcularMetodologiaVizir($deterioros, $gravedades, $areas,$extensiones,$areaTramo);

            if (isset($_FILES['foto_inicio']['name'])) {
                $foto_inicio = $_FILES['foto_inicio']['name'];
                $ruta_foto_inicio = "assets/img/imagenesCasos/$foto_inicio";
                move_uploaded_file($_FILES['foto_inicio']["tmp_name"],$ruta_foto_inicio);
                unlink($img_vieja_inicio);

                $queryUpdate = "UPDATE tbl_caso SET entorno_id = $entorno, tramo_id = $tramo, cas_causa = '".$causa."',".
                           "cas_fotografia_inicio = '".$ruta_foto_inicio."', cas_prioridad = $prioridad, usuario_id=".$_SESSION['id']." WHERE cas_id = ".$caso."";
                
            } else {

                $queryUpdate = "UPDATE tbl_caso SET entorno_id = $entorno, tramo_id = $tramo, cas_causa = '".$causa."',".
                           "cas_prioridad = $prioridad, usuario_id=".$_SESSION['id']." WHERE cas_id = ".$caso." ";

            }

            if ($estado == 5) {

                $img_vieja_fin = $_POST['foto_fin_backup'];

                if (isset($_FILES['foto_fin']['name'])) {
                    $foto_fin = $_FILES['foto_fin']['name'];
                    $ruta_foto_fin = "assets/img/imagenesCasos/$foto_fin";
                    move_uploaded_file($_FILES['foto_fin']['tmp_name'],$ruta_foto_fin);
                    unlink($img_vieja_fin);

                    $queryUpdateImgOld = "UPDATE tbl_caso SET cas_fotografia_fin = '".$ruta_foto_fin."' WHERE cas_id = ".$caso." ";

                    $ejectQueryImg = $obj->editar($queryUpdateImgOld);
                    
                }
            }

            $ejectQuery = $obj->editar($queryUpdate);

            $queryCasosDeterioro = "DELETE FROM tbl_caso_deterioro WHERE caso_id = $caso";



            if($ejectQuery){

                $cas_det_id = $obj->autoincrement("tbl_caso_deterioro","cas_det_id");

                $ejectQuery2 = $obj->eliminar($queryCasosDeterioro);

                for($i = 0; $i < COUNT($deterioros);$i++){
                    
                    $sqlCasoDeterioro = "INSERT INTO tbl_caso_deterioro VALUES(".$cas_det_id.",".$gravedades[$i].",".$areas[$i].",".$extensiones[$i].",".$deterioros[$i].",".$caso.")";
                    
                    $insertarCasoDeterioro = $obj->insertar($sqlCasoDeterioro);

                    $cas_det_id = $obj->autoincrement("tbl_caso_deterioro","cas_det_id");
                }
                
                $_SESSION['resultEditar'] = "<span class='text-success'>el Caso <b>".$caso."</b> se ha modificado satisfactoriamente</span>";


            }else{

                $_SESSION['resultEditarError'] = "<span class='text-danger'>Error al editar el Caso <b>".$caso."</b>, intente nuevamente</span>";


            }

            redirect(getUrl("Caso","Caso","getDetail",array("cas_id" => $caso)));
        }

        public function editarPrioridad(){
            $objetoModel = new CasoModel();

            $prioridad = $_POST['cas_prioridad'];
            $caso = $_POST['cas_id'];

            //$query = "UPDATE tbl_caso SET cas_prioridad = $prioridad WHERE cas_id = $caso;";
            $query = "UPDATE tbl_caso SET cas_prioridad = $prioridad, usuario_id=".$_SESSION['id']." WHERE cas_id = $caso";
           
            $cambioPrioridad = $objetoModel->editar($query);

            if ($prioridad == 1 || $prioridad == 2  ) {
                 $resultado = "<p class='text-success'><i class='fas fa-thumbs-up text-success'></i>&nbsp;Baja</p>";
            } else if ($prioridad == 3 || $prioridad == 4){
                 $resultado = "<p class='text-warning'><i class='fas fa-exclamation-triangle text-warning'></i>&nbsp;Media</p>";
            } else if ($prioridad  > 4 || $prioridad <= 7 ){
                 $resultado = "<p class='text-danger'><i class='fas fa-flag text-danger'></i>&nbsp;Alta</p>";
            }

            echo "<span>".$resultado."</span>&nbsp;";

        }


    }
