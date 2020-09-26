<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditar" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header btn-danger">
        <h5 class="modal-title" id="exampleModalLabel">Seleccionar Deterioro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body btn-default">
        
      </div>
      <div class="modal-footer btn-default">
        <input type="hidden" id="inputDestino" value="">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-secondary" data-url="<?php echo getUrl("Caso","Caso","addDeterioros",false,"ajax"); ?>" id="boton_deterioro" >Añadir</button>
      </div>
    </div>
  </div>
</div>