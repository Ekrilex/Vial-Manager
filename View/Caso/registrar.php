<div class="page-inner">
    <form action="<?php echo getUrl("Caso","Caso","postCreate",false,"ajax")?>" method="post">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Registrar Caso</div>
                </div>
                <div class="card-body">
                    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Entorno</label>
                            <div class="input-group">
                                <input type="text" class="form-control" style="color:black;" name="entorno" id="entorno" value="Entorno" readonly>
                                    <div class="input-group-prepend">
                                        <!-- <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modalEntorno" ><span class="btn-label"><i class="fas fa-street-view"></i></span>Hola</button> -->
                                        <button class="btn btn-success" data-toggle="modal" data-target="#modalEntorno" type="button">
											<span class="btn-label">
												<i class="fas fa-street-view"></i>
											</span>
											Buscar
										</button>
                                    </div>
                                <input type='hidden' name="entorno_id" id="entorno_id" value="">
                            </div>
                        </div>
                        
                        <div class="form-group col-md-4">
                            <label>Tramo</label>
                            <div class="input-group">
                                <input type="text" class="form-control" style="color:black;" name="tramo_id" id="tramo" value="Tramo" readonly>
                                    <div class="input-group-prepend">
                                        <!-- <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#modalTramo" ><i class="fas fa-road"></i></button> -->
                                        <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#modalTramo">
											<span class="btn-label">
												<i class="fas fa-road"></i>
											</span>
											Buscar
										</button>
                                    </div>
                                    <input type='hidden' name="tramo_id" id="tramo_id" value="">
                            </div>
                        </div>
                        
                        <div class="form-group col-md-4">
                            <label>Deterioro</label>
                            <div class="input-group">
                                <input type="text" class="form-control" style="color:black;" name="deterioro" id="deterioro" value="Deterioro" readonly>
                                <div class="input-group-prepend">
                                    <!-- <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#modalDeterioro" ><i class="fas fa-map-pin"></i></button> -->
                                    <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#modalDeterioro">
											<span class="btn-label">
												<i class="fas fa-map-pin"></i>
											</span>
											Buscar
										</button>
                                 </div>
                                 <input type='hidden' name="deterioro_id" id="deterioro_id" value="">
                                </div>
                        </div>
                        
                    </div>
                    

                    <div class="form-row mt-3">
                        <div class="form-group form-group-default col-md-6">
                            <label>Adjuntar Imagen inicial de la via</label>
                            <input type="file" class="form-control" name="cas_fotografia_inicio" id="fotografia_inicio">
                        </div>  
                        <div class="form-group form-group-default col-md-5 ml-3">
                            <label>Seleccione el tipo de pavimento</label>
                            <select name="tipo_pavimento_id" class="form-control">
                                <?php 
                                    while($tiposP = pg_fetch_assoc($eject2)){
                                        echo "<option value='".$tiposP['pav_id']."'>".$tiposP['pav_descripcion']."</option>";
                                    }
                                ?>
                            </select>            
                        </div>
                    </div>
                    <div class="form-row col-md-12">
                        <label>Causa</label>
                        <textarea class="form-control" name="cas_causa" id="cas_causa" rows="4" maxlength="200"></textarea>
                    </div>

                    <div id="campos" class="form-row col-md-3">

                    </div>
                </div>
                <div class="card-action">
                    <div></div>
                        <button type="submit" class="btn btn-danger">Cancelar</button>
                        <button type="submit" class="btn btn-success ml-2" id="enviar">Aceptar</button>          
                    </div>
                </div>
            </div>
        </div>
    </form>
                <?php 
                    include_once '../View/Caso/modalEntorno.php';
                    include_once '../View/Caso/modalDeterioro.php';
                    include_once '../View/Caso/modalTramo.php';
                ?>
</div>
