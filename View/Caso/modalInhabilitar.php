<div class="modal col-md-12 col-sm-12" id="modalInhabilitarCaso">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header btn-danger">
                <h3 class="modal-title text-white">Inhabilitar Caso</h3>
            </div>
            <div class="modal-body" style="background-color:rgb(0,0,45);">
                <label>¿Está seguro que desea inhabilitar este Caso?</label>
            </div>
            <div class="modal-footer" style="background-color:rgb(0,0,45);">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                                            
                <button type="button" data-url="<?php echo getUrl('Caso','Caso','postDelete',false,'ajax')?>" data-id="<?php echo $casoSeleccionado['cas_id']?>" class="btn btn-danger cambiarEstadoCaso">Inhabilitar</button>
            </div>
        </div>
    </div>
</div>