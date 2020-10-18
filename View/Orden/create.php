
<div class="container"><br>
 
 <div class="card col-md-12 col-sm-12 col-lg-12" style="max-width: 73rem;">
  <div class="card-header">
   <div class="d-flex align-items-center">
    <h3 class="card-title">Seleccionar caso </span>&nbsp;&nbsp;<span class="icon-magnifier"></span></h3>
       <a type="button" class="text-light btn btn-success btn-round ml-auto registrar" data-url="<?php echo getUrl("Orden","Orden","postCreate",false,"ajax"); ?>">
      <i class="fa fa-plus"></i> Emitir Orden</a>
      <div id="ordenesTabla">
      </div>
    </div>
  </div>   
    <div class="card-body">
      <div class="table-responsive">
       <table id="Tbl-orden" class="display table table-striped table-hover" >
         <thead>
          <tr>
           <th>#</th> 
           <th>Deterioro</th>
           <th>Prioridad</th>
           <th>Fecha de creaci&oacute;n</th>
           <th>Fecha de vencimiento</th>
           <th>Foto inicio</th>           
           <th>Seleccionar</th>      
          </tr>
         </thead>
          <tbody>
           <?php
             while ($cas=pg_fetch_assoc($Caso)) {
              echo "<tr>";
              echo "<td>".$cas['cas_id']."</td>";
              echo "<td><button class='btn btn-success deterioros' data-url='".getUrl("Orden","Orden","deterioros",false,"ajax")."' data-id='".$cas['cas_id']."'>Ver deterioros</button></td>";               
          
              if($cas['cas_prioridad'] == 1 || $cas['cas_prioridad'] == 2 || $cas['cas_prioridad'] == 0){
                                                
              $colorPrioridad = "rgb(0,250,0)";
              $nombrePrioridad = "Baja";
              $iconoPrioridad = "<i class='fas fa-thumbs-up text-success'></i>";

              }else if($cas['cas_prioridad'] == 3 || $cas['cas_prioridad'] == 4){

              $colorPrioridad = "rgb(250,250,0)";
              $nombrePrioridad = "Media";
              $iconoPrioridad = "<i class='fas fa-exclamation-triangle text-warning'></i>";

              }else if($cas['cas_prioridad'] > 4 && $cas['cas_prioridad'] <= 7){
              $colorPrioridad = "rgb(250,0,0)";
              $nombrePrioridad = "Alta";
              $iconoPrioridad = "<i class='fas fa-flag text-danger'></i>";
              }

              echo "<td style='color:".$colorPrioridad.";'>".$iconoPrioridad." ".$nombrePrioridad."</td>";       
              echo "<td>".$cas['cas_fecha_creacion']."</td>";
              echo "<td>".$cas['cas_fecha_vencimiento']."</td>";              
              echo "<td><button class='btn btn-secondary foto' data-url='".getUrl("Orden","Orden","imagen",false,"ajax")."' data-id='".$cas['cas_id']."'>Ver fotografia</button></td>";               
              echo "<td><input class='form-check container selecOrd' style='width:18px;height:16px;' type='checkbox' value='".$cas['cas_id']."'></td>";
              echo "</tr>";
           } ?>
          </tbody>
        </table>
      </div>
    </div><br><br>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal-foto" tabindex="-1" aria-labelledby="modal-foto" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header  btn-secondary">
        <h5 class="modal-title" id="exampleModalLabel">Fotografia Inicial</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body btn-default">
          <div id="foto"></div>
      </div>
      <div class="modal-footer btn-default">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal" id="modal-deterioros">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header  btn-secondary">
        <h5 class="modal-title">Deterioros</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body btn-default">
           <table class="table table-striped table-responsive">
         <thead class="btn-success">
           <tr style="text-align:center;">
            <th >Codigo</th>
             <th >Nobre deterioro</th>
             <th >Tipo </th>
             <th >Clasificaci&oacute;n</th>
             <th >Area calculada con el deteriro</th>
           </tr>
         </thead>
          <tbody id="deterioros">  
          </tbody>
        </table>        
      </div>
      <div class="modal-footer btn-default">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>