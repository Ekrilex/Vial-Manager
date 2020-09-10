<div class="container"><br><br>
<div class="card col-md-12 col-sm-12 col-lg-12" style="max-width: 53rem;">
  <div class="card-body">
    <h5 class="card-title" style="text-align:center;">Registrar nuevo deterioro</h5><br>
  <form action="<?php echo getUrl("Deterioro","Deterioro","postCreate"); ?>" method="POST">
  <div class="row">
    <span class="col-md-1"></span>
    <div class="col-md-3 text-white">
      <h3>Nombre del deterioro</h3>
    </div>
    <div class="col-md-6">
      <input type="text" name="det_nombre" class="form-control validacion">
    </div>
    <div id="error"></div>
  </div><br><br>
  <div class="row">
    <span class="col-md-1"></span>
    <div class="col-md-3 text-white">
      <h3>Tipo de daño</h3>
    </div>
    <div class="col-md-6">
      <select name="det_tipo_deterioro" class="form-control">
      <option value="">Seleccione..</option>
      <?php
      foreach ($tiposs as $tip) {
         echo "<option value='".$tip."'>".$tip."</option>";
        }
      ?>
    </select>
    </div>
  </div><br><br>
  <div class="row">
    <span class="col-md-1"></span>
    <div class="col-md-3 text-white">
      <h3>Clasificaci&oacute;n</h3>
    </div>
    <div class="col-md-6">
      <select name="det_clasificacion" class="form-control">
      <option value="">Seleccione..</option>
      <?php
      foreach ($clasi as $cla) {
         echo "<option value='".$cla."'>".$cla."</option>";
        }
      ?>
    </select>
    </div>
  </div><br><br>
  <div class="row col-md-12">
    <span class="col-md-4"></span>
  <div class="col-md-2">
    <input type="submit" class="btn btn-primary" value="Guardar" id="enviar">
  </div>
</div>
</form>
  </div>
  </div><br><br>
<?php
if (isset($_SESSION['result'])) {

?>
<div class="container">
<div class="alert alert-primary alert-dismissible fade show col-md-9 col-sm-12 col-lg-9" role="alert">
  <?php 
   foreach ($_SESSION['result'] as $result => $res) {
    echo $res;} 
  ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div><br><br>
<?php
}
unset($_SESSION['result']);
?>
</div>
</div>