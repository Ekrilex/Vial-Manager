<?php
    session_start();
   include_once '../Lib/Helpers.php';
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
        <script src="assets/js/core/jquery.3.2.1.min.js"></script>
        <script src="assets/js/core/bootstrap.min.js"></script>
        <script src="assets/js/core/global.js"></script>

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
            <img src="assets/img/iconos/sena.png" style="border-radius:6em" id="iconop">
            <h1 class="text-center text-light display-5" ><b>Recuperar Contraseña<b></h1><br>
                <form action="<?php echo getUrl("Correo","Correo","postEmail"); ?>" method="POST" name="login">
                    <label for="exampleInputEmail1" class="font-weight-bold text-light">Email</label>
                    <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-warning">
                                <i class="flaticon-envelope-1 font-weight-bold" style="color:black"></i>
                                </span>
                            </div>
                        <input type="email" class="form-control  bg-warning font-weight-bold correo" style="color:black" name="correo" id="correo" placeholder="correo electronico" maxlength="35">
                    </div>
                   
                   <br><br>     
                    <input type="submit" value="Enviar" name="enviar" style="color:white;background-color: rgb(236, 92, 26);" class="font-weight-bold btn  btn-block">
                    </form>
                <div class="text-center">  
                    <a class="font-weight-bold text-light btn btn-link " href="login.php"><b>Regresar</b></a><br>
                </div>
            
            </div>

            <?php
            if (isset($_SESSION['errores'])) {
            ?>
              <br><br>
         <div class="alert alert-danger alert-dismissible fade show col-md-6" role="alert">
            <?php 
             foreach ($_SESSION['errores'] as $errores => $error) {
              echo $error;
               }
            ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
          <?php
          } unset($_SESSION['errores']);
          ?>
          
        </div>
    </body>
</html>