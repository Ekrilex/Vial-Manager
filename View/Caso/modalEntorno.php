<div class="modal fade" id="modalEntorno" tabindex="-1" aria-labelledby="ModalEntorno" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header btn-success">
        <h5 class="modal-title" id="exampleModalLabel">Seleccionar Entorno</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body btn-default">
            <table class="table table-head-bg-success table-hover" style="text-align:center;" id="datatable-entorno">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Seleccion</th>
                    </tr>
                </thead>
                <tbody id="registrosEntorno">
                    <?php 
                    
                        while($entorno = pg_fetch_assoc($eject)){
                    ?>
                    <tr>
                      <td><?php echo $entorno['ent_descripcion'] ?></td>
                      <td><button class="btn btn-info" id="seleccionarEntorno" value="<?php echo $entorno['ent_id'] ?>" data-name="<?php echo $entorno['ent_descripcion'] ?>" data-url="<?php echo getUrl("Caso","Caso","enviarEntorno",false,"ajax")?>"><span><i class="fas fa-plus-circle text-light"></i></span></button></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
      </div>
      <div class="modal-footer btn-default">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-secondary"  data-dismiss="modal">Enviar</button>
      </div>
    </div>
  </div>
</div>