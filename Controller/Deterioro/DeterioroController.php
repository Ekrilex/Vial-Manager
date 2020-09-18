<?php 
    
    include_once '../Model/Deterioro/DeterioroModel.php';

    class DeterioroController{        


    public function postCreate(){
    
    $obj = new DeterioroModel();
    @$det_nombre=$_POST['det_nombre'];
    @$det_id=$obj->autoincrement("tbl_deterioro","det_id");
    @$tipo=$obj->validaTipo($_POST['det_tipo_deterioro']);    
    @$clasi=$obj->validaClasi($_POST['det_clasificacion']);
 
    $sql="SELECT count(*) AS igual FROM tbl_deterioro WHERE det_nombre='".$det_nombre."'";
    $n=$obj->consultar($sql);
    while ($nn=pg_fetch_assoc($n)) {
    $igual=$nn['igual']; 
    }    
    
    $Rect=$obj->Rect($det_nombre,$tipo,$clasi,$igual);
  
      if ($Rect==0) {
      $sql="INSERT INTO tbl_deterioro VALUES ('".$det_id."','".$det_nombre."','".$tipo."','".$clasi."')";
      $deterioro=$obj->insertar($sql);
      $_SESSION['result']['correcto']="<h3 class='text-primary'>Se ha registrado correctamente el deterioro:&nbsp;&nbsp;$det_nombre&nbsp;&nbsp;<span class='icon-like text-success'></span></h3>";   
      }

     if (isset($_SESSION['result'])) { 
       echo "<div class='container'>
             <div class='alert alert-primary alert-dismissible fade show' role='alert'>";
             foreach ($_SESSION['result'] as $result => $res) { echo $res; } 
       echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button></div><br><br>"; } unset($_SESSION['result']);        
    }


    public function getUpdate(){
    $obj = new DeterioroModel();
    $id=$_POST['id'];
    $sql="SELECT * FROM tbl_deterioro WHERE det_id=$id";
    $deterioro=$obj->consultar($sql);
    $tiposs=$obj->Tipos();
    $clasi=$obj->Clasificacion();

      while ($det=pg_fetch_assoc($deterioro)) {        
       echo "<h5>Nombre:</h5><input type='text' name='nombre' class='form-control border border-primary nombred' value='".$det['det_nombre']."'><div id='errord'></div><input type='hidden' name='id' value='".$det['det_id']."'><div id='errord'></div><br>";
       echo "<h5>Tipo deterioro:</h5>"; 
       echo "<select name='det_tipo_deterioro' class='form-control border border-primary'>";
        foreach ($tiposs as $key => $tip) {
           
         if ($tip==$det['det_tipo_deterioro']) {
             $selected="selected";
         }else{
             $selected="";
          }
           echo "<option value='".$tip."' $selected>".$tip."</option>";
        }   
       echo "</select><br>";

       echo "<h5>Clasificación:</h5>"; 
       echo "<select name='det_clasificacion' class='form-control border border-primary'>";
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
     $sql="SELECT count(*) AS igual FROM tbl_deterioro WHERE det_nombre='".$nombre."'";
    $n=$obj->consultar($sql);
    while ($nn=pg_fetch_assoc($n)) {
    $igual=$nn['igual']; 
    }  

    $tipo=$obj->validaTipo($_POST['det_tipo_deterioro']);
    $clasi=$obj->validaClasi($_POST['det_clasificacion']);
    $Rect=$obj->Rect($nombre,$tipo,$clasi,$igual);
       
       if ($Rect==0) {
        $sql="UPDATE tbl_deterioro set det_nombre='".$nombre."' , det_tipo_deterioro='".$tipo."' , det_clasificacion='".$clasi."' WHERE det_id='".$id."'";
        $deterioro=$obj->editar($sql);
        $_SESSION['result']['valido']="¡Registro actualizado!";
      }

              redirect(getUrl("Deterioro","Deterioro","index"));    

    }


    public function getDelete(){
    $obj = new DeterioroModel();
    $id=$_POST['id'];
    $sql="SELECT * FROM tbl_deterioro WHERE det_id=$id";
    $deterioro=$obj->consultar($sql);
      while ( $det=pg_fetch_assoc($deterioro)) { 
       echo "<h5>Nombre:</h5><input type='text' disabled name='nombre' class='form-control text-danger border border-danger' value='".$det['det_nombre']."' id='nombred'><div id='errord'></div><br>";
       echo "<h5>Tipo deterioro:</h5><input type='text' disabled name='tipo' class='form-control text-danger border border-danger' value='".$det['det_tipo_deterioro']."'><br>";
       echo "<h5>Clasificación:</h5><input type='text' disabled name='clas' class='form-control text-danger border border-danger' value='".$det['det_clasificacion']."'><input type='hidden' disable name='id' value='".$det['det_id']."'>"; 
      }
    }
    

    public function postDelete(){
    $obj= new DeterioroModel();
    $id=$_POST['id'];
    $sql="DELETE FROM tbl_deterioro WHERE det_id='".$id."'";
    $deterioro=$obj->eliminar($sql);
    $_SESSION['result']['valido']="¡Registro eliminado!";      
    redirect(getUrl("Deterioro","Deterioro","index"));            
    }


    public function index(){
      $obj = new DeterioroModel(); 
      $tiposs=$obj->Tipos();
      $clasi=$obj->Clasificacion();     
      $sql="SELECT * FROM tbl_deterioro ORDER BY det_id asc";
      $deterioro =$obj->consultar($sql);      
      include_once '../View/Deterioro/consultar.php';
    }


   /* public function filtro(){
    $valor=$_POST['valor'];
    $obj= new DeterioroModel();
    $sql= "SELECT * FROM tbl_deterioro WHERE LOWER(det_nombre) LIKE LOWER('%".$valor."%') OR LOWER(det_tipo_deterioro) LIKE LOWER('%".$valor."%')";
    $deterioro=$obj->consultar($sql);
    $datos=pg_num_rows($deterioro);
      if ($datos==0) {
       echo "<br><td colspan='5'><span class='icon-information text-warning'></span>&nbsp;&nbsp;No se encontraron resultados</td>";
      }else{
      include_once '../view/Deterioro/filtro.php';  
      }
    }*/

}

?>