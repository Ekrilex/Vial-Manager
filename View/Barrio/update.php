<!-- Modal de Editar -->
<div class="modal" id="Actualizacion">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <h1 class="modal-title text-center text-light" id="exampleModalLabel">Editar Barrio</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
             
            <div class="modal-body btn-default">
             
                <p class="statusMsg"></p>
                <form  action="<?php echo getUrl("Barrio","Barrio","postUpdate"); ?>" method="POST">
                    <div id="editarB">
                     
                    </div>
                 
                    <br>
                    <div class="modal-footer btn-default">
                         <button type="button" class="btn btn-danger" data-dismiss="modal" >Cancelar</button>
                        <input type="submit" name="Actualizar" id="Actualizar" value="Actualizar" class="btn btn-info">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
