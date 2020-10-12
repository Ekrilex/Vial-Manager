<div class="modal fade" id="modalFinalizar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form_finish" action="<?php echo getUrl("Caso", "Caso", "postFinalize"); ?>" method="POST" enctype="multipart/form-data">

                <div class="modal-header btn-success">
                    <h5 class="modal-title" id="staticBackdropLabel">Finalizar el caso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body btn-default">
                    <h5>Por Favor adjunte la foto despues de la intervencion sobre la via</h5>
                    <input type="file" class="form-control valid " name="cas_fotografia_fin" id="fotografia_fin">
                    <div class="form-row col-md-12 mt-3">
                        <label>Observacion</label>
                        <textarea class="form-control valid" name="cas_fin_observacion" id="cas_fin_observacion" rows="4" placeholder="Ingrese la justificaccion" maxlength="200"></textarea>
                        <small id="ad5" class="form-text text-muted text-danger"></small>
                    </div>
                </div>
                <div id="imagen">
                </div>
                <div class="modal-footer btn-default">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="hidden" name="cas_id" value="<?php echo $casoSeleccionado['cas_id']; ?>">
                    <button type="submit" id="finalizarCasoModal" class="btn btn-success">Finalizar caso</button>
                </div>

            </form>
        </div>
    </div>
</div>