<div class="det-fondo">
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
<div class="table-responsive">  
<table class="table  table-striped table-hover bg-white text-dark" style="text-align: center;font-family:verdana;font-size:22px;">
<thead class="thead-dark">
<tr>
  <th colspan="6">Deterioros</th>
</tr>
<tr>
    <th>#</th>
    <th>Nombre del deterioro</th>
    <th>Tipo deterioro</th>
    <th colspan="2">Acciones</th>
</tr>
</thead>
  <?php
  
      foreach ($deterioro as $det) {

        echo "<tr>";
        echo "<td>".$det['det_id']."</td>";
        echo "<td>".$det['det_nombre']."</td>";
        echo "<td>".$det['det_tipo_deterioro']."</td>";

    echo "<td><button class='btn btn-primary' id='editar' value='".$det['det_id']."' data-url='".getUrl("Deterioro","Deterioro","getUpdate",false,"ajax")."'>Modificar</button></td>";
         echo "<td><button class='btn btn-danger' id='eliminar' value='".$det['det_id']."' data-url='".getUrl("Deterioro","Deterioro","getDelete",false,"ajax")."'>Eliminar</button></td>";
        echo "</tr>";
       }
  ?><br><br>
</table>
</div>
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
        <input type="submit" class="btn btn-primary" value="Actualizar">
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
</div>