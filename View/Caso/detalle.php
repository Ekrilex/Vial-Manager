<?php 

    while($casoSeleccionado = pg_fetch_assoc($casoConsulta)){


?>

    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <div class="card-title">Detalle Casos</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Id:</label>
                                    <input type="text" class="form-control" style="color:black; font-weight:bold;" placeholder="codigo caso" value="<?php echo $casoSeleccionado['cas_id'];?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Fotografia Inicio:</label>
                                    <div>
                                        <img src="<?php echo $casoSeleccionado['cas_fotografia_inicio']?>" alt="no tiene" width="200px" height="200px">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tipo De Pavimento:</label>
                                    <div>
                                        <span><?php echo $casoSeleccionado['pav_descripcion']?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <br>
                                    
                                    <?php 
                                        if($casoSeleccionado['orden_id'] == ""){
                                            $mensajeOrden = "No tiene orden vinculada";
                                        }else{
                                            $mensajeOrden = $casoSeleccionado;
                                        }
                                    ?>
                                    <label>Orden Vinculada:</label>
                                    <input type="text" class="form-control" style="color:black; font-weight:bold;" placeholder="codigo caso" value="<?php echo $mensajeOrden;?>" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Fecha de creacion:</label>
                                    <input type="text" class="form-control" style="color:black; font-weight:bold;" placeholder="Fecha de creacion" value="<?php echo $casoSeleccionado['cas_fecha_creacion'];?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Fotografia Fin:</label>
                                    <div>
                                        <img src="<?php echo $casoSeleccionado['cas_fotografia_fin']?>" alt="no tiene" width="200px" height="200px">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Ultimo Usuario que Modifico El Caso:</label>
                                    <input type="text" class="form-control" style="color:black; font-weight:bold;" placeholder="Usuario" value="<?php echo $casoSeleccionado['usu_primer_nombre']." ".$casoSeleccionado['usu_segundo_nombre']." ".$casoSeleccionado['usu_primer_apellido']." ".$casoSeleccionado['usu_segundo_apellido'];?>" readonly>

                                </div>
                                <div class="form-group">
                                    <label>Codigo Del Tramo:</label>
                                    <input type="text" class="form-control" style="color:black; font-weight:bold;" placeholder="Fecha de creacion" value="<?php echo $casoSeleccionado['tra_codigo'];?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Fecha de creacion vencimiento: </label>
                                    <input type="text" class="form-control" style="color:black; font-weight:bold;" placeholder="Fecha de vencimiento" value="<?php echo $casoSeleccionado['cas_fecha_vencimiento'];?>" readonly>
                                </div>
                                <div class="form-group">
                                    <?php 
                                    
                                        if($casoSeleccionado['cas_prioridad'] == 1 || $casoSeleccionado['cas_prioridad'] == 2){
                                                    
                                            $colorPrioridad = "rgb(0,250,0)";
                                            $nombrePrioridad = "Baja";
                                            $iconoPrioridad = "<i class='fas fa-thumbs-up text-success'></i>";

                                        }else if($casoSeleccionado['cas_prioridad'] == 3 || $casoSeleccionado['cas_prioridad'] == 4){

                                            $colorPrioridad = "rgb(250,250,0)";
                                            $nombrePrioridad = "Media";
                                            $iconoPrioridad = "<i class='fas fa-exclamation-triangle text-warning'></i>";

                                        }else if($casoSeleccionado['cas_prioridad'] > 4 && $casoSeleccionado['cas_prioridad'] <= 7){
                                            $colorPrioridad = "red";
                                            $nombrePrioridad = "Alta";
                                            $iconoPrioridad = "<i class='fas fa-flag text-danger'></i>";
                                        }
                                    ?>
                                    <label>Prioridad:</label>
                                    <div>
                                        <span style="color:<?php echo $colorPrioridad; ?>;"><?php echo $iconoPrioridad." ".$nombrePrioridad;?></span>
                                    </div>
                                    
                                    
                                </div>
                                <div class="form-group">
                                    <label>Entorno: </label>
                                    <input type="text" class="form-control" style="color:black; font-weight:bold;" placeholder="Entorno" value="<?php echo $casoSeleccionado['ent_descripcion'];?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Estado: </label>
                                    <input type="text" class="form-control" style="color:black; font-weight:bold;" placeholder="Estado" value="<?php echo $casoSeleccionado['ent_descripcion'];?>" readonly>
                                </div>
                                
                            </div>
                            <div class="col-md-12">
                                <div class="form-group col-md-14">
                                    <label>Causa:</label>
                                    <div>
                                        <textarea rows="4" style="color:black; font-weight:bold;" class="form-control col-xl-5" placeholder="Causa.." width="1000px" readonly><?php echo $casoSeleccionado['cas_causa'];?></textarea>
                                    </div>
                                </div>
                            <div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>   

<?php 

    }

?>