<?php 
  while ($usu=pg_fetch_assoc($Usuario)) {
 ?>
<div class="container"><br>
<div class="card">
  <div class="card-title container"><br>
    <h2 style="text-align:center;color:white;">Mi cuenta <span class="icon-people" style="color:white;"></span></h2>
</div><br>

  <div class="card-body">
      <div style="width:95%;" class="container text-white">

        <div class="row">

         <div class="col-md-3">
           <h3>Rol:</h3>  
         </div> 
         <div class="col-md-3">
           <input type="text"  disabled Class="form-control text-danger form-l"  id="bor" name="Rol" value="<?php echo $usu['rol_nombre']; ?>">
         </div> 

          <div class="col-md-3">
            <h3>Nickname: </h3>  
          </div> 

          <div class="col-md-3">
            <input type="text"  disabled Class="form-control text-danger form-l"  id="bor" name="Rol" value="<?php echo $usu['usu_nickname']; ?>">
          </div>       
        </div><br>

        <div class="row">
          <div class="col-md-3">
            <h3>Primer nombre: </h3>	
          </div>     
          <div class="col-md-3">
            <input type="text" disabled class="form-control text-danger form-l"  id="bor" name="primer_nombre" value="<?php echo $usu['usu_primer_nombre'];?>">
          </div> 
          <div class="col-md-3">
            <h3>Segundo nombre: </h3>	
          </div>  
          <div class="col-md-3">
          <input type="text" disabled class="form-control  text-danger form-l" id="bor" name="segundo_nombre"  value="<?php echo $usu['usu_segundo_nombre'];?>">
        </div></div><br>

        <div class="row">
          <div class="col-md-3">
                <h3>Primer apellido:</h3>
          </div>
          <div class="col-md-3">
               <input type="text"   disabled class="form-control  text-danger form-l" id="bor" name="primer_apellido" value="<?php  echo $usu['usu_primer_apellido'];?>">
          </div>
          <div class="col-md-3">
               <h3>Segundo apellido:</h3>
         </div>
          <div class="col-md-3">
              <input type="text"   disabled  class="form-control  text-danger form-l"  id="bor" name="segundo_apellido" value="<?php  echo $usu['usu_segundo_apellido'];?>">
          </div>
      </div><br>
      <div class="row">
          <div class="col-md-3">
            <h3>Numero de documento:</h3>
          </div>
          <div class="col-md-3">
             <input type="number"   disabled  class="form-control  text-danger form-l"  id="bor"name="numero_documento"  value="<?php  echo $usu['usu_num_identificacion'];?>">
          </div>
        <div class="col-md-3">
          <h3>Tipo de documento:</h3>
        </div>
        <div class="col-md-3">
          <input type="text"  disabled   class="form-control  text-danger form-l" id="bor" name="tipo_documento" value="<?php  echo $usu['tip_descripcion'];?>">
        </div>

      </div><br>

      <div class="row">
        <div class="col-md-3">
          <h3>Correo electronico:</h3>
        </div>	
        <div class="col-md-3">
        <input type="text"  class="form-control form-l" name="Correo_electronico "  value="<?php  echo $usu['usu_correo'];?>">
        </div>
      </div><br>

      <div class="row">
        <div class="col-md-3">
          <h3>Contraseña:</h3>
          </div>
        <div class="col-md-3 input-group">
          <input type="password" class="form-control gyg form-l"  name="clave" value="<?php  echo $usu['usu_contrasena'];?>">

         <button class="far fa-eye text-primary bg-dark btn btn-dark" id="view" value="v1"  style="font-size:18px;"></button>
        </div>
        <div class="col-md-4">
          <a href="#actualizar" data-toggle="modal"><button class="btn btn-primary ">Cambiar contrase&ntilde;a  /  correo electronico</button></a>
        </div>
      </div>
    </div><br><br>
  </div>
  <div class="modal" id="actualizar">
   <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo getUrl("Usuario","Usuario","postPerfil"); ?>" method="POST">
      <div class="modal-header bg-dark">
        <h4 class="modal-title text-white">Cambiar Datos</h4>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-dark">
       <h4>Correo Electronico</h4><input type="text" class="form-control campos correo" name="correo2" value="<?php  echo $usu['usu_correo'];?>">
      <div id="error1"></div>
       <h4>Contraseña</h4>
      <div class="input-group">
        <input type="password" class="form-control cl1 campos clave1" id="bor" name="clave1" value="<?php  echo $usu['usu_contrasena'];?>">
        <button type="button" class="far fa-eye text-primary bg-dark btn btn-dark" id="contra" value="v1"  style="font-size:18px;"></button>
      </div><div id="error2"></div><br>
      <h4>Confirmar Contraseña</h4>  
      <div class="input-group">
        <input type="password" class="form-control cl1 campos clave2" id="bor" name="clave2" id="clave2" value="<?php  echo $usu['usu_contrasena'];?>">
        <span class="far fa-eye text-primary bg-dark btn btn-dark" id="cam" style="font-size:18px;"></span>
      </div><div id="error3"></div><br>
      </div>
      <div class="modal-footer bg-dark">
       <input type="submit" class="btn btn-primary actualizar" value="Actualizar">
       <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
     </form>
    </div>
   </div>
   </div>
  </div> 
  </div> 
<?php
}
if (isset($_SESSION['error'])) {
    echo "<script type='text/javascript'>"
    ."alert('".$_SESSION['error']."');"
    ."</script>";   
}unset($_SESSION['error']); 
?>