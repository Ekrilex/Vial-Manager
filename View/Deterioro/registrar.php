<div class="container"><br>
<div class="det-fondo"><br>
  <div class="ld"><h2>Registrar nuevo deterioro</h2></div><br>    
  <form action="<?php echo getUrl("Deterioro","Deterioro","postCreate"); ?>" method="POST">
  <div class="row">
    <span class="col-md-1"></span>
    <div class="col-md-2">
      <h3 class="lad">Nombre del deterioro</h3>
    </div>
    <div class="col-md-6">
      <input type="text" name="det_nombre" class="form-control validacion" required>
    </div>
    <div id="error"></div>
  </div><br><br>
  <div class="row">
    <span class="col-md-1"></span>
    <div class="col-md-2">
      <h3 class="lad">Tipo de daño</h3>
    </div>
    <div class="col-md-6">
      <input type="text" name="det_tipo_deterioro" class="form-control" required>
    </div>
  </div><br><br>

  <div class="row col-md-12">
    <span class="col-md-4"></span>
  <div class="col-md-2">
    <input type="submit" class="btn btn-primary" value="Guardar" id="enviar">
  </div>
</form>
  <div class="col-md-2">
    <a href="#"><button class="btn btn-danger">Cancelar</button></a>
  </div>
</div><br><br>
</div>
</div>