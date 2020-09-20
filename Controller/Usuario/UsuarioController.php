<?php 
    
    include_once '../Model/Usuario/UsuarioModel.php';        
    
    class UsuarioController{
    
      
      // Funcion que realiza la consulta para plasmar los valores en la pagina en archivo de registro.php
      public function getCreate(){

      $obj = new UsuarioModel();

      $queryDoc = "SELECT * FROM tbl_tipo_documento";
      $queryRol = "SELECT * FROM tbl_rol";

      $documentos = $obj->consultar($queryDoc);
      $roles = $obj->consultar($queryRol);

      if ($documentos && $roles) {
        include_once '../View/Usuario/registrar.php';
      } else {
        pg_last_error($documentos);
      }

      }

      // Funcion que inserta la informacion en la base de datos
      public function postCreate(){

          $obj = new UsuarioModel();
          $count = 0;

          $pri_nombre = $_POST['primer_nombre'];

          if (!$pri_nombre!="") {
            $_SESSION['errores']['pri_nombre']="Ingrese el primer nombre";
            $count++;
          }
          
          $seg_nombre = $_POST['segundo_nombre'];

          if (!$seg_nombre!="") {
            $_SESSION['errores']['seg_nombre']="Ingrese el segundo nombre";
            $count++;
          }
          
          $pri_apellido = $_POST['primer_apellido'];

          if (!$pri_apellido!="") {
            $_SESSION['errores']['pri_apellido']="Ingrese el primer apellido";
            $count++;
          }
          
          $seg_apellido = $_POST['segundo_apellido'];

          if (!$seg_apellido!="") {
            $_SESSION['errores']['seg_apellido']="Ingrese el segundo apellido";
            $count++;
          }
          
          $tip_documento = $_POST['documento'];

          if (!$tip_documento!="") {
            $_SESSION['errores']['tip_documento']="Seleccione el tipo de documento";
            $count++;
          }
          
          $num_documento = $_POST['numero_documento'];

          if (!$num_documento!="") {
            $_SESSION['errores']['num_documento']="Ingrese el tipo de documento";
            $count++;
          }
          
          $correo = $_POST['Correo_electronico'];

          if (!$correo!="") {
            $_SESSION['errores']['correo']="Ingrese el correo";
            $count++;
          }
          
          $telefono = $_POST['Telefono'];

          if (!$telefono!="") {
            $_SESSION['errores']['telefono']="Ingrese el numero de telefono";
            $count++;
          }
          
          $rol = $_POST['rol'];

          if (!$rol!="") {
            $_SESSION['errores']['rol']="Seleccione el tipo de rol";
            $count++;
          }
          
          $contra = $_POST['clave'];

          if (!$contra!="") {
            $_SESSION['errores']['pass1']="Ingrese la contraseña";
            $count++;
          }

          $contra2 = $_POST['clave2'];

          if (!$contra2!="") {
            $_SESSION['errores']['pass2']="Confirme la contraseña";
            $count++;
          }

          if ($contra!=$contra2) {
            $_SESSION['errores']['confir']="Las contraseñas no coinciden";
            $count++;
          }

          if ($count>0) {
              redirect(getUrl("Usuario","Usuario","getCreate"));
          }

          $nickname = $obj->genereteUser($pri_nombre,$pri_apellido);
          $id = $obj->autoincrement("tbl_usuario","usu_id"); 

          $query = "INSERT INTO tbl_usuario VALUES($id, $num_documento, '".$pri_nombre."', '".$seg_nombre."', '".$pri_apellido."', '".$seg_apellido."', '".$contra."', '".$telefono."', '".$nickname."', '".$correo."', $rol, 1, $tip_documento)";

          $ejecutar = $obj->insertar($query);

          if ($ejecutar) {
            redirect(getUrl("Usuario","Usuario","index"));
          } else {
            pg_last_error($ejecutar);
          }
      }

      // Funcion que realiza la consulta para plasmar los valores en la pagina en archivo de index.php
      public function index(){
          $obj = new UsuarioModel();

          $query = "SELECT u.usu_num_identificacion, u.usu_primer_nombre, u.usu_segundo_nombre, usu_primer_apellido, usu_segundo_apellido, usu_nickname, r.rol_id,  r.rol_nombre, t.tip_id, e.est_descripcion, e.est_id FROM tbl_usuario AS u, tbl_rol AS r, tbl_estado AS e, tbl_tipo_documento AS t WHERE u.estado_id = e.est_id AND u.rol_id = r.rol_id AND u.tipo_documento_id = t.tip_id";
              
          $usuarios = $obj->consultar($query);

          include_once('../view/Usuario/index.php');
      }

      // Funcion que altera el estado de un usuario a inactivo
      public function deleteUsuario(){
          $obj = new UsuarioModel();

          $user = $_POST['value'];

          $query = "UPDATE tbl_usuario SET estado_id = 2 WHERE usu_num_identificacion = '".$user."' ";
              
          $ejecucion = $obj->editar($query);

          if (!$ejecucion) {
            pg_last_error($ejecucion);
          } else {
            // redirect(getUrl("Usuario","Usuario","index"));
          }
      }

      // Funcion que realiza la consulta para plasmar los valores en la pagina en archivo de update.php
      public function getUpdate(){
        $obj = new UsuarioModel();

        $user = $_GET['usu_id'];
        $rol = $_GET['rol_id'];
        $tip_documento = $_GET['tip_id'];

        $query = "SELECT u.usu_id, u.usu_num_identificacion, u.usu_primer_nombre, u.usu_segundo_nombre, usu_primer_apellido, usu_segundo_apellido, u.usu_telefono, u.usu_correo, u.rol_id, u.tipo_documento_id, r.rol_nombre, t.tip_descripcion, e.est_descripcion FROM tbl_usuario AS u, tbl_rol AS r, tbl_estado AS e, tbl_tipo_documento AS t WHERE u.estado_id = e.est_id AND u.rol_id = r.rol_id AND u.tipo_documento_id = t.tip_id AND u.usu_num_identificacion = '".$user."'";
        $query2 = "SELECT * FROM tbl_rol WHERE rol_id != $rol";
        $query3 = "SELECT * FROM tbl_tipo_documento WHERE tip_id != $tip_documento";

        $users = $obj->consultar($query);
        $roles = $obj->consultar($query2);
        $documentos = $obj->consultar($query3);

        if ($users && $roles && $documentos) {
          include_once('../view/Usuario/update.php');
        } else {
          mysqli_error($users);
        }

        include_once('../view/Usuario/update.php');
      }

      public function postUpdate(){

        $obj = new UsuarioModel();

        $id = $_POST['id'];
        $pri_nombre = $_POST['primer_nombre'];
        $seg_nombre = $_POST['segundo_nombre'];
        $pri_apellido = $_POST['primer_apellido'];
        $seg_apellido = $_POST['segundo_apellido'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $identificacion = $_POST['numero_documento'];
        $tip_documento = $_POST['tipo_documento'];
        $rol = $_POST['rol'];

        $query = "UPDATE tbl_usuario SET usu_num_identificacion = '".$identificacion."', usu_primer_nombre = '".$pri_nombre."', usu_segundo_nombre = '".$seg_nombre."', usu_primer_apellido = '".$pri_apellido."', usu_segundo_apellido = '".$seg_apellido."', usu_correo = '".$correo."', usu_telefono = '".$telefono."', rol_id = $rol, tipo_documento_id = $tip_documento WHERE usu_id = $id ";

        $ejecucion = $obj->editar($query);

        if ($ejecucion) {
          redirect(getUrl("Usuario","Usuario","index"));
        } else {
          pg_last_error($ejecucion);
        }
        
      }

      // Funcion que altera el estado de un usuario a activo
      public function activationUser(){

        $obj = new UsuarioModel();

        $user = $_POST['value'];

        $query = "UPDATE tbl_usuario SET estado_id = 1 WHERE usu_num_identificacion = '".$user."'";

        $ejecucion = $obj->editar($query);

        if ($ejecucion) {
          redirect(getUrl("Usuario","Usuario","index"));
        } else {
          pg_last_error($ejecucion);
        }

      }
      
      public function filtro(){
        $users = $_POST['value'];

        $obj = new UsuarioModel();

        $query = "SELECT u.usu_num_identificacion, u.usu_primer_nombre, u.usu_segundo_nombre, usu_primer_apellido, usu_segundo_apellido, usu_nickname, r.rol_id,  r.rol_nombre, t.tip_id, e.est_descripcion FROM tbl_usuario AS u, tbl_rol AS r, tbl_estado AS e, tbl_tipo_documento AS t WHERE u.estado_id = e.est_id AND u.rol_id = r.rol_id AND u.tipo_documento_id = t.tip_id AND (LOWER(r.rol_nombre) LIKE LOWER('%".$users."%') OR LOWER(e.est_descripcion) LIKE LOWER('%".$users."%'))";

        $usuarios = $obj->consultar($query);

        if ($usuarios) {
          include_once '../view/Usuario/filtro.php';
        } else {
          pg_last_error($usuarios);
        }

      }

      // Funcion para validar si un correo se encuentra disponible.
      public function mailCheck(){

        $obj = new UsuarioModel();
        $mail = $_POST['value'];
        $query = "SELECT usu_correo FROM tbl_usuario WHERE usu_correo = '". $mail ."' ";
        $eject = $obj->consultar($query);
        $count = pg_num_rows($eject);

        if ( $eject ) {
          if ($count > 0) {
            echo "<i class='fas fa-times'></i> Correo electronico no disponible";
          } else {
            echo "<i class='fas fa-check-circle'></i> Correo electronico disponible ";
          }
        } else {
          pg_last_error( $eject );
        }
        

      }

       public function getPerfil(){
        $obj = new UsuarioModel();
        $_SESSION['id']="1";
        $sql="SELECT * FROM  tbl_usuario as u , tbl_rol  as r, tbl_tipo_documento as d WHERE usu_id = '".$_SESSION['id']."' and u.rol_id = r.rol_id and d.tip_id = u.tipo_documento_id";
        $Usuario=$obj->consultar($sql);
        include_once '../View/Usuario/mi_perfil.php';
       }

       public function postPerfil(){
        $obj = new UsuarioModel();
        $correo=$_POST['correo2'];
        $clave1=$_POST['clave1'];
        $clave2=$_POST['clave2'];
           
        if ($correo=="" || $clave2=="" || $clave1=="" || $clave1!=$clave2) { 
             $_SESSION['error']="Datos invalidos, Debe diligenciar correctamente los campos";             
            redirect(getUrl("Usuario","Usuario","getPerfil"));                     
        }else{

          $val="/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/";         
          
          if (preg_match($val, $correo)) {
            $sql="UPDATE tbl_usuario set usu_correo='".$correo."', usu_contrasena='".$clave1."' WHERE usu_id='".$_SESSION['id']."'";
            $Usuario=$obj->editar($sql);
            redirect(getUrl("Usuario","Usuario","getPerfil"));           
          }else{
            $_SESSION['error']="Email invalido , no se guardo cambios";           
            redirect(getUrl("Usuario","Usuario","getPerfil"));                  
          }
        }
      }             

  }
?>