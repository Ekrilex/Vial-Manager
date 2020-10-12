<?php
    session_start();
   
    session_destroy();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>INICIO DE SESI&Oacute;N</title>
        <link rel="stylesheet" href="assets/css/login.css">
        <!-- CSS Files -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/atlantis.min.css">
        
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link rel="stylesheet" href="assets/css/demo.css">
        <!-- Fonts and icons -->
        <script src="assets/js/core/jquery.3.2.1.min.js"></script>
        <script src="assets/js/core/bootstrap.min.js"></script>
        <script src="assets/js/plugin/webfont/webfont.min.js"></script>
        <script>
            WebFont.load({
                google: {"families":["Lato:300,400,700,900"]},
                custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['assets/css/fonts.min.css']},
                active: function() {
                    sessionStorage.fonts = true;
                }
            });
        </script>   
    
    </head>
    <center><body class="fondo">
        <div class="container">

         <?php
           if (isset($_SESSION['result'])) {
          ?>
         <script type="text/javascript">$( document ).ready(function() {$('#ventana').modal('toggle')});</script>
          <div class="modal" id="ventana">
            <div class="modal-dialog" role="document">
              <div class="modal-content text-center">
               <div class="modal-header">
                 <h4><strong>¡Correo enviado!</strong></h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                 </button>
               </div>
              <div class="modal-body">
                <p><?php echo $_SESSION['result']; ?></p>
                <p>Vial Manager</p>              
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
              </div>           
            </div>
          </div>
        </div>
       <?php
         } unset($_SESSION['result']); 
       ?>               
        
           <div class="formu">
            <img src="assets/img/iconos/sena.png" style="border-radius:6em" id="iconop">
            <h1 class="text-center text-light display-5" ><b>Login<b></h1><br>
                <form action="index.php" method="POST" name="login">
              
                    <label class="font-weight-bold text-light ">Nickname</label>
                    <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-warning">
                                <i class="far fa-user font-weight-bold" style="color:black"></i>
                                </span>
                            </div>
                        <input type="text" class="form-control bg-warning font-weight-bold" style="color:black"name="user" id="user" placeholder="nombre de usuario" maxlength="20">
                    </div>
                   
                   <br>
                    <label class="font-weight-bold text-light">Password</label>
                    <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-warning">
                                <i class="icon-lock font-weight-bold"  style="color:black"></i><!--icon-lock fas fa-user-lock-->
                                </span>
                            </div>
                        <input type="password" class="form-control bg-warning font-weight-bold" style="color:black" name="clave" id="clave" placeholder="contraseña" maxlength="20">
                    </div>
                   
                   <br><br>     
                    <input type="submit" value="Iniciar Sesión" name="enviar" style="color:white;background-color: rgb(236, 92, 26);" class="font-weight-bold btn btn-block">

                <div class="text-center">  
                    <a class="btn  btn-link " style="color:white" href="Olvidaste.php"><b>¿Olvidaste tu Contraseña?</b></a><br>
                    <a class="btn btn-link " style="color:white" href="#"><b>Volver</b></a><br>
                </div>
              
                </form>
            </div>
        </div>
    </body>
</html>