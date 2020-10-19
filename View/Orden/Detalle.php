
<?php 
   while($bita=pg_fetch_assoc($bitacora)){
?>
    <div class="col-md-12">
      
            <div class="card">

                <div class="card-header">
                    <div class="card-title">Detalle: <?php echo $bita['bit_id']; ?></div>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for='inputEmail4'>ID</label>
                                <input readonly type='text' class='font-weight-bold text-dark form-control validacion' name='bit_id' id='bit_id'  placeholder='' value="<?php echo $bita['bit_id']?>" > 
                                
                            </div>
                        </div>
                     
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for='inputPassword4'>Usuario</label>
                                <input readonly type='text' class='font-weight-bold text-dark form-control validacion' name='bit_usuario' id='bit_usuario'  placeholder='' value="<?php echo $bita['bit_usuario']?>"  >
                               
                            </div>   
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for='inputPassword4'>Fecha de modificac&oacute;n</label>
                                <input readonly type='text' class='font-weight-bold text-dark form-control validacion' name='bit_fecha' id='bit_fecha'  placeholder='' value="<?php echo $bita['bit_fecha_modificacion']?>"  >
                               
                            </div>   
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for='inputAddress2'>Nombre de la Tabla</label>
                                <input readonly type='text' class='font-weight-bold text-dark form-control validacion' name='bit_tabla' id='bit_tabla' placeholder='' value="<?php echo $bita['bit_tabla']?>" >
                            </div>  
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <div class="form-group form-inline">
                                <label>Casos que estaban vinculados</label>
                                <input readonly type='text' class='font-weight-bold text-dark form-control validacion' name='bit_casos' id='bit_casos' placeholder='' value="<?php echo $bita['bit_casos']?>" >   
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="form-group col-md-12">
                          <div class="container">
                              <label>Observaci&oacute;n</label>
                              <textarea readonly type='text' class='font-weight-bold text-dark form-control ' name='bit_observacion' id='bit_observacion'  cols="0" rows='5' placeholder='Escriba . . .' ><?php echo $bita['bit_observacion'];?></textarea>
                          </div>
                        </div>
                    </div>      
                </div>
                <hr>
                <div class="card-body">
                <?php 
                    if($_SESSION['rol'] != 4 && $laOrdenSePuedeHabilitar == true){
                  ?>
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
                          
                            echo "<td><input class='form-check container selecOrd' style='width:18px;height:16px;' type='checkbox' value='".$cas['cas_id']."' name='list[]'></td>";
                           
                            echo "</tr>";
                            
                        } ?>
                        </tbody>
                        </table>
                    </div>
                    <?php 
                      }
                    ?>
                </div><br><br>
             
                <div class="card-action">
                    <div id="cambiarEje"></div>
                    <a class="btn btn-secondary" href="<?php echo getUrl('Orden','Orden','historialOrd',array("bit_id" => $bita['bit_id']));?>">Volver</a>
                    <input type="hidden" name="ord_id" id="ord_id" value="<?php echo $bita['bit_id_registro'];?>">
                    <?php 
                      if($_SESSION['rol'] != 4 && $laOrdenSePuedeHabilitar == true){
                    ?>
                      <button  class="btn btn-success habilitar" data-url="<?php echo getUrl('Orden','Orden','postDetalle',false,'ajax')?>">Habilitar Orden</button>
                    <?php 
                      }
                    ?>
                </div>
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

<?php 
    }
?>


