<?php 
    
    include_once '../Model/Deterioro/DeterioroModel.php';

    class DeterioroController{        
    public function getCreate(){
    $obj = new DeterioroModel();
    $tiposs=$obj->Tipos();
    $clasi=$obj->Clasificacion();
    include_once '../View/Deterioro/registrar.php';
    }

    public function postCreate(){
    $obj = new DeterioroModel();
    $det_nombre=$_POST['det_nombre'];
    $det_id=$obj->autoincrement("tbl_deterioro","det_id");
    $tipo=$obj->validaTipo($_POST['det_tipo_deterioro']);
    $clasi=$obj->validaClasi($_POST['det_clasificacion']);
    $Rect=$obj->Rect($det_nombre,$tipo,$clasi);
      if ($Rect>0) {
        redirect(getUrl("Deterioro","Deterioro","getCreate"));             
      }else{    

      $sql="INSERT INTO tbl_deterioro VALUES ('".$det_id."','".$det_nombre."','".$tipo."','".$clasi."')";
      $deterioro=$obj->insertar($sql);
      $_SESSION['result']['correcto']="<h3 class='text-primary'>Se ha registrado correctamente el deterioro:&nbsp;&nbsp;$det_nombre&nbsp;&nbsp;<span class='icon-like text-success'></span></h3>";
        redirect(getUrl("Deterioro","Deterioro","getCreate"));   
      }
    
    }

    public function getUpdate(){
      $obj = new DeterioroModel();
      $id=$_POST['id'];
      $sql="SELECT * FROM tbl_deterioro WHERE det_id=$id";
      $deterioro=$obj->consultar($sql);
      $tiposs=$obj->Tipos();
      $clasi=$obj->Clasificacion();

      while ($det=pg_fetch_assoc($deterioro)) {        
       echo "<h3>Nombre:</h3><input type='text' name='nombre' class='form-control nombred' value='".$det['det_nombre']."'><div id='errord'></div><input type='hidden' name='id' value='".$det['det_id']."'><br>";
       echo "<h3>Tipo deterioro:</h3>"; 
      echo "<select name='det_tipo_deterioro' class='form-control'>";
      foreach ($tiposs as $key => $tip) {
           
        if ($tip==$det['det_tipo_deterioro']) {
            $selected="selected";
        }else{
            $selected="";
        }
        echo "<option value='".$tip."' $selected>".$tip."</option>";
        }   
      echo "</select><br>";

      echo "<h3>Clasificación:</h3>"; 
       echo "<select name='det_clasificacion' class='form-control'>";
          foreach ($clasi as $key => $cla) {
           
           if ($cla==$det['det_clasificacion']) {
             $selected="selected";
           }else{
             $selected="";
           }
            echo "<option value='".$cla."' $selected>".$cla."</option>";
          }   
          echo "</select>";
       }  

      }   
     
    public function postUpdate(){
      $obj= new DeterioroModel();
      $id=$_POST['id'];
      $nombre=$_POST['nombre'];

      $tipo=$obj->validaTipo($_POST['det_tipo_deterioro']);
      $clasi=$obj->validaClasi($_POST['det_clasificacion']);
      $Rect=$obj->Rect($nombre,$tipo,$clasi);
       if ($Rect>0) {
        redirect(getUrl("Deterioro","Deterioro","index"));
        $_SESSION['result']="¡Error en el momento de diligenciar los campos , por favor intente de nuevo!";

       }else{    

      $sql="UPDATE tbl_deterioro set det_nombre='".$nombre."' , det_tipo_deterioro='".$tipo."' , det_clasificacion='".$clasi."' WHERE det_id='".$id."'";
      $deterioro=$obj->editar($sql);
      redirect(getUrl("Deterioro","Deterioro","index"));  
        $_SESSION['result']="¡Registro actualizado!";
      }

    }

    public function getDelete(){
      $obj = new DeterioroModel();
      $id=$_POST['id'];
      $sql="SELECT * FROM tbl_deterioro WHERE det_id=$id";
      $deterioro=$obj->consultar($sql);
      while ( $det=pg_fetch_assoc($deterioro)) { 
       echo "<h3>Nombre:</h3><input type='text' disabled name='nombre' class='form-control text-danger nombred' value='".$det['det_nombre']."'><div id='errord'></div><br>";
       echo "<h3>Tipo deterioro:</h3><input type='text' disabled name='tipo' class='form-control text-danger' value='".$det['det_tipo_deterioro']."'><br>";
       echo "<h3>Clasificación:</h3><input type='text' disabled name='clas' class='form-control text-danger' value='".$det['det_clasificacion']."'><input type='hidden' disable name='id' value='".$det['det_id']."'>"; 
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
    $sql="SELECT * FROM tbl_deterioro ORDER BY det_id asc";
    $deterioro =$obj->consultar($sql);      
    include_once '../View/Deterioro/consultar.php';
    }

    public function filtro(){
     $valor=$_POST['valor'];
     $obj= new DeterioroModel();
     $sql= "SELECT * FROM tbl_deterioro WHERE LOWER(det_nombre) LIKE LOWER('%".$valor."%') OR LOWER(det_tipo_deterioro) LIKE LOWER('%".$valor."%')";
     $deterioro=$obj->consultar($sql);
     $datos=pg_num_rows($deterioro);
     if ($datos==0) {
       echo "<br><td class='text-light'>No se encontraron registros</td>";
     }else{
     include_once '../view/Deterioro/filtro.php';  
     }

    }

    }
?>