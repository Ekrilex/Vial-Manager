<div class="modal col-md-12 col-sm-12" id="modalHabilitarCaso">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header btn-success">
                <h3 class="modal-title text-white">Habilitar Caso</h3>
            </div>
            <div class="modal-body" style="background-color:rgb(0,0,45);">
                <label>¿Está seguro que desea Habilitar este Caso?</label>
            </div>
            <div class="modal-footer" style="background-color:rgb(0,0,45);">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                                            
                <button type="button" data-url="<?php echo getUrl('Caso','Caso','postDelete',false,'ajax')?>" data-id="<?php echo $casoSeleccionado['cas_id']?>" class="btn btn-success cambiarEstadoCaso">Habilitar</button>
            </div>
        </div>
    </div>
</div>