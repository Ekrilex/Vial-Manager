<?php 

    
    include_once '../Model/Tramo/TramoModel.php';

    class TramoController {

        public function getCreate(){

            $objetoModel = new TramoModel();

            $sqlTipoCalzada = "SELECT * FROM tbl_tipo_de_calzada ORDER BY tipc_id ASC";
            $tipoCalzada = $objetoModel->consultar($sqlTipoCalzada);


            $sqlTipoCalzadaInicio = "SELECT * FROM tbl_tipo_de_calzada ORDER BY tipc_id ASC ";
            $TipoCalzadaInicio = $objetoModel->consultar($sqlTipoCalzadaInicio);
            $queryCalzadaInicio = pg_fetch_row($TipoCalzadaInicio);


            $sqlCalzada = "SELECT * FROM tbl_calzada WHERE tipo_calzada_id = ".$queryCalzadaInicio[0]."";
            $calzadas = $objetoModel->consultar($sqlCalzada);
            
            $sqlElemento = "SELECT * FROM tbl_elemento_complementario";
            $elementos = $objetoModel->consultar($sqlElemento);

            $sqlJerarquia = "SELECT * FROM tbl_jerarquia_vial";
            $jerarquias = $objetoModel->consultar($sqlJerarquia);

            $sqlBarrios = "SELECT * FROM tbl_barrio, tbl_comuna WHERE comuna_id = com_id LIMIT 10";
            $barrios = $objetoModel->consultar($sqlBarrios);

            
            include_once '../View/Tramo/registrar.php';
        }

        public function filtroCalzada(){
            /*funcion que hace que el contendo del select 
              de la calzada muestrela informacion segun lo que se elija en tipo de calzada*/

            $objetoModel = new TramoModel();

            $tipoCalzada = $_POST['tipoCalzadaSelect'];

            $sqlCalzada = "SELECT * FROM tbl_calzada WHERE tipo_calzada_id = ".$tipoCalzada."";
            $calzadas = $objetoModel->consultar($sqlCalzada);

            include_once '../View/Tramo/filtroCalzada.php';

        }

        public function filtroBarrio(){

            $objetoModel = new TramoModel();
            $barrioBuscado = $_POST['barrioBuscado'];

            $sql = "SELECT * FROM tbl_barrio, tbl_comuna WHERE (bar_descripcion LIKE '%".$barrioBuscado."%' OR com_id::varchar LIKE '%".$barrioBuscado."%') AND comuna_id = com_id LIMIT 10";

            $barrios = $objetoModel->consultar($sql);

            include_once '../View/Tramo/filtroBarrio.php';
            
        }

        public function elegirBarrio(){

            $objetoModel = new TramoModel();
            $bar_id = $_POST['barrioSeleccionado'];
            $sql = "SELECT * FROM tbl_barrio WHERE bar_id=".$bar_id."";

            $barrioSelect = $objetoModel->consultar($sql);

            $barrio = pg_fetch_row($barrioSelect);

            echo $barrio[1];

        }

        public function enviarEje(){

            $objetoModel = new TramoModel();
            $jerarquia = $_POST['JerarquiaSelect'];

            $sqlEjes = "SELECT * FROM tbl_eje_vial, tbl_jerarquia_vial WHERE jerarquia_id = ".$jerarquia." AND jer_id = jerarquia_id ";
            $EjeVial = $objetoModel->consultar($sqlEjes);

            include_once '../View/Tramo/contenidoModalEje.php';

        }

        public function filtroEje(){

            $objetoModel = new TramoModel();
            $ejeBuscado = $_POST['EjeBuscado'];
            $jerarquia = $_POST['JerarquiaSelect'];

            $sqlEjes = "SELECT * FROM tbl_eje_vial, tbl_jerarquia_vial WHERE eje_numero::varchar LIKE '%".$ejeBuscado."%' AND jerarquia_id = ".$jerarquia." AND jer_id = jerarquia_id ";
            $EjeVial = $objetoModel->consultar($sqlEjes);

            include_once '../View/Tramo/filtroEje.php';

        }

        public function elegirEje(){

            $objetoModel = new TramoModel();
            $eje_id = $_POST['ejeSeleccionado'];

            $sql = "SELECT * FROM tbl_eje_vial WHERE eje_id=".$eje_id."";

            $ejeSelect = $objetoModel->consultar($sql);

            $eje = pg_fetch_row($ejeSelect);

            echo "Eje Vial Numero: ".$eje[1];

        }

        public function postCreate(){

            $objetoModel = new TramoModel();
            
            $tra_id = $objetoModel->autoincrement("tbl_tramo", "tra_id");
            $tra_nombre_via = $_POST['tra_nombre_via'];
            $tra_nomenclatura = $_POST['tra_nomenclatura'];
            //$tra_fecha_creacion = date("d")."-".date("m")."-".date("Y");
            $tra_segmento = $_POST['tra_segmento'];
            $tra_disponibilidad = 0;
            $tra_ancho_inicio = $_POST['tra_ancho_inicio']; 
            $tra_ancho_fin = $_POST['tra_ancho_fin']; 
            $calzada_id = $_POST['calzada_id'];
            $barrio_id = $_POST['barrio_id'];
            $elemento_id = $_POST['elemento_id'];
            $jerarquia_vial_id = $_POST['jerarquia_vial_id'];
            $eje_vial_id = $_POST['eje_vial_id'];
            $estado_id = 1;
            $usuario_id = 1;//se utilizara el usuario de prueba ya que aun no existen variables de session

            /*$usuario_id = $_SESSION['usu_id'];*/

            //en esta parte se realizara el calculo de el codigo de 12 digitos de cada tramo segun el formulario

            //Obtener el numero del eje vial
            $sqlEje = "SELECT * FROM tbl_eje_vial WHERE eje_id = ".$eje_vial_id."";
            $Eje = $objetoModel->consultar($sqlEje);
            $numeroEje = pg_fetch_row($Eje);

            //Obtener el numero de la calzada para el codigo
            $sqlCalzada = "SELECT * FROM tbl_calzada WHERE cal_id = ".$calzada_id."";
            $Calzada = $objetoModel->consultar($sqlCalzada);
            $numeroCalzada = pg_fetch_row($Calzada);

            $tra_codigo = $jerarquia_vial_id * 100000000000; // la jerarquia en el codigo es el primer digito
            $tra_codigo += $numeroEje[1] * 100000000000 / 10000; // el ejevial corresponde son los 4 digitos despues de la jerarquia
            $tra_codigo += $numeroCalzada[1] * 1000000; // la calzada es el quinto digito del codigo
            $tra_codigo += $elemento_id * 100000; //el elemento es el sexto digito del codigo
            $tra_codigo += $tra_segmento * 1000/1000; //el segmento ocupa los 5 digitos restantes de los 12

            $sql = "INSERT INTO tbl_tramo VALUES(".$tra_id.",
            ".$tra_codigo.",
            current_timestamp,
            ".$tra_segmento.",
            '".$tra_nomenclatura."',
            '".$tra_nombre_via."',
            ".$calzada_id.",
            ".$barrio_id.",
            ".$elemento_id.",
            ".$jerarquia_vial_id.",
            ".$eje_vial_id.",
            ".$estado_id.",
            ".$usuario_id.",
            ".$tra_disponibilidad.",
            ".$tra_ancho_inicio.",
            ".$tra_ancho_fin." )";

            $registrarTramo = $objetoModel->insertar($sql);
            

            if($registrarTramo){
                echo "<script>"
                ."alert('El tramo se ha registrado satisfactoriamente');"
                ."</script>";

            }else{
                echo "<script>"
                ."alert('Error al registrar el tramo');"
                ."</script>";

                
            }
            
            redirect(getUrl("Tramo","Tramo","getCreate"));
        }

        public function index(){

            $objetoModel = new TramoModel();

            $sql = "SELECT * FROM tbl_tramo,tbl_barrio,tbl_estado WHERE Barrio_id = bar_id AND Estado_id = est_id";
            $consultaTramos = $objetoModel->consultar($sql); 

            include_once '../View/Tramo/consultar.php';


        } 

        public function getDetail(){

            $objetoModel = new TramoModel();

            $tra_id = $_GET['tra_id'];

            $sql = "SELECT T.*, C.*, TC.tipc_descripcion, B.*, EL.ele_descripcion, J.jer_descripcion, EJ.eje_numero, E.* , U.usu_primer_nombre,U.usu_primer_apellido, U.usu_segundo_nombre, U.usu_segundo_apellido
            FROM tbl_tramo AS T,tbl_calzada AS C,tbl_tipo_de_calzada AS TC,tbl_barrio AS B,tbl_elemento_complementario AS EL,tbl_jerarquia_vial AS J,tbl_eje_vial AS EJ,tbl_estado AS E,tbl_usuario AS U
            WHERE T.calzada_id = C.cal_id AND C.tipo_calzada_id = TC.tipc_id AND T.barrio_id = B.bar_id AND T.elemento_id = EL.ele_id AND T.jerarquia_vial_id = J.jer_id AND T.eje_vial_id = EJ.eje_id AND T.estado_id = E.est_id AND T.usuario_id = U.usu_id AND tra_id = ".$tra_id." ";

            $tramo = $objetoModel->consultar($sql);

            include_once '../View/Tramo/DetalleTramo.php';


        }

        public function getUpdate(){

            $objetoModel = new TramoModel();
            
            $tra_id = $_POST['tra_id'];

            $sqlTipoCalzada = "SELECT * FROM tbl_tipo_de_calzada ORDER BY tipc_id ASC";
            $tipoCalzada = $objetoModel->consultar($sqlTipoCalzada);

            //consulta para determinar que tipo de calzada tiene el tramo seleccionado para realizara la consulta respectiva de la calzada
            $sqlTipoCalzadaSeleccionada = "SELECT T.calzada_id, TC.tipc_id
            FROM tbl_tramo AS T,tbl_calzada AS C,tbl_tipo_de_calzada AS TC
            WHERE T.calzada_id = C.cal_id AND C.tipo_calzada_id = TC.tipc_id AND tra_id = ".$tra_id."";
            $tCalzadaSelect = $objetoModel->consultar($sqlTipoCalzadaSeleccionada);
            $queryTCalzadaSeleccionada = pg_fetch_row($tCalzadaSelect);

            //Carga de las opciones de los selects
            $sqlCalzada = "SELECT * FROM tbl_calzada WHERE tipo_calzada_id = ".$queryTCalzadaSeleccionada[1]." ";
            $calzadas = $objetoModel->consultar($sqlCalzada);
            
            $sqlElemento = "SELECT * FROM tbl_elemento_complementario";
            $elementos = $objetoModel->consultar($sqlElemento);

            $sqlJerarquia = "SELECT * FROM tbl_jerarquia_vial";
            $jerarquias = $objetoModel->consultar($sqlJerarquia);

            $sqlBarrios = "SELECT * FROM tbl_barrio, tbl_comuna WHERE comuna_id = com_id LIMIT 10";
            $barrios = $objetoModel->consultar($sqlBarrios);

            //cargar de la informacion del tramo seleccionado
            $sql = "SELECT T.*, C.*, TC.*, B.*, EL.ele_descripcion, J.jer_descripcion, EJ.*, E.* , U.usu_primer_nombre,U.usu_primer_apellido, U.usu_segundo_nombre, U.usu_segundo_apellido
            FROM tbl_tramo AS T,tbl_calzada AS C,tbl_tipo_de_calzada AS TC,tbl_barrio AS B,tbl_elemento_complementario AS EL,tbl_jerarquia_vial AS J,tbl_eje_vial AS EJ,tbl_estado AS E,tbl_usuario AS U
            WHERE T.calzada_id = C.cal_id AND C.tipo_calzada_id = TC.tipc_id AND T.barrio_id = B.bar_id AND T.elemento_id = EL.ele_id AND T.jerarquia_vial_id = J.jer_id AND T.eje_vial_id = EJ.eje_id AND T.estado_id = E.est_id AND T.usuario_id = U.usu_id AND tra_id = ".$tra_id." ";

            $tramo = $objetoModel->consultar($sql);
            
            include_once '../View/Tramo/editar.php';
        }

        public function postUpdate(){

            $objetoModel = new TramoModel();
            
            $tra_id = $_POST['tra_id'];
            $tra_nombre_via = $_POST['tra_nombre_via'];
            $tra_nomenclatura = $_POST['tra_nomenclatura'];
            $tra_segmento = $_POST['tra_segmento'];
            $tra_ancho_inicio = $_POST['tra_ancho_inicio']; 
            $tra_ancho_fin = $_POST['tra_ancho_fin']; 
            $calzada_id = $_POST['calzada_id'];
            $barrio_id = $_POST['barrio_id'];
            $elemento_id = $_POST['elemento_id'];
            $jerarquia_vial_id = $_POST['jerarquia_vial_id'];
            $eje_vial_id = $_POST['eje_vial_id'];
            $usuario_id = 1;//se utilizara el usuario de prueba ya que aun no existen variables de session

            /*$usuario_id = $_SESSION['usu_id'];*/

            $sqlEje = "SELECT * FROM tbl_eje_vial WHERE eje_id = ".$eje_vial_id."";
            $Eje = $objetoModel->consultar($sqlEje);
            $numeroEje = pg_fetch_row($Eje);

            
            $sqlCalzada = "SELECT * FROM tbl_calzada WHERE cal_id = ".$calzada_id."";
            $Calzada = $objetoModel->consultar($sqlCalzada);
            $numeroCalzada = pg_fetch_row($Calzada);

            $tra_codigo = $jerarquia_vial_id * 100000000000; // la jerarquia en el codigo es el primer digito
            $tra_codigo += $numeroEje[1] * 100000000000 / 10000; // el ejevial corresponde son los 4 digitos despues de la jerarquia
            $tra_codigo += $numeroCalzada[1] * 1000000; // la calzada es el quinto digito del codigo
            $tra_codigo += $elemento_id * 100000; //el elemento es el sexto digito del codigo
            $tra_codigo += $tra_segmento * 1000/1000; //el segmento ocupa los 5 digitos restantes de los 12

            
            $sql = "UPDATE tbl_tramo SET tra_codigo='".$tra_codigo."', 
            tra_segmento=".$tra_segmento.",
            tra_nomenclatura='".$tra_nomenclatura."',
            tra_nombre_via='".$tra_nombre_via."',
            calzada_id=".$calzada_id.",
            barrio_id=".$barrio_id.",
            elemento_id=".$elemento_id.", 
            jerarquia_vial_id=".$jerarquia_vial_id.", 
            eje_vial_id=".$eje_vial_id.", 
            usuario_id=".$usuario_id.", 
            tra_ancho_inicio=".$tra_ancho_inicio.",
            tra_ancho_fin=".$tra_ancho_fin." WHERE tra_id=".$tra_id."";

            $modificarTramo = $objetoModel->editar($sql);

            if($modificarTramo){
                echo "<script>"
                ."alert('El tramo se ha modificado satisfactoriamente');"
                ."</script>";

            }else{
                echo "<script>"
                ."alert('Error al modificar el tramo');"
                ."</script>";

                
            }
            
           redirect(getUrl("Tramo","Tramo","index"));

        }

        public function postDelete(){

            $objetoModel = new TramoModel();
            $tra_id = $_GET['tra_id'];
            $usuario_id = 1;

            //$usuario_id = $_SESSION['usu_id'];

            $sql = "UPDATE tbl_tramo set estado_id = 2, usuario_id=".$usuario_id." WHERE tra_id=".$tra_id."";

            $inhabilitar = $objetoModel->editar($sql);

            if($inhabilitar){
                echo "<script>"
                ."alert('El tramo se ha inhabilitado correctamente');"
                ."</script>";

            }else{
                echo "<script>"
                ."alert('Error al inhabilitar el tramo');"
                ."</script>";

                
            }

            redirect(getUrl("Tramo","Tramo","index"));

        }

        public function postActivate(){

            $objetoModel = new TramoModel();
            $tra_id = $_GET['tra_id'];
            $usuario_id = 1;

            //$usuario_id = $_SESSION['usu_id'];

            $sql = "UPDATE tbl_tramo set estado_id = 1, usuario_id=".$usuario_id." WHERE tra_id=".$tra_id."";

            $habilitar = $objetoModel->editar($sql);

            if($habilitar){
                echo "<script>"
                ."alert('El tramo se ha habilitado');"
                ."</script>";

            }else{
                echo "<script>"
                ."alert('Error al habilitar');"
                ."</script>";

                
            }

            redirect(getUrl("Tramo","Tramo","index"));

        }

    }
    

    
?>