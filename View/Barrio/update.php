<?php
    while($bar=pg_fetch_assoc($barrios)){
    // foreach($barrios as $bar){
?>
<div class="modal" id="actualizar">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title text-center text-dark" id="exampleModalLabel">Actualizar Barrio</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"></span>
				</button>
			</div>
			<div class="modal-body">
                <p class="statusMsg"></p>
                <form action="<?php echo getUrl("Barrio","Barrio","postUpdate"); ?>" method="POST">
                    <div class="form-group">
                        <h4 class="text-dark">id de Barrio</h4>
                       <input readonly type="text" class="form-control text-dark" name="bar_id" id="bar_id"  value="<?php echo $bar['bar_id'];?>">
                    </div>
                    <div class="form-group">
                        <h4 class="text-dark">Descripción o Nombre de Barrio</h4>
                        <input type="text" class="form-control barrioEditar" name="bar_descripcion" id="bar_descripcion"  value="<?php echo $bar['bar_descripcion'];?>"/>
                    </div>
                    <div class="form-group">
                        <h4 class="text-dark">N&uacute;mero de la Comuna</h4>
                        <select class="form-control" name="com" id="com">
                        <option value="">Seleccione...</option>
                            <?php
                                while($comun=pg_fetch_assoc($comunas)){
                                // foreach($comunas as $comun){
                                    if($comun['com_id']==$bar['comuna_id']){
                                        echo "<option value='".$comun['com_id']."' selected>".$comun['com_id']."</option>";
                                    }else{
                                        echo "<option value='".$comun['com_id']."'>".$comun['com_id']."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>  
                    <div class="modal-footer">
                        <a href="<?php echo getUrl("Barrio","Barrio","index")?>" class="btn btn-default">Cerrar</a>
                        <input type="submit" name="Actualizar" value="Actualizar" class="btn btn-primary">
                    </div>
                </form>
            </div>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
 $(function(){
  $("#actualizar").modal();
 });
</script>
<?php
    }
?>