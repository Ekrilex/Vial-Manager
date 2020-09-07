<?php 
    
    include_once '../Model/Usuario/UsuarioModel.php';
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception; 
    require '../Web/assets/PHPMailer/Exception.php';
    require '../Web/assets/PHPMailer/PHPMailer.php';
    require '../Web/assets/PHPMailer/SMTP.php';            
    
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



      public function postEmail(){
          
              $obj = new UsuarioModel();
              $email1=$_POST['correo'];
          
              if (!$email1!="") {
                $_SESSION['errores']['correo']="Debe diligenciar el correo";

                  echo "<script type='text/javascript'>"
        
                  ."window.location.href='../web/Olvidaste.php'"

                  ."</script>";

              }else{             
      
              $sql="SELECT * FROM tbl_usuario WHERE usu_correo = '".$email1."'"; 
              $usuario=$obj->consultar($sql);
          
              foreach ($usuario as $usu){
                  $email2=$usu['usu_correo'];
                  $pass=$usu['usu_contraseña'];
                  $nickname=$usu['usu_nickname'];         
              }
      
              if (isset($email2)){
      
                  $mail = new PHPMailer(true);
                  
                  try {
                  
                    $mail->SMTPOptions = array(
                      'ssl' => array(
                      'verify_peer' => false,
                      'verify_peer_name' => false,
                      'allow_self_signed' => true
                      )
                    );
                            
                      $mail->SMTPDebug = 0;                      
                      $mail->isSMTP();                                            
                      $mail->Host       = 'smtp.gmail.com';                    
                      $mail->SMTPAuth   = true;                                  
                      $mail->Username   = 'pruebavialmanager123@gmail.com';                   
                      $mail->Password   = 'sena12345678';                               
                      $mail->SMTPSecure = 'tls';     
                      $mail->Port       = 587;                                 
                  
                      $mail->setFrom('pruebavialmanager123@gmail.com', 'vialManager');
                      $mail->addAddress($email2, 'usuario');  

                      $mail->isHTML(true);                                  
                      $mail->Subject = 'Recuperar cuenta';
                  
                      $mail->Body = '
                      <div style="margin:20px 50px;border:1px solid black;width:380px;font-family:verdana;">
                        <div style="text-align:center;background-color:black;"><br>
                        <label style="color:white;font-size:23px;text-align:center;">¡Hola Usuario!</label><br><br>
                        </div><br><div style="margin:auto 40px;text-align:justify;font-size:18px;">
                        <strong style="font-family:cursive;color:red;">Estas son tus credenciales de ingreso al sistema:</strong><br><br>
                          <strong>User: </strong><br><label>- '.$nickname.'</label><br><br><strong>Pass: '.$pass.'</strong></div><br><h3 style="text-align:center;">vialManager</h3><br></div>';            
                  
                      $mail->send();
                      $c1=substr($email2,0,3);
                      $c2 = strstr($email2, '@');
                      $cor=$c1."******".$c2;

                    if ($usuario) {
                      $_SESSION['result']="Por favor revise el correo $cor en el encontrara la información de recuperación de cuenta.";
                    }

                    echo "<script type='text/javascript'>"
        
                    ."window.location.href='../web/login.php'"

                    ."</script>";
                    
                  } catch (Exception $e) {
                      echo "Mesaje no enviado. Mailer Error: {$mail->ErrorInfo}";
                  }
                  
                  }else{

                    $_SESSION['errores']['correo']="Correo invalido";              
                    
                      echo "<script type='text/javascript'>"
        
                      ."window.location.href='../web/Olvidaste.php'"

                      ."</script>";                  
                  }       
              }
            }        


    }
?>