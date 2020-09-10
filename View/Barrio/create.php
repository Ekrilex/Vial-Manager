
<div class="modal" id="modalForm">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title text-center text-dark" id="exampleModalLabel">Registrar Barrio</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"></span>
				</button>
			</div>
			<div class="modal-body">
                <!-- Validacion para los campos no llenos -->
                <?php 
                    if(isset($_SESSION['errores'])){
                ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php 
                            foreach($_SESSION['errores'] as $errores => $error){
                                echo $error."<br>";
                            }
                        ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <?php 
                    }
                    unset($_SESSION['errores']);
                ?>
                <!-- Aqui termina -->

                <p class="statusMsg"></p>
                <form action="<?php echo getUrl("Barrio","Barrio","postCreate"); ?>" method="POST">
                    <div class="form-group">
                        <!-- <input type="hidden" class="form-control" id="bar_id"> -->
                        <h4 class="text-dark">Descripción o Nombre de Barrio</h4>
                        <input type="text" class="form-control barrioN" name="bar_nombre" id="bar_nombre" placeholder=""/>
                    </div>
                    <div class="form-group">
                        <h4 class="text-dark">N&uacute;mero de la Comuna</h4>
                        <select class="form-control" name="com" id="com">
                        <option value="">Seleccione...</option>
                            <?php
                                while($comun=pg_fetch_assoc($comunas)){
                                // foreach($comunas as $comun){
                                    echo "<option value='".$comun['com_id']."'>".$comun['com_id']."</option>";
                                }
                            ?>
                        </select>
                    </div>  
                    <div class="modal-footer">
                        <a href="index.php" class="btn btn-default">Cerrar</a>
                        <input type="submit" name="Registrar" value="Registrar" class="btn btn-success">
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
  $("#modalForm").modal();
 });
</script>