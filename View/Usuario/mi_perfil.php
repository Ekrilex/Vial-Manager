<?php 
  

  while ($usu=pg_fetch_assoc($Usuario)) {

 ?>
<div class="container"><br>

<div class="card">
  <div class="card-title container"><br>
    <h2 style="text-align:center;color:white;">Mi cuenta <span class="icon-people" style="color:white;"></span></h2>
<?php
if (isset($_SESSION['datos'])) {
?>
<script type="text/javascript"> setTimeout(function() { $(".notificacionD").fadeOut(5000); },1000); </script>
<div class="col-md-2 col-sm-2 col-lg-2">
<div class="notificacionD alert alert-info alert-dismissible text-dark fade show" role="alert" style="display:inline-block;margin: 0px auto;padding-left:70px;position: fixed;z-index:50;right:50px;padding-right:70px;">
 <span data-notify="icon" class="fa fa-bell"></span>
<h5><strong>Vial Manager</strong></h5>
 <?php
  foreach ($_SESSION['datos'] as $value) {
    echo $value;
  }

 ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
</div><br>
<?php

} unset($_SESSION['datos']); 

?>
</div><br>
  <div class="card-body">
      <div style="width:95%;" class="container text-white">

            <div class="row">

              <div class="col-md-3">
                  <h4>Rol: </h4>  
                </div> 

                <div   class="col-md-3">
                  <input type="text"  disabled Class="form-control text-danger form-l"  id="bor" name="Rol" value="<?php echo $usu['rol_nombre']; ?>">
                </div> 

              <div class="col-md-3">
                  <h4>Nickname: </h4>  
                </div> 

                <div   class="col-md-3">
                  <input type="text"  disabled Class="form-control text-danger form-l"  id="bor" name="Rol" value="<?php echo $usu['usu_nickname']; ?>">
                </div>       
            </div><br>

            <div class="row">
                  <div class="col-md-3">
                      <h4>Primer nombre: </h4>  
                  </div>     
                  <div class="col-md-3">
                     <input type="text" disabled class="form-control text-danger form-l"  id="bor" name="primer_nombre" value="<?php echo $usu['usu_primer_nombre'];?>">
                  </div> 
                  <div class="col-md-3">
                      <h4>Segundo nombre: </h4> 
                  </div>  
                  <div class="col-md-3">
                     <input type="text" disabled class="form-control  text-danger form-l" id="bor" name="segundo_nombre"  value="<?php echo $usu['usu_segundo_nombre'];?>">
                  </div></div><br>
        <div class="row">
          <div class="col-md-3">
                <h4>Primer apellido:</h4>
          </div>
          <div class="col-md-3">
               <input type="text"   disabled class="form-control  text-danger form-l" id="bor" name="primer_apellido" value="<?php  echo $usu['usu_primer_apellido'];?>">
          </div>
          <div class="col-md-3">
               <h4>Segundo apellido:</h4>
         </div>
          <div class="col-md-3">
              <input type="text"   disabled  class="form-control  text-danger form-l"  id="bor" name="segundo_apellido" value="<?php  echo $usu['usu_segundo_apellido'];?>">
          </div>
      </div><br>
      <div class="row">
          <div class="col-md-3">
            <h4>Numero de documento:</h4>
          </div>
          <div class="col-md-3">
             <input type="number"   disabled  class="form-control  text-danger form-l"  id="bor"name="numero_documento"  value="<?php  echo $usu['usu_num_identificacion'];?>">
          </div>
        <div class="col-md-3">
          <h4>Tipo de documento:</h4>
        </div>
        <div class="col-md-3">
          <input type="text"  disabled   class="form-control  text-danger form-l" id="bor" name="tipo_documento" value="<?php  echo $usu['tip_descripcion'];?>">
        </div>

      </div><br>

        <div class="row">

          <div class="col-md-3">
            <h4>Correo electronico:</h4>
          </div>  
          <div class="col-md-3">
            <input type="text"  disabled class="form-control  text-danger form-l" name="Correo_electronico "  value="<?php  echo $usu['usu_correo'];?>">
          </div>
        </div><br>

      <div class="row">
        <div class="col-md-5"></div>
            <div class="col-md-4">
             <button data-toggle="modal" data-target="#actualizarDatos" class="btn btn-primary botonDatos">Cambiar contrase&ntilde;a  /  correo electronico</button>
           </div>
         </div>
      </div>
      <br><br>
    </div>

<div class="modal" id="actualizarDatos">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <h3 class="modal-title text-white">Cambiar Datos</h3>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-white btn-default">
   <h5>Correo Electronico</h5><input type="text" autocomplete="off" class="form-control correo2 border-primary" name="correo2" placeholder="example@example.com" data-url="<?php echo getUrl("Usuario","Usuario","postPerfil",false,"ajax"); ?>" id="correo2">
      <div id="error1" value=""></div><br>        
      <h5>Contraseña</h5>
      <div class="input-group">
          <input type="password" class="form-control cl1 campos clave1 border-primary" name="clave1" placeholder="Ejemplo 1: Xx12345   Ejemplo 2: 12345Xx" data-url="<?php echo getUrl("Usuario","Usuario","postPerfil",false,"ajax"); ?>">
          <button type="button" class="far fa-eye text-primary bg-dark btn btn-dark" id="contra" value="v1"  style="font-size:18px;" data-toggle="tooltip" data-placement="bottom" title="Las contraseñas deben tener 7 caracteres compuestos por:1 letra minuscula, 1 letra mayuscula, 5 numeros. ejemplo 1: Xx12345, ejemplo 2: 12345Xx"></button>
            </div><div id="error2" value=""></div><br>
  <h5>Confirmar Contraseña</h5>  
 <div class="input-group">
          <input type="password" class="form-control cl1 campos clave2 border-primary" name="clave2" id="clave2">
          <span class="far fa-eye text-primary bg-dark btn btn-dark" id="cam" style="font-size:18px;"></span>
            </div><div id="error3"></div><br>        
            <div id="error4"></div><br>
        </div>
      <div class="modal-footer bg-dark">
        <button class="btn btn-primary Datos" data-url="<?php echo getUrl("Usuario","Usuario","postPerfil",false,"ajax"); ?>">Actualizar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
   </div>
   </div>
  </div> 
  </div>
<?php

}

?>