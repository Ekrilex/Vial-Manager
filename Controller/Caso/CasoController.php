<?php

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

        public function postCreate(){
            $objetoModel = new CasoModel();

            $cas_id = $objetoModel->autoincrement("tbl_caso","cas_id");
            //Tramo ancho:
            $AnchoInicio = $_POST['tra_ancho_inicio'];
            $AnchoFin = $_POST['tra_ancho_fin'];
            //
            $entorno_id = $_POST['entorno_id'];
            $tramo_id = $_POST['tramo_id'];
            $foto_inicio = $_FILES['cas_fotografia_inicio']['name'];

            $img_inicio = "assets/img/imagenesCasos/".$foto_inicio;

            move_uploaded_file($_FILES['cas_fotografia_inicio']['tmp_name'], $img_inicio);

            $tipo_pavimento = $_POST['tipo_pavimento_id'];
            $causa = $_POST['cas_causa'];

            $fecha_vencimiento = (date("Y") + 1)."-".date("m")."-".date("d");

            $deterioros = $_POST['deterioros'];
            $gravedades = $_POST['gravedades'];
            $areas = $_POST['areas'];
            
            $areaTramo = ($AnchoInicio+$AnchoFin);
            $areaTramo *= 500 / 10;

            $extensiones = array();

            for($i = 0; $i < count($areas); $i++){

                $extensiones[$i] = ($areas[$i]*100)/$areaTramo;

            }

            $prioridad = $objetoModel->calcularMetodologiaVizir($deterioros, $gravedades, $areas,$extensiones,$areaTramo);

            $sqlCaso = "INSERT INTO tbl_caso (cas_id, cas_fecha_creacion, cas_fecha_vencimiento,cas_fotografia_inicio,cas_prioridad,cas_causa,cas_disponibilidad,tipo_pavimento_id,estado_id,usuario_id,tramo_id,entorno_id) VALUES(
                ".$cas_id.",
                'now()',
                '".$fecha_vencimiento."',
                '".$img_inicio."',
                '".$prioridad."',
                '".$causa."',
                0,
                ".$tipo_pavimento.",
                3,
                1,
                ".$tramo_id.",
                ".$entorno_id.")";

            //dd($sqlCaso);
            
            //echo "<script>alert('".$prioridad."');</script>";

            $insertarCaso = $objetoModel->insertar($sqlCaso);

            if($insertarCaso){
                //echo "<script>alert('el caso se ha registrado correctamente');</script>";

                $cas_det_id = $objetoModel->autoincrement("tbl_caso_deterioro","cas_det_id");
                for($i = 0; $i < COUNT($deterioros);$i++){
                    
                    $sqlCasoDeterioro = "INSERT INTO tbl_caso_deterioro VALUES(".$cas_det_id.",".$gravedades[$i].",".$areas[$i].",".$extensiones[$i].",".$deterioros[$i].",".$cas_id.")";
    
                    /*echo $sqlCasoDeterioro;
                    echo "<br>";*/
                    
                    $insertarCasoDeterioro = $objetoModel->insertar($sqlCasoDeterioro);

                    $cas_det_id = $objetoModel->autoincrement("tbl_caso_deterioro","cas_det_id");
                }

                $_SESSION['resultRegistrar'] = "<span class='text-success'>el Caso <b>".$cas_id."</b> se ha registrado satisfactoriamente</span>";

                redirect(getUrl("Caso","Caso","getCreate"));

            }else{

                $_SESSION['resultRegistrarError'] = "<span class='text-danger'>Error al registrar el Caso <b>".$cas_id."</b>, intente nuevamente</span>";

                //echo "<script>alert('error al registrar el caso');</script>";
            }

            
            

            
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

            $cas_fotografia_fin = "assets/img/imagenesCasos/".$foto_fin;

            move_uploaded_file($_FILES['cas_fotografia_fin']['tmp_name'], $cas_fotografia_fin);

            $sql = "UPDATE tbl_caso SET cas_fotografia_fin = '".$cas_fotografia_fin."', estado_id = 5, cas_prioridad = 1, usuario_id = 1 WHERE cas_id = ".$cas_id."";

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

            $cas_id = $_POST['cas_id'];
            $estado_id = $_POST['estado_id'];

            if($estado_id == 3){
                $sql = "UPDATE tbl_caso SET estado_id = 2, cas_disponibilidad = 1 WHERE cas_id= ".$cas_id."";
                $colorEstado = "rgb(250,0,0)";
                $nombreEstado = "Inhabilitado";
                

            } else if($estado_id == 2){
                $sql = "UPDATE tbl_caso SET estado_id = 3, cas_disponibilidad = 1 WHERE cas_id= ".$cas_id."";
                $colorEstado = "rgb(255, 119, 0)";
                $nombreEstado = "Pendiente";
                
            }

            $cambioDeEstado = $objetoModel->editar($sql);

            echo "<label>Estado: </label>"
            ."<input type='text' class='form-control' style='color:".$colorEstado."; font-weight:bold;' placeholder='Estado' value='".$nombreEstado."' readonly>";

        }


    }
    
?>