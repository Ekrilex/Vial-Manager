<div class="content">
    <div class="page-inner">
        <div class="card">
            <div class="card-header" id="Prueba">
                <div class="d-flex align-items-center">
                
                    <h3 class="card-title">&nbsp;Consultar Barrio</h3>

                    <a type="button" id="añadir" class="text-light btn btn-success btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                        <i class="fa fa-plus"></i>
                        Añadir Barrio
                    </a>

                </div>
            </div>
            <br>
           
                <div class="d-flex align-items-center">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label>Buscar:&nbsp;&nbsp;</label>
                    <label>
                        <input type="text" name="filtroB" id="filtroB" data-url="<?php echo getUrl("Barrio","Barrio","filtro",false,"ajax");?>" class="form-control " placeholder="Buscar... "/>
                    </label> 
                </div> 
          
            <div class="card-body">
               
                <!-- Modal Para Registrar un Barrio-->
                <?php 
                    if(isset($_SESSION['prueba'])){
                ?>
                <div class="modal" id="addRowModal">
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
                                    <form action="<?php echo getUrl("Barrio","Barrio","postIndex"); ?>" method="POST">
                                        <div class="form-group">
                                            <!-- <input type="hidden" class="form-control" id="bar_id"> -->

                                            <h4 class="text-dark">Descripción o Nombre de Barrio</h4>
                                            <input type="text" class="form-control barrioN" name="bar_nombre" id="bar_nombre" placeholder=""/>
                                        </div>
                                        <div class="form-group">
                                            <h4 class="text-dark">N&uacute;mero de la Comuna</h4>
                                            <select class="form-control" name="com" id="com" >
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
                                            <button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
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
                    $("#addRowModal").modal();
                    });
                    </script>
                <?php 
                    } unset($_SESSION['prueba']);
                ?>
                    <div class="modal" id="addRowModal">
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
                                    <form action="<?php echo getUrl("Barrio","Barrio","postIndex"); ?>" method="POST">
                                        <div class="form-group">
                                            <!-- <input type="hidden" class="form-control" id="bar_id"> -->

                                            <h4 class="text-dark">Descripción o Nombre de Barrio</h4>
                                            <input type="text" class="form-control barrioN" name="bar_nombre" id="bar_nombre" placeholder=""/>
                                        </div>
                                        <div class="form-group">
                                            <h4 class="text-dark">N&uacute;mero de la Comuna</h4>
                                            <select class="form-control" name="com" id="com" >
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
                                            <button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
                                            <input type="submit" name="Registrar" value="Registrar" class="btn btn-success">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- Aqui termina el model de registrar barrio -->
                
                <div class="table-responsive">
                    <!-- Aqui se visualiza la validacion del Registro exitoso con un mensaje -->
                    <?php 
                        if (isset($_SESSION['result'])){
                    ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo "<span class='text-success'>".$_SESSION['result']."</span>"?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
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
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?php echo "<span class='text-success'>".$_SESSION['resultEditar']."</span>"?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
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
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo "<span class='text-danger'>".$_SESSION['resultEliminar']."</span>"?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    <?php 
                        }
                        unset($_SESSION['resultEliminar']);
                    ?>
                    <!-- Aqui termina el mensaje del Registro Eliminado-->

                    <!-- <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4"> -->
                        <table class="table table-striped table-head-bg-info table-striped-bg-default mt-2">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre de Barrio</th>
                                    <th scope="col">N&uacute;mero de Comuna</th>
                                    <th scope="col">Ubicacion</th>
                                    <th scope="col">
                                        &nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;
                                        Acciones
                                    </th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <!-- <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>Edinburgh</td>
                                    <td>
                                        <div class="form-button-action">
                                            <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>-->
                                <?php
                                    while($bar=pg_fetch_assoc($barrios)){
                                    // foreach($barrios as $bar){
                                        echo "<tr>";
                                        echo "<td>".$bar['bar_id']."</td>";
                                        echo "<td>".$bar['bar_descripcion']."</td>";
                                        echo "<td>".$bar['com_id']."</td>";
                                        echo "<td>".$bar['com_ubicacion']."</td>";
                                        echo "<td> <a href='".getUrl("Barrio","Barrio","getUpdate",array("bar_id"=>$bar['bar_id']))."'>
                                            <button data-toggle='tooltip' class='btn btn-link btn-primary btn-lg' data-original-title='Editar'>
                                            <i class='icon-note'></i></button></a> </td>";
                                        echo "<td><a><button id='elimi' value='".$bar['bar_id']."' data-url='".getUrl("Barrio","Barrio","getDelete",false,"ajax")."' data-toggle='tooltip' class='btn btn-link btn-danger' data-original-title='Eliminar'>
                                            <i class='flaticon-interface-5'></i> 
                                            </button></a> </td>";
                                        echo "</tr>";
                                    }
                                
                                ?>
                            </tbody>
                        </table>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Eliminar -->
<div class="modal" id="eliminar">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title text-center text-dark" id="exampleModalLabel">Eliminar Barrio</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"></span>
				</button>
			</div>
			<div class="modal-body"><!--tener en cuenta para el ajax-->
               
                <form action="<?php echo getUrl("Barrio","Barrio","postDelete"); ?>" method="POST">
                    
                    <div id="eliminarB" class="text-dark"></div><!--tener en cuenta para el ajax-->
                  
                    <div class="form-group">
                        <h4 class="text-dark">¿Esta seguro de elimanar el barrio?</h4>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
                        <input type="submit" name="Aceptar" value="Aceptar" class="btn btn-danger">
                    </div>
                </form>
            </div>
		</div>
	</div>
</div>