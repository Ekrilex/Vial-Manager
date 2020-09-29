<?php
if ($_SESSION['mostrar']=="1") {

?>
 <div id="cambios">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <h3 class="modal-title text-white">Cambiar Datos</h3>
        <button type="button" class="close text-white clo" data-dismiss="modal" aria-label="Close">
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
        <button type="button" class="btn btn-danger clo" data-dismiss="modal">Cerrar</button>
      </div>
     </div>

</div>
</div>     
<?php  
}else if($_SESSION['mostrar']=="0") {

?>

     <div id="cambios">

<div class="modal-dialog">
    <div class="modal-content">     
      <div class="modal-header btn-primary">
        <h3 class="modal-title text-white">Cambiar Datos</h3>
        <button type="button" class="close text-white clo" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-white btn-default">
     
      <h5>Contrase&ntilde;a actual</h5>
      <div class="input-group">
          <input type="password" class="form-control cl1 confir border-danger" placeholder="porfavor ingrese su contraseña">
          <button type="button" class="far fa-eye text-primary bg-dark btn btn-dark" id="contra" value="v1"  style="font-size:18px;"></button>
      </div>
       
        </div>

      <div class="modal-footer bg-dark">
    
     <button class="btn btn-primary confirmar" data-url="<?php echo getUrl("Usuario","Usuario","getValidar",false,"ajax"); ?>">Confirmar</button>  
  
        <button type="button" class="btn btn-danger clo" data-dismiss="modal">Cerrar</button>
      
      </div>
</div>
</div>

    </div>

<?php
}

?>      
