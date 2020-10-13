<div class="content">
    <div class="page-inner">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h3 class="card-title">Consultar Barrio</h3>

                    <a type="button" id="añadir" class="text-light btn btn-success btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                        <i class="fa fa-plus"></i>
                        Añadir Barrio
                    </a>
                </div>
            </div>
            <br>
            <!--
                Este filtro es el que estaba antes no se va utilizar

                <div class="d-flex align-items-center">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label>Buscar:&nbsp;&nbsp;</label>
                <label>
                    <input type="text" name="filtroB" id="filtroB" data-url="<?php// echo getUrl("Barrio","Barrio","filtro",false,"ajax");?>" class="form-control " placeholder="Buscar... "/>
                </label> 
            </div>--> 
            <div class="card">
    
                <div class="table-responsive">
                    <!-- Aqui se visualiza la validacion del Registro exitoso con un mensaje -->
                    <?php 
                        if (isset($_SESSION['result'])){
                    ?>
                    
                        <div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
                            <script>
                                setTimeout(function(){
                                    $("#alert").html("<?php echo "<span class='text-success'>".$_SESSION['result']."</span>"?><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>").fadeOut(5000);
                                }, 1000);
                            </script>
                        </div>

                    <?php 
                        }
                        unset($_SESSION['result']);
                    ?>
                    <!-- Aqui termina el mensaje del nuevo Registro -->

                    <!-- Aqui se visualiza la validacion del Registro Editado  -->
                    <?php 
                        if (isset($_SESSION['resultEditar'])){
                    ?>

                        <div id="alert" class="alert alert-info alert-dismissible fade show" role="alert">
                            <script>
                                setTimeout(function(){
                                    $("#alert").html("<?php echo "<span class='text-info'>".$_SESSION['resultEditar']."</span>"?><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>").fadeOut(5000);
                                }, 1000);
                            </script>
                        </div>
                   
                    <?php 
                        }
                        unset($_SESSION['resultEditar']);
                    ?>
                    <!-- Aqui termina el mensaje del Registro Editado-->

                    <!-- Aqui se visualiza la validacion del Registro Eliminado  -->
                    <?php 
                        if (isset($_SESSION['resultEliminar'])){
                    ?>
                        <div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                            <script>
                                setTimeout(function(){
                                    $("#alert").html("<?php echo "<span class='text-danger'>".$_SESSION['resultEliminar']."</span>"?><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>").fadeOut(5000);
                                }, 1000);
                            </script>
                        </div>
                    <?php 
                        }
                        unset($_SESSION['resultEliminar']);
                    ?>
                    <!-- Aqui termina el mensaje del Registro Eliminado-->

                    <!-- <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4"> -->
                    <table id="multi-filter-select" class="table table-striped   table-head-bg-info  table-striped-bg-default " >
                        <!-- <table class="table table-striped table-head-bg-info table-striped-bg-default mt-2"> -->
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre de Barrio</th>
                                    <th scope="col">N&uacute;mero de Comuna</th>
                                    <th scope="col">Ubicacion</th>
                                    <th scope="col" class="text-center">
                                       Acciones
                                    </th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                    while($bar=pg_fetch_assoc($barrios)){
                                        
                                    // foreach($barrios as $bar){
                                        echo "<tr>";
                                        echo "<td>".$bar['bar_id']."</td>";
                                        echo "<td>".$bar['bar_descripcion']."</td>";
                                        echo "<td>".$bar['com_id']."</td>";
                                        echo "<td>".$bar['com_ubicacion']."</td>";
                                        echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <a><button id='actuali' value='".$bar['bar_id']."' data-url='".getUrl("Barrio","Barrio","getUpdate",false,"ajax")."' data-toggle='tooltip' class='btn btn-link btn-primary btn-lg' data-original-title='Editar'>
                                                <i class='icon-note'></i></button></a>"
                                             ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><button id='elimi' value='".$bar['bar_id']."' data-url='".getUrl("Barrio","Barrio","postDelete",false,"ajax")."' data-toggle='tooltip' class='btn btn-link btn-danger' data-original-title='Eliminar'>
                                                <i class='flaticon-interface-5'></i> 
                                                </button></a> </td>";
                                        echo "</tr>";
                                        // echo "<input type='hidden' id='elimi' value='".$bar['bar_id']."' data-url='".getUrl("Barrio","Barrio","getDelete",false,"ajax")."' >";
                                    }
                                    
                                include_once '../View/Barrio/index.php';
                              
                                ?>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    include_once '../View/Barrio/update.php';
?>
<?php 
    $prueba=" ";
    while($tra=pg_fetch_assoc($tramo)){
        
        $prueba.=$tra['barrio_id'].",";
    }
    echo "<input type='hidden' name='barrios_id' id='barrios_id' class='btn btn-danger' value=".$prueba.">";

?>



<!-- Modal de Eliminar -->
<!-- <div class="modal" id="eliminar">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header btn-danger">
				<h1 class="modal-title text-center text-light" id="exampleModalLabel">Eliminar Barrio</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"></span>
				</button>
			</div>
			<div class="modal-body btn-default">tener en cuenta para el ajax
               
                <form action="<?php //echo getUrl("Barrio","Barrio","postDelete"); ?>" method="POST">
                    
                    <div id="eliminarB" class="text-dark"></div>tener en cuenta para el ajax
                  
                    <div class="form-group">
                        <h4 class="text-light">¿Esta seguro de elimanar el barrio?</h4>
                    </div>
                    <div class="modal-footer btn-default">
                    <button type="button" class="btn btn-dark" data-dismiss="modal" >Cancelar</button> -->
                   
                       
                   
                       <!-- <button type="submit" name="Aceptar" class="btn btn-danger" >Aceptar</button>
                    
                    </div>
                </form>
            </div>
		</div>
	</div>
</div> -->



	
    

    