<div class="modal fade" id="modalDeterioro" tabindex="-1" aria-labelledby="modalDeterioro" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header btn-danger">
        <h5 class="modal-title" id="exampleModalLabel">Seleccionar Deterioro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body btn-default">
        <div>
            <table class="table table-head-bg-danger table-hover text-center" id="datatable-deterioro">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Clasificacion</th>
                        <th>Seleccione</th>
                    </tr>
                </thead>
                <tbody id="registrosDeterioro">
                    <?php while($det = pg_fetch_assoc($deterioro)){ ?>
                      <tr>
                          <td><?php echo $det['det_nombre']; ?></td>
                          <td><?php echo $det['det_tipo_deterioro']; ?></td>
                          <td><?php echo $det['det_clasificacion']; ?></td>
                          <td>                    
                            <button class='btn btn-secondary botonModalDeterioro' id='selectDeterioro' data-id="<?php echo $det['det_id'];?>" data-name="<?php echo $det['det_nombre']?>" value=""><span><i class='fas fa-plus-circle text-light'></i></span></button>													  
                          </td>
                      </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer btn-default">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-secondary" data-url="<?php echo getUrl("Caso","Caso","addDeterioros",false,"ajax"); ?>" id="boton_deterioro" >Añadir</button>
      </div>
    </div>
  </div>
</div>