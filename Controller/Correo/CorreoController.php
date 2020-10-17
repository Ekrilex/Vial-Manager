<?php 
    
    include_once '../Model/Correo/CorreoModel.php';
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception; 

    require '../Web/assets/PHPMailer/Exception.php';
    require '../Web/assets/PHPMailer/PHPMailer.php';
    require '../Web/assets/PHPMailer/SMTP.php';            
    
    class CorreoController{
  
      public function postEmail(){
          
              $obj = new CorreoModel();
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
                      $correo=$obj->Personalizado($email2);
                    if ($usuario) {
                      $_SESSION['result']="Por favor revise el correo $correo en el encontrara la información de recuperación de cuenta.";
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


            public function preguntas(){
          
              $obj = new CorreoModel();
              $correo=$_POST['correo'];
              $nombre=$_POST['name'];
              $apellido=$_POST['apellido'];
              $asunto=$_POST['asunto'];
              $contenido=$_POST['message'];

      
                  $mail = new PHPMailer(true);
                  
                  /*try {
                  
                    $mail->SMTPOptions = array(
                      'ssl' => array(
                      'verify_peer' => false,
                      'verify_peer_name' => false,
                      'allow_self_signed' => true
                      )
                    );
                    */
                    try{
                            
                      $mail->SMTPDebug = 0;                      
                      $mail->isSMTP();                                            
                      $mail->Host       = 'smtp.gmail.com';                    
                      $mail->SMTPAuth   = true;                                  
                      $mail->Username   = 'vmanager2020@gmail.com';                   
                      $mail->Password   = 'SENA12345678VM';                               
                      $mail->SMTPSecure = 'tls';     
                      $mail->Port       = 587;                                 
                  
                      $mail->setFrom('vmanager2020@gmail.com', 'vialManager');
                      $mail->addAddress('vmanager2020@gmail.com', 'usuario');  

                      $mail->isHTML(true);                                  
                      $mail->Subject = 'preguntas';
                  
                      $mail->Body = '
                      <div style="margin:20px 50px;border:1px solid black;width:380px;font-family:verdana;">
                        <div style="text-align:center;background-color:blue;"><br>
                        <label style="color:white;font-size:23px;text-align:center;">pregunta generada</label><br><br>
                        </div><br><div style="margin:auto 40px;text-align:justify;font-size:18px;">
                        <strong>Usuario:</strong> <label> '.$nombre.' &nbsp;'.$apellido.'</label><br><br>
                          <strong>Correo: </strong><br><label>- '.$correo.'</label><br><br><strong>Pregunta:</strong><br><label> '.$contenido.'</label></div><br><h3 style="text-align:center;">vialManager</h3><br></div>';            
                  
                      $mail->send();
               
                       echo "<script type='text/javascript'>"

                       ."$('input[type=text], input[type=email], textarea').val('');"
        
                    ." swal('correo enviado', 'porfavor estar pendiente al correo electronico, se le enviara la  respuesta a su inquietud ', 'success');"

                    ."</script>";

                  } catch (Exception $e) {
                      echo "Mesaje no enviado. Mailer Error: {$mail->ErrorInfo}";
                  } 
                   
            }        
    }
?>