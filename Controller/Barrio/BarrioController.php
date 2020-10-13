<?php 
    include_once '../Model/Barrio/BarrioModel.php';

    class BarrioController{

        public function getCreate(){
            $objeto= new BarrioModel();

            $sql="SELECT b.bar_id, b.bar_descripcion, c.com_id, c.com_ubicacion FROM 
            tbl_barrio AS b, tbl_comuna AS c WHERE b.comuna_id=c.com_id";
            $barrios=$objeto->consultar($sql);

            $sql="SELECT * FROM tbl_comuna";
            $comunas=$objeto->consultar($sql);

            include_once '../View/Barrio/index.php';
            include_once '../View/Barrio/create.php';
            
        }

        public function postCreate(){
            $objeto= new BarrioModel();
           
            //Se crearon las decisiones en caso de que no se diligencien los campos
            $cont=0; $valida=0;
            $barrio=$_POST['bar_nombre'];
            if(!$barrio!=""){
               $_SESSION['errores']['nombre']="<span class='text-danger'>Debe diligenciar el campo nombre del barrio</span>";
               $cont++;
            }
            $sql="SELECT COUNT(*) AS valida FROM tbl_barrio WHERE bar_descripcion='".$barrio."'";
            $b=$objeto->consultar($sql);
            while($bb=pg_fetch_assoc($b)){
                $valida=$bb['valida'];   
            }

            if($valida>=1){
                $_SESSION['errores']['nombre']="<span class='text-danger'>Ya exite este barrio</span>";
                $cont++;
            }

            $comuna=$_POST['com'];
            if(!$comuna!=""){
               $_SESSION['errores']['comuna']="<span class='text-danger'>Debe seleccionar una comuna</span>";
               $cont++;
            }
            if($cont>0){
                $_SESSION['prueba']="Hola";
                redirect(getUrl("Barrio","Barrio","getCreate"));
            }else{
                $bar_id=$objeto->autoincrement("tbl_barrio","bar_id");

                $sql="INSERT INTO tbl_barrio VALUES($bar_id,'".$barrio."','".$comuna."')";
                $ejecucion=$objeto->insertar($sql);
    
                if($ejecucion){
                    $_SESSION['result']="El barrio <b>$barrio</b> se ha registrado correctamente";
                }
                redirect(getUrl("Barrio","Barrio","index"));
            }
        }
        

        public function index(){
            $objeto= new BarrioModel();
            
            $sql="SELECT b.bar_id, b.bar_descripcion, c.com_id, c.com_ubicacion FROM 
            tbl_barrio AS b, tbl_comuna AS c WHERE b.comuna_id=c.com_id";
            $barrios=$objeto->consultar($sql);

            $sql="SELECT * FROM tbl_comuna"; // meti esta consulta para que me desplegara las comunas en el modal de index(consultar)
            $comunas=$objeto->consultar($sql);

            $sql="SELECT barrio_id FROM tbl_tramo ";
            $tramo=$objeto->eliminar($sql);

            
            include_once '../View/Barrio/index.php';
            include_once '../View/Barrio/create.php';
            include_once '../View/Barrio/update.php';
        }

       
        public function getUpdate(){
            $objeto=new BarrioModel();

            $bar_id=$_POST['bar_id'];

            $sql="SELECT * FROM tbl_barrio WHERE bar_id=$bar_id";
            $barrios=$objeto->consultar($sql);

            $sql="SELECT * FROM tbl_comuna";
            $comunas=$objeto->consultar($sql);

            while($bar=pg_fetch_assoc($barrios)){
                //foreach($barrios as $bar){

                echo "<div class='form-group'>"
                    ."<h4 class='text-light'>ID de Barrio</h4>"
                        ."<input readonly class='form-control text-dark' type='text' name='bar_id' id='bar_id' value='".$bar['bar_id']."'>"
                    ."</div>";
                echo "<div class='form-group'>"
                    ."<h4 class='text-light'>Descripción o Nombre de Barrio</h4>"
                        ."<input  class='form-control is-valid barrioEditar' type='text' name='bar_descripcion'id='bar_descripcion' value='".$bar['bar_descripcion']."'>"
                        ."<div id='errorEdit'></div>"
                    ."</div>"; 
                echo "<div class='form-group'>";
                    echo "<h4 class='text-light'>N&uacute;mero de la Comuna</h4>" ;   
                        echo "<select class='form-control is-valid barrioSelect' name='com_id' id='com_id' value='".$bar['comuna_id']."'  >";
                        echo "<option value=''>Seleccione...</option>";
                        while($comun=pg_fetch_assoc($comunas)){
                        // foreach($comunas as $comun){
                            if($comun['com_id']==$bar['comuna_id']){
                                echo "<option value='".$comun['com_id']."' selected>".$comun['com_id']."</option>";
                            }else{
                                echo "<option value='".$comun['com_id']."'>".$comun['com_id']."</option>";
                               
                            }
                        }
                    echo "</select>";
                    echo "<div id='errorSelect'></div>";
                echo "</div>"; 
             
            }
           
        }

        public function postUpdate(){
            $objeto= new BarrioModel();
            @$bar_id=$_POST['bar_id'];//Trae el bar_id de getUpdate
         
            
            @$bar_descrip=$_POST['bar_descripcion'];
            @$com_id=$_POST['com_id'];
            
            $sql="UPDATE tbl_barrio SET bar_descripcion='".$bar_descrip."', comuna_id=$com_id WHERE bar_id=$bar_id";
            $ejecucion=$objeto->editar($sql);
            if($ejecucion){
                $_SESSION['resultEditar']="<span class='text-info'>Se edito el barrio <b>$bar_descrip</b> correctamente </span>";
            }
            redirect(getUrl("Barrio","Barrio","index"));
          
        }

        public function getDelete(){
            $objeto=new BarrioModel();

            $bar_id=$_GET['bar_id']; 
            
            $sql="SELECT * FROM tbl_barrio WHERE bar_id=$bar_id";
            $barrios=$objeto->consultar($sql);

            $sql="SELECT barrio_id FROM tbl_tramo";
            $tramo=$objeto->consultar($sql);

            
            // while($bar=pg_fetch_assoc($barrios)){
            // // foreach($barrios as $bar){
            //     echo "<div id='eliminarB'><input  type='hidden' name='barid' id='barid' value='".$bar['bar_id']."'>";
            //     echo "<input  type='hidden' name='bar_descripcion' id='bar_descripcion' value='".$bar['bar_descripcion']."'></div>";
            // }
        }

        public function postDelete(){
            $objeto= new BarrioModel();

            $bar_id=$_POST['barrioElimi'];
            $bar_descrip=$_POST['bar_descripcion'];

            $sql="DELETE FROM tbl_barrio WHERE bar_id=$bar_id";
            $ejecucion=$objeto->eliminar($sql);
            if($ejecucion){
                $_SESSION['resultEliminar']="<span class='text-danger'>Se elimino el barrio <b>$bar_descrip</b> correctamente </span>";
            }
          
            redirect(getUrl("Barrio","Barrio","index"));
            
        }


        /*public function filtro(){
            $objeto= new BarrioModel();

            $barrio=$_POST['barrio'];
            
            $sql="SELECT b.bar_id, b.bar_descripcion, c.com_ubicacion, c.com_id
            FROM tbl_barrio AS b, tbl_comuna AS c 
            WHERE b.comuna_id=c.com_id
            AND (LOWER(b.bar_descripcion) LIKE LOWER('%".$barrio."%') OR LOWER(c.com_ubicacion) LIKE LOWER('%".$barrio."%') OR c.com_id::varchar LIKE('%".$barrio."%'))";

            $barrios=$objeto->consultar($sql);
           
            $registros=pg_num_rows($barrios);
            // $registros=mysqli_num_rows($barrios);
            
            if($registros==0){
                echo"<br><div class=text-light>No se encontraron registros</div>";
            }else{
                include_once '../View/Barrio/filtro.php';
            }
        }*/


       
          
    }
?>