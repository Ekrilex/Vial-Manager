
<?php 
  while($ord = pg_fetch_assoc($orden)){
?>
    <div class="col-md-12">
      
            <div class="card">

                <div class="card-header">
                    <div class="card-title">Gestionar Orden de Mantenimiento : <?php echo $ord['ord_id']; ?></div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label>Codigo de Orden</label>
                                <input type="text" class="form-control font-weight-bold text-danger valCaracteresEspeciales" name="ord_id" id="ord_id" value="<?php echo $ord['ord_id'];?>" readonly>
                                <div id="error"></div>
                            </div>
                        </div>
                     
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label>Gestor</label>
                                <input type="text" class="form-control font-weight-bold text-dark valCaracteresEspeciales" name="nickname" id="nickname" value="<?php echo $ord['usu_nickname'];?>" readonly>
                                <div id="error"></div>
                            </div>   
                        </div>
                        <div class="col-md-6 col-lg-4">
                          <div class="form-group">
                              <label >Estado</label>
                                <input type="text" class="form-control font-weight-bold text-dark " name="estado" value="<?php echo $ord['est_descripcion'];?>" id="estado" disabled > 
                          </div>  
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-5 col-form-label">Fecha Creaci&oacute;n</label>

                                <input type="date" class="form-control font-weight-bold text-dark input-full " name="fecha_creacion" value="<?php echo $ord['ord_fecha_creacion'];?>" id="fecha_creacion" placeholder="" readonly> 
                             
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-5 col-form-label">Fecha Vencimiento</label>
                              
                                <input type="date" class="form-control font-weight-bold text-dark input-full " name="fecha_vencimiento" value="<?php echo $ord['ord_fecha_vencimiento'];?>" id="fecha_vencimiento" placeholder="" readonly>
                               
                            </div>
                        </div> 
                    </div>      
                </div>
                <hr>
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
                          
                            while ($cas=pg_fetch_assoc($CasoTabla)) {
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
                            if($cas['orden_id']==$ord['ord_id']){
                                echo "<td><input class='form-check container selecOrd' CHECKED style='width:18px;height:16px;' type='checkbox' value='".$cas['cas_id']."' name='list[]' disabled='disabled'></td>";
                            }else{
                                echo "<td><input class='form-check container selecOrd' style='width:18px;height:16px;' type='checkbox' value='".$cas['cas_id']."' name='list[]' disabled='disabled'></td>";
                            }
                            echo "</tr>";
                            
                        } ?>
                        </tbody>
                        </table>
                    </div>
                </div><br><br>
                <div class="card-action">

           <div id="cambiarEje"></div>
                    <a class="btn btn-secondary" href="<?php echo getUrl('Orden','Orden','index',array("ord_id" => $ord['ord_id']));?>">Volver</a>
                    <input type="hidden" name="ord_id" id="ord_id" value="<?php echo $ord['ord_id'];?>">           
                
                   <?php
                      
                    if($_SESSION['aprobar']=="ok" && $ord['est_descripcion']=="En Progreso"){
                   ?>
                      <?php if($_SESSION['rol']==3 || $_SESSION['rol']==1){?>
                          <button class="btn btn-success finalizarOrd" data-url="<?php echo getUrl('Orden','Orden','finalizar',false,'ajax')?>" >Finalizar orden</button>
                    <?php }?>

                    <?php
                    }else if($_SESSION['aprobar']=="no"){
                      if($_SESSION['rol'] != 4){
                          if($_SESSION['rol'] == 3 || $_SESSION['rol'] == 1){
                            $textoBoton = "Inhabilitar";
                          
                          }else{
                            $textoBoton = "Denegar";
                          }
                    ?>
                      <button  class="btn btn-danger eliminarOrd" data-titulo="<?php echo $textoBoton?>" data-url="<?php echo getUrl('Orden','Orden','postDelete',false,'ajax')?>"><?php echo $textoBoton;?></button>
                      <?php 
                          
                      }?>
                      <?php 
                        if($_SESSION['rol'] != 4 && $_SESSION['rol'] != 3 && $ord['est_descripcion']!="En Progreso"){
                      ?>
                      <button class="btn btn-white aprobarOrd" data-url="<?php echo getUrl('Orden','Orden','aprobar',false,'ajax')?>" >Aprobar</button>     
                        <?php }?>           
                    <?php
                       }
                        unset($_SESSION['aprobar']);                      
                    ?>             
                </div>
            </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="modal-foto" tabindex="-1" aria-labelledby="modal-foto" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
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
  <div class="modal-dialog modal-lg modal-dialog-centered">
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
<?php 
    }
?>


