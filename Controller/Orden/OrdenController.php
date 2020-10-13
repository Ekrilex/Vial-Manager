<?php

  include_once '../Model/Orden/OrdenModel.php';

    class OrdenController {

    public function getCreate()
    {
    $obj = new OrdenModel();
    $sql="SELECT * FROM tbl_caso WHERE cas_disponibilidad = 0";
    $Caso=$obj->consultar($sql);
    include_once '../View/Orden/create.php';
    }

    public function postCreate()
    {
    $obj = new OrdenModel();
    $_SESSION['id'];
    $sel=$_POST['sel']; 
    $casos = explode(",", $sel);    
    
    $id=$obj->autoincrement("tbl_orden_mantenimiento","ord_id");
    $fecha_vencimiento=(Date("Y")+ 1) . "-" . Date("m") . "-" . Date("d");
    
    if ($sel!="") {
    
    $sql="INSERT INTO tbl_orden_mantenimiento VALUES(".$id.",'now()','".$fecha_vencimiento."', NULL ,".$_SESSION['id'].",'3')";
    $Orden=$obj->insertar($sql);
    }
     if ($Orden) {

     /////// insertar la orden a los casos
       for ($i=0; $i <count($casos); $i++) { 
       $sql="UPDATE tbl_caso set orden_id =".$id." , cas_disponibilidad='1' , estado_id='3' WHERE cas_id=".$casos[$i]."";
       $Casos=$obj->insertar($sql);
       }    
       alert("Orden de mantenimiento $id ha sido emitida");
     }else{
        print_r($Orden);
     }

    }

    public function imagen(){
    $obj = new OrdenModel();
    $id=$_POST['cas_id'];
    $sql="SELECT cas_fotografia_inicio FROM tbl_caso WHERE cas_id = '".$id."'";
    $Caso=$obj->consultar($sql);
     while ($cas=pg_fetch_assoc($Caso)) {        
      echo "<img src='".$cas['cas_fotografia_inicio']."' class='col-md-12'>";
      }

    }


    public function deterioros(){
    $obj = new OrdenModel();
    $id=$_POST['cas_id'];
    $sql="SELECT * FROM tbl_caso_deterioro AS cd , tbl_deterioro AS de WHERE cd.caso_id = '".$id."' AND cd.deterioro_id = det_id";
    $Caso=$obj->consultar($sql);
    //include_once '../View/Orden/deterioros.php';
      while ($cas=pg_fetch_assoc($Caso)) {        
        echo "<tr style='text-align:center;'>";
        echo "<td>".$cas['cas_det_id']."</td>";
        echo "<td>".$cas['det_nombre']."</td>";
        echo "<td>".$cas['det_tipo_deterioro']."</td>";
        echo "<td>".$cas['det_clasificacion']."</td>";
        echo "<td scope='col' style='text-align:center;'>".$cas['cas_det_area']."</td>";
        echo "</tr>";              
      }
    }


    public function index ()
    {
    $obj = new OrdenModel();
    $sql="SELECT * FROM tbl_orden_mantenimiento as o , tbl_usuario as u , tbl_estado as e WHERE usuario_id=u.usu_id AND o.estado_id=e.est_id AND e.est_id!=2";
    $Orden=$obj->consultar($sql);
    include_once '../View/Orden/index.php';

    }

    public function getUpdate(){
      $obj = new OrdenModel();

      $id=$_GET['ord_id'];

      $sql="SELECT * FROM tbl_orden_mantenimiento as o , tbl_usuario as u , tbl_estado as e WHERE usuario_id=u.usu_id AND o.estado_id=e.est_id AND ord_id=$id";
      $orden=$obj->consultar($sql);

      $sql="SELECT * FROM tbl_caso WHERE orden_id = $id OR cas_disponibilidad = 0";
      $CasoTabla=$obj->consultar($sql);
      
      include_once '../View/Orden/update.php';
    }

   
    public function postUpdate(){
      $obj = new OrdenModel();
      $_SESSION['id'];
      $id=$_POST['ord_id'];

      $sql="UPDATE tbl_orden_mantenimiento SET usuario_id=".$_SESSION['id']." WHERE ord_id='".$id."' ";
      $ca=$obj->consultar($sql);

      $sell=$_POST['sell'];
      $casos = explode(",", $sell);

      $sql="SELECT * FROM tbl_caso WHERE orden_id=".$id."";
      $casoNoDisponible=$obj->consultar($sql);

      while($cass=pg_fetch_assoc($casoNoDisponible)){

        $sql="UPDATE tbl_caso set orden_id =NULL , cas_disponibilidad='0' , estado_id='3' WHERE cas_id=".$cass['cas_id']."";
        $Casitos=$obj->insertar($sql);

      }
   
      for ($i=0; $i <count($casos); $i++) { 
          $sql="UPDATE tbl_caso set orden_id =".$id." , cas_disponibilidad='1' , estado_id='3' WHERE cas_id=".$casos[$i]."";
          $Casitos=$obj->insertar($sql);
      } 

    $casos = array();
    }

    public function getDelete()
    {
      $obj = new OrdenModel();
      $id=$_GET['ord_id'];

      $sql="SELECT * FROM tbl_orden_mantenimiento as o , tbl_usuario as u , tbl_estado as e WHERE usuario_id=u.usu_id  AND o.estado_id=e.est_id AND ord_id=$id";
      $orden=$obj->consultar($sql);

      $sql="SELECT * FROM tbl_caso WHERE orden_id =$id";
      $CasoTabla=$obj->consultar($sql);
      
      ///////////////////////////////////////////////////
      $sql="SELECT count(*) AS casos FROM tbl_caso WHERE orden_id=$id";
      $con=$obj->consultar($sql);
      
      while ($j=pg_fetch_assoc($con)) {
       $conta=$j['casos'];
       
      }

      $sql="SELECT count(*) AS estados FROM tbl_caso WHERE orden_id=$id AND estado_id='5'";
      $ordenn=$obj->consultar($sql);

      while ($or=pg_fetch_assoc($ordenn)) {
        $c=$or['estados'];
      }
      
      if($c==$conta || $c>2){
         $_SESSION['aprobar']="ok";
      }else if($c<$conta){
        $_SESSION['aprobar']="no";
      }
      ////////////////////////////////////////////////////
      include_once '../View/Orden/delete.php';
    }

    public function postDelete()
    {
      $obj = new OrdenModel();
      $_SESSION['id'];
      $id=$_POST['ord_id'];
      $justificacion=$_POST['justificacion'];
   
      $sql="SELECT * FROM tbl_caso WHERE orden_id=".$id."";      
      $casitos=$obj->editar($sql);

      $sql="UPDATE tbl_orden_mantenimiento SET usuario_id=".$_SESSION['id'].", estado_id='2' , ord_observacion='".$justificacion."' WHERE ord_id=".$id."";
      $ca=$obj->editar($sql);

      while($cas=pg_fetch_assoc($casitos)){
        $sql="UPDATE tbl_caso set orden_id = NULL , cas_disponibilidad='0' , estado_id='3' WHERE cas_id=".$cas['cas_id']."";
        $Casitos=$obj->editar($sql);
      }
      
  //  $casos = array();

    }



    public function historialOrd()
    {
      $obj = new OrdenModel();
      $sql="SELECT bit_id, bit_usuario, bit_fecha_modificacion,bit_tabla, bit_observacion, bit_casos FROM tbl_bitacora  WHERE bit_tabla='tbl_orden_mantenimiento' AND  bit_casos IS NOT NULL";
      $bitacora=$obj->consultar($sql);
      include_once '../View/Orden/HistorialOrden.php';

    }

    public function getDetalle()
    {
      $obj = new OrdenModel();

      $bit_id=$_GET['bit_id'];
     
      $sql="SELECT * FROM tbl_caso WHERE  cas_disponibilidad=0";
      $CasoTabla=$obj->consultar($sql);

      $sql="SELECT * FROM tbl_bitacora WHERE bit_id=$bit_id";
      $bitacora=$obj->consultar($sql);
      
     
       
      include_once '../View/Orden/Detalle.php';
       
      
     
    }

    public function postDetalle(){

      $obj = new OrdenModel();

      $id = $_POST['ord_id'];
      $fecha_vencimiento=(Date("Y")+ 1) . "-" . Date("m") . "-" . Date("d");

      $sql="UPDATE tbl_orden_mantenimiento set estado_id = '3', ord_fecha_vencimiento='".$fecha_vencimiento."' WHERE ord_id = $id";
      $Caso=$obj->editar($sql);      
  
      $sell=$_POST['sell'];
      $casos = explode(",", $sell);
      
      for ($i=0; $i <count($casos); $i++) { 
        $sql="UPDATE tbl_caso set orden_id =".$id." , cas_disponibilidad='1' , estado_id='3' WHERE cas_id=".$casos[$i]."";
        $Casitos=$obj->editar($sql);
       }       
  
        $sql="DELETE FROM tbl_bitacora WHERE bit_id_registro=$id";
        $bita=$obj->eliminar($sql);
        

    }
  
    public function aprobar(){

      $obj = new OrdenModel();

      $id = $_POST['ord_id'];
      $sql="UPDATE tbl_orden_mantenimiento set estado_id = '4' WHERE ord_id = $id";

      $orden=$obj->editar($sql);      
      
    }    

    public function finalizar(){

      $obj = new OrdenModel();

      $id = $_POST['ord_id'];
      $justificacion = $_POST['justificacion'];

      $sql="UPDATE tbl_orden_mantenimiento set estado_id = '5', ord_observacion='".$justificacion."' WHERE ord_id = $id";

      $orden=$obj->editar($sql);  

      $sql="SELECT * FROM tbl_caso WHERE orden_id=$id";
      $des=$obj->consultar($sql);

      while ($d=pg_fetch_assoc($des)) {
        
        if($d['estado_id']<5){
          $sql="UPDATE tbl_caso set orden_id =NULL , cas_disponibilidad='0' , estado_id='3' WHERE cas_id=".$d['cas_id']."";
          $ejecutar=$obj->editar($sql);
        }

      }
      

              
    } 




 }
?>