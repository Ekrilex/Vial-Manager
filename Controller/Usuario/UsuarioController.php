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

      include_once '../View/Usuario/registrar.php';
      }

      // Funcion que inserta la informacion en la base de datos
      public function postCreate(){
          $obj = new UsuarioModel();

          $pri_nombre = $_POST['primer_nombre'];
          $seg_nombre = $_POST['segundo_nombre'];
          $pri_apellido = $_POST['primer_apellido'];
          $seg_apellido = $_POST['segundo_apellido'];
          $tip_documento = $_POST['documento'];
          $num_documento = $_POST['numero_documento'];
          $correo = $_POST['Correo_electronico'];
          $telefono = $_POST['Telefono'];
          $rol = $_POST['rol'];
          $contra = $_POST['clave'];

          $nickname = $obj->genereteUser($pri_nombre,$pri_apellido);

          $query = "INSERT INTO tbl_usuario VALUES(NULL, $num_documento, '".$pri_nombre."', '".$seg_nombre."', '".$pri_apellido."', '".$seg_apellido."', '".$contra."', '".$telefono."', '".$correo."', '".$nickname."', $rol, 1, $tip_documento)";

          $ejecutar = $obj->insertar($query);

          if ($ejecutar) {
            redirect(getUrl("Usuario","Usuario","index"));
          } else {
            mysqli_error($ejecutar);
          }
      }

      // Funcion que realiza la consulta para plasmar los valores en la pagina en archivo de index.php
      public function index(){
          $obj = new UsuarioModel();

          $query = "SELECT u.usu_num_identificacion, u.usu_primer_nombre, u.usu_segundo_nombre, usu_primer_apellido, usu_segundo_apellido, usu_nickname, r.rol_nombre, e.est_descripcion FROM tbl_usuario AS u, tbl_rol AS r, tbl_estado AS e WHERE u.estado_id = e.est_id AND u.rol_id = r.rol_id";
              
          $usuarios = $obj->consultar($query);

          include_once('../view/Usuario/index.php');
      }

      // Funcion que altera el estado de un usuario a inactivo
      public function deleteUsuario(){
          $obj = new UsuarioModel();

          $user = $_POST['usu_num_identificacion'];

          $query = "UPDATE tbl_usuario SET estado_id = 2 WHERE usu_num_identificacion = $user";
              
          $ejecucion = $obj->editar($query);

          if (!$ejecucion) {
            mysqli_error($ejecucion);
          } else {
            redirect(getUrl("Usuario","Usuario","index"));
          }
      }

      // Funcion que realiza la consulta para plasmar los valores en la pagina en archivo de update.php
      public function getUpdate(){
        $obj = new UsuarioModel();

        $user = $_GET['usu_id'];

        $query = "SELECT u.usu_num_identificacion, u.usu_primer_nombre, u.usu_segundo_nombre, usu_primer_apellido, usu_segundo_apellido, u.usu_telefono, u.usu_correo, r.rol_nombre, e.est_descripcion FROM tbl_usuario AS u, tbl_rol AS r, tbl_estado AS e WHERE u.estado_id = e.est_id AND u.rol_id = r.rol_id AND u.usu_num_identificacion = $user";
        $query2 = "SELECT * FROM tbl_rol";
        $query3 = "SELECT * FROM tbl_tipo_documento";

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

      // Funcion que altera el estado de un usuario a activo
      public function activationUser(){

        $obj = new UsuarioModel();

        $user = $_POST['usu_num_identificacion2'];

        $query = "UPDATE tbl_usuario SET estado_id = 1 WHERE usu_num_identificacion = $user";

        $ejecucion = $obj->editar($query);

        if ($ejecucion) {
          redirect(getUrl("Usuario","Usuario","index"));
        } else {
          mysqli_error($ejecucion);
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