<?php
  $conta=0;

if(!isset($_SESSION['heard'])){
//Valor inicial
  $_SESSION['heard']='hola1';
  $conta=1;
 
}
  if($conta==1){
?>
  <div id="desaparece" class="panel-header bg-warning">
    <script>
      setTimeout(function(){
        $("#desaparece").html("<div class='page-inner py-5'><div class='d-flex align-items-left align-items-md-center flex-column flex-md-row'><div><h1 class='text-dark pb-2 fw-bold'>Vial-Manager (SENA)</h1><h4 style='color:black' class='fw-bold op-7 mb-2'>Bienvenid@ <?php echo $_SESSION['nombre']." ".$_SESSION['apellido'];?></h4></div></div></div>"
        ).fadeOut(5000);
      }, 1000);
    </script>
  </div>
<?php 
  $conta=2;}
?>
<div class="card ">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="card-body ">
      <div class="rounded carousel-inner">
        <div class="carousel-item active">
          <img src="assets/img/fondo2.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="assets/img/fondoo.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="assets/img/img8.jpg" class="d-block w-100" alt="...">
        </div>
      </div>
    
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
</div>