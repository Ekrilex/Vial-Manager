
<div class="container"><br><br>
 
<div class="card col-md-12 col-sm-12 col-lg-12" style="max-width: 73rem;">
<div class="card-header"><h3 class="card-title">Consultar deterioros&nbsp;&nbsp;<span class="icon-book-open"></span>&nbsp;&nbsp;<span class="icon-magnifier"></span></h3></div>  
  <div class="card-body">
<div class="row">
    <div class="col-lg-1 col-md-1 col-sm-1"></div>
    <div class="col-md-2 col-sm-3 col-lg-2 text-white">
     <h4>Buscar:</h4>   
    </div>
    <div class="col-md-7 col-sm-7 col-lg-5">
    <input class="form-control" id="filtro" data-url="<?php echo getUrl("Deterioro","Deterioro","filtro",false,"ajax"); ?>" type="text" placeholder=" Buscar..">        
    </div>
 
  </div><br>
    <div class="card-body">
          <div class="col-sm-12">
            <table class="table table-striped table-head-bg-info bg-dark">
            
            <thead>
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nombre deterioro</th>
                      <th scope="col">Tiipo deterioro</th>
                      <th scope="col">Clasificaci&oacute;n</th>
                      <th scope="col">
                          &nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;
                          Acciones
                      </th>
                      <th scope="col"></th>
                  </tr>
              </thead>
              <!--<thead>
                <tr role="row">
                <th class="sorting_asc" aria-controls="basic-datatables" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 47px;">#</th>
                <th class="sorting" aria-controls="basic-datatables" aria-label="Position: activate to sort column ascending" style="width: 71px;">Nombre deterioro</th>
                <th class="sorting" aria-controls="basic-datatables" aria-label="Office: activate to sort column ascending" style="width: 74px;">Tipo deterioro</th>
                <th class="sorting" aria-controls="basic-datatables" aria-label="Age: activate to sort column ascending" style="width: 27px;">Clasificaci&oacute;n</th>
                <th class="sorting" aria-controls="basic-datatables" colspan="2" aria-label="Start date: activate to sort column ascending" style="width: 70px;text-align:center;">Acciones</th>
                </tr>
              </thead> -->                      
             <?php
                 while ($det=pg_fetch_assoc($deterioro)) {
        
        echo "<tr>";
        echo "<td>".$det['det_id']."</td>";
        echo "<td>".$det['det_nombre']."</td>";
        echo "<td>".$det['det_tipo_deterioro']."</td>";
        echo "<td>".$det['det_clasificacion']."</td>";
        echo "<td><button data-toggle='tooltip' class='btn btn-link btn-primary icon-note' id='editar' value='".$det['det_id']."' data-url='".getUrl("Deterioro","Deterioro","getUpdate",false,"ajax")."' data-original-title='Editar'></button></td>";
        echo "<td><button data-toggle='tooltip' class='btn btn-link btn-danger flaticon-interface-5' id='eliminar' value='".$det['det_id']."' data-url='".getUrl("Deterioro","Deterioro","getDelete",false,"ajax")."' data-original-title='Eliminar'></button></td>";
        echo "</tr>";
        } ?>
        </table></div></div><br><br>
    <div class="modal col-md-12 col-sm-12" id="modal_editar">
     <div class="modal-dialog">
      <div class="modal-content">
       <form action="<?php echo getUrl("Deterioro","Deterioro","postUpdate"); ?>" method="POST">            
        <div class="modal-header btn-primary">
            <h3 class="modal-title text-white">Actualizar registro</h3>
        </div>
        <div class="modal-body">
          <div id="contenido_editar" class="text-dark"></div>      
        </div>
        <div class="modal-footer">
        <input type="submit" class="btn btn-primary actualizar" value="Actualizar">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
        </div>
       </form>
      </div>
     </div>
    </div>


<div class="modal col-md-12 col-sm-12" id="modal_eliminar">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo getUrl("Deterioro","Deterioro","postDelete"); ?>" method="POST">          
      <div class="modal-header btn-danger">
        <h3 class="modal-title text-dark">Eliminar registro</h3>
      </div>
      <h3 class="container text-dark">¿Esta seguro de eliminar este registro?</h3>
      <div class="modal-body">
          <div id="cotenido_eliminar" class="text-dark"></div>  
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-danger" value="Aceptar">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
      </div>
      </form>   
    </div>
  </div>
</div>

<?php

if (isset($_SESSION['result'])) {
    echo "<script type='text/javascript'>"
    ."alert('".$_SESSION['result']."');"
    ."</script>";   
}unset($_SESSION['result']); 

?>

</div>
</div>
</div>
