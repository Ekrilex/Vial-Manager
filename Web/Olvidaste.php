<?php
    session_start();
   
    session_destroy();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Recuperar Contraseña</title>
        <link rel="stylesheet" href="assets/css/login.css">
        <!-- CSS Files -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/atlantis.min.css">
        
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <script src="assets/js/core/global.js"></script>
        <script src="assets/js/core/jquery.3.2.1.min.js"></script>
	    <script src="assets/js/core/bootstrap.min.js"></script>

        <!-- Fonts and icons -->
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
       
            <div class="col-md-15 formu">
            <img src="assets/img/iconos/avatardefault_92824.ico" id="iconop">
            <h1 class="text-center text-light display-5" ><b>Recuperar Contraseña<b></h1><br>
                <form action="#" method="POST" name="login">
                    <label for="exampleInputEmail1" class="text-light">Email</label>
                    <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark">
                                <i class="flaticon-envelope-1 text-white"></i>
                                </span>
                            </div>
                        <input type="email" class="form-control bg-dark text-light correo" name="correo" id="correo" placeholder="correo electrónico" maxlength="35">
                    </div>
                   
                   <br><br>     
                    <input type="submit" value="Enviar" name="enviar" class="btn btn-info btn-block">

                <div class="text-center">  
                    <a class="btn btn-success btn-link " href="login.php"><b>Regresar</b></a><br>
                </div>
              
                </form>
            </div>
        </div>
    </body>
</html>