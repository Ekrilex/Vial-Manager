<div style="background:#87CEFA;">
  <div  class="container"><br><br>
    <h2 class="ldt text-align-center">Consultar deterioros</h2><br>
<div class="row ld">
    <div class="col-md-1">
     <h3>Buscar: </h3>   
    </div>
    <div class="col-md-3">
    <input class="form-control" id="filtro" data-url="<?php echo getUrl("Deterioro","Deterioro","filtro",false,"ajax"); ?>" type="text" placeholder=" Buscar..">        
    </div>
 
  </div><br>
    <div class="card-body">
     <div class="table-responsive btn-dark">
      <div class="dataTables_wrapper container-fluid dt-bootstrap4">
        <div class="row">
          <div class="col-sm-12">
            <table id="basic-datatables" class="display table table-striped dataTable">
              <thead>
                <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 47px;">#</th>
                <th class="sorting" tabindex="0" aria-controls="basic-datatables" rowspan="2" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 71px;">Nombre deterioro</th>
                <th class="sorting" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 74px;">Tipo deterioro</th>
                <th class="sorting" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 27px;">Clasificaci&oacute;n</th>
                <th class="sorting" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="2" aria-label="Start date: activate to sort column ascending" style="width: 70px;text-align:center;">Acciones</th>
                </tr>
              </thead>                      
             <?php
                 while ($det=pg_fetch_assoc($deterioro)) {
        
        echo "<tr>";
        echo "<td>".$det['det_id']."</td>";
        echo "<td>".$det['det_nombre']."</td>";
        echo "<td>".$det['det_tipo_deterioro']."</td>";
        echo "<td>".$det['det_clasificacion']."</td>";
        echo "<td><button class='btn btn-primary' id='editar' value='".$det['det_id']."' data-url='".getUrl("Deterioro","Deterioro","getUpdate",false,"ajax")."'>Modificar</button></td>";
        echo "<td><button class='btn btn-danger' id='eliminar' value='".$det['det_id']."' data-url='".getUrl("Deterioro","Deterioro","getDelete",false,"ajax")."'>Eliminar</button></td>";
        echo "</tr>";
        } ?>
        </table></div></div></div></div></div><br><br>
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