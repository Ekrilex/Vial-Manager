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

            $deterioros = $_POST['deterioros'];

            echo "hola";
        }

        public function addDeterioros(){

            
        }

        public function index(){
            $objetoModel = new CasoModel();

            $sql = "SELECT C.*,E.*,U.* FROM tbl_caso AS C, tbl_estado AS E, tbl_usuario AS U WHERE C.usuario_id = U.usu_id AND C.estado_id = E.est_id ";

            $casosConsulta = $objetoModel->consultar($sql);

            include_once '../View/Caso/index.php';
        }

        public function getDetail(){
            $objetoModel = new CasoModel();
            $cas_id = $_GET['cas_id'];

            $sql = "SELECT C.*,E.*,U.*,T.*,TP.*,EN.* FROM tbl_caso AS C, tbl_estado AS E, tbl_usuario AS U, tbl_tramo AS T, tbl_tipo_de_pavimento AS TP, tbl_entorno AS EN WHERE cas_id = ".$cas_id." AND C.usuario_id = U.usu_id AND C.estado_id = E.est_id AND C.tramo_id = T.tra_id AND C.tipo_pavimento_id = TP.pav_id AND C.entorno_id = EN.ent_id;";

            $casoConsulta = $objetoModel->consultar($sql);

            include_once '../View/Caso/detalle.php';
        }

}
    
