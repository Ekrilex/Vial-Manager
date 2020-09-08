<?php 
    
    include_once '../Model/Deterioro/DeterioroModel.php';

    class DeterioroController{        
      public function getCreate(){
        $obj = new DeterioroModel();
        include_once '../View/Deterioro/registrar.php';
      }

      public function postCreate(){
        $obj = new DeterioroModel();
        $det_nombre=$_POST['det_nombre'];
        $det_tipo_deterioro=$_POST['det_tipo_deterioro'];
        $det_id=$obj->autoincrement("tbl_deterioro","det_id");
        $sql="INSERT INTO tbl_deterioro VALUES ('".$det_id."','".$det_nombre."','".$det_tipo_deterioro."')";
        $deterioro=$obj->insertar($sql);

        redirect(getUrl("Deterioro","Deterioro","getCreate"));        
      }
      
      public function getUpdate(){
        $obj = new DeterioroModel();
        $id=$_POST['id'];
        $sql="SELECT * FROM tbl_deterioro WHERE det_id=$id";
        $deterioro=$obj->consultar($sql);
        foreach ($deterioro as $det) {
        echo "<h3>Nombre:</h3><input type='text' name='nombre' class='form-control' value='".$det['det_nombre']."'><br>";
        echo "<h3>Tipo deterioro:</h3><input type='text' name='tipo' class='form-control' value='".$det['det_tipo_deterioro']."'><input type='hidden' name='id' value='".$det['det_id']."'>";       
        }
      }
      
      public function postUpdate(){
        $obj= new DeterioroModel();
        $id=$_POST['id'];
        $nombre=$_POST['nombre'];
        $tipo=$_POST['tipo'];
        $sql="UPDATE tbl_deterioro set det_nombre='".$nombre."' , det_tipo_deterioro='".$tipo."' WHERE det_id='".$id."'";
        $deterioro=$obj->editar($sql);
        redirect(getUrl("Deterioro","Deterioro","index"));            
      }

      
      public function getDelete(){
        $obj = new DeterioroModel();
        $id=$_POST['id'];
        $sql="SELECT * FROM tbl_deterioro WHERE det_id=$id";
        $deterioro=$obj->consultar($sql);
        foreach ($deterioro as $det) {
        echo "<h3>Nombre:</h3><input type='text' disabled name='nombre' class='form-control text-danger' value='".$det['det_nombre']."'><br>";
        echo "<h3>Tipo deterioro:</h3><input type='text' disabled name='tipo' class='form-control text-danger' value='".$det['det_tipo_deterioro']."'><input type='hidden' disable name='id' value='".$det['det_id']."'>"; 
        }
      }
      
      public function postDelete(){
        $obj= new DeterioroModel();
        $id=$_POST['id'];
        $sql="DELETE FROM tbl_deterioro WHERE det_id='".$id."'";
        $deterioro=$obj->eliminar($sql);
        redirect(getUrl("Deterioro","Deterioro","index"));            
      }

      public function index(){
      $obj = new DeterioroModel();
      $sql="SELECT * FROM tbl_deterioro";
      $deterioro =$obj->consultar($sql);      
      include_once '../View/Deterioro/consultar.php';
      }

      public function filtro(){
      $valor=$_POST['valor'];
      $obj= new DeterioroModel();
      $sql= "SELECT * FROM tbl_deterioro WHERE LOWER(det_nombre) LIKE LOWER('%".$valor."%')";
      $deterioro=$obj->consultar($sql);
      include_once '../view/Deterioro/filtro.php';  
      }



    }
?>