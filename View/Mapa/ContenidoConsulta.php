<div id="Formulario">
                                        <div class='form-row'>
                                            <div class='form-group col-md-6'>
                                                <label>Fecha Creacion: </label>
                                                <input type='text' class='form-control text-dark' style='font-weight:bold;' value="<?php echo $casoEncontrado['cas_fecha_creacion'];?>" readonly>
                                            </div>
                                            <div class='form-group col-md-6'>
                                                <label>Fecha Vencimiento: </label>
                                                <input type='text' class='form-control text-dark' style='font-weight:bold;' value="<?php echo $casoEncontrado['cas_fecha_vencimiento'];?>" readonly>
                                            </div>
                                            
                                        </div>
                                        <div class="form-row">
                                            <div class='form-group col-md-6 '>
                                                <?php

                                                    if ($casoEncontrado['cas_prioridad'] == 1 || $casoEncontrado['cas_prioridad'] == 2) {

                                                        $resultado = "<p class='text-success'><i class='fas fa-thumbs-up text-success'></i>✔&nbsp;Baja</p>";
                                                    } else if ($casoEncontrado['cas_prioridad'] == 3 || $casoEncontrado['cas_prioridad'] == 4) {

                                                        $resultado = "<p class='text-warning'><i class='fas fa-exclamation-triangle text-warning'></i>⚠️&nbsp;Media</p>";
                                                    } else if ($casoEncontrado['cas_prioridad'] > 4 && $casoEncontrado['cas_prioridad'] <= 7) {
                                                        
                                                        $resultado = "<p class='text-danger'><i class='fas fa-flag text-danger'></i>🚫&nbsp;Alta</p>";
                                                    }
                                                ?>
                                            
                                                <label>Prioridad: &nbsp;<span data-toggle="tooltip" data-placement="right" title="1 y 2: baja, 3 y 4: media, 5,6 y 7: alta"><i class="fas fa-info-circle text-light"></i></span></label>
                                                <span><?php echo $resultado;?></span>&nbsp;
                                            </div>
                                            <div class='form-group col-md-6'>
                                                <label>Tipo de pavimento: </label>
                                                <br>
                                                <span><?php echo $casoEncontrado['pav_descripcion'];?></span>
                                            </div>
                                        </div>
                                        <div class="form-row mt--5">
                                            <div class="form-group col-md-6">
                                                <label>Entorno: </label>
                                                <input type="text" class="form-control" style="color:black; font-weight:bold;" placeholder="Entorno" value="<?php echo $casoEncontrado['ent_descripcion']; ?>" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Codigo Del Tramo:</label>
                                                <input type="text" class="form-control" style="color:black; font-weight:bold;" placeholder="Tramo" value="<?php echo $casoEncontrado['tra_codigo']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class='form-row'>
                                            <div class='form-group col-md-6'>
                                                <label>Imagen Inicial del caso</label><br>
                                                <img src="<?php echo "".$casoEncontrado['cas_fotografia_inicio'];?>" alt='no tiene' width='350px' height='250px' >
                                            </div>

                                            <div class='form-group col-md-6'>
                                                <label>Imagen despues de la intervencion</label><br>
                                                <?php 
                                                    if($casoEncontrado['cas_fotografia_fin'] != ""){
                                                ?>
                                                <img src="<?php echo "".$casoEncontrado['cas_fotografia_fin'];?>" alt='no tiene' width='350px' height='250px' >
                                                <?php 
                                                    }else{
                                                        echo "<h5><span><i class='fas fa-info-circle'></i></span>&nbsp;!Este caso aun no dispone de foto final</h5>";
                                                    }
                                                
                                                ?>
                                            </div>
                                            
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6" >
                                                <?php
                                                if ($casoEncontrado['est_id'] == 3 || $casoEncontrado['est_id'] == 4) {

                                                    $colorEstado = "rgb(255, 119, 0)";
                                                }

                                                if ($casoEncontrado['est_id'] == 2) {
                                                    $colorEstado = "rgb(250,0,0)";
                                                }

                                                if ($casoEncontrado['est_id'] == 5) {
                                                    $colorEstado = "rgb(0,250,0)";
                                                }
                                                ?>
                                                <span id="form-estado">
                                                    <label>Estado: </label>
                                                    <input type="text" class="form-control" style="color:<?php echo $colorEstado; ?>; font-weight:bold;" placeholder="Estado" value="<?php echo $casoEncontrado['est_descripcion']; ?>" readonly>
                                                </span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <?php
                                                if ($casoEncontrado['orden_id'] == "") {
                                                    $mensajeOrden = "No tiene orden vinculada";
                                                } else {
                                                    $mensajeOrden = $casoEncontrado['orden_id'];
                                                }
                                                ?>
                                                <label>Orden Vinculada:</label>
                                                <input type="text" class="form-control" style="color:black; font-weight:bold;" placeholder="codigo caso" value="<?php echo $mensajeOrden; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-row col-md-12">
                                            <label>Causa:</label>
                                            <textarea class="form-control" style="color:black; font-weight:bold; resize:none;" placeholder="Causa.." rows="4" maxlength="200" readonly><?php echo $casoEncontrado['cas_causa']?></textarea>
                                        </div>
                                        <div class="form-row col-md-12 mt-5">
                                            <table class="table table-hover table-striped table-head-bg-danger" border="1" style="text-align:center;">
                                                <thead>
                                                    <tr>
                                                        <th colspan="6">Deterioros que presenta la via</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Codigo</th>
                                                        <th>Nombre</th>
                                                        <th>Gravedad</th>
                                                        <th>Area</th>
                                                        <th>Tipo</th>
                                                        <th>Clasificacion</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($deteriorosCaso = pg_fetch_assoc($deteriorosConsulta)) {
                                                        echo "<tr>";
                                                        echo "<td>" . $deteriorosCaso['det_id'] . "</td>";
                                                        echo "<td>" . $deteriorosCaso['det_nombre'] . "</td>";
                                                        echo "<td>" . $deteriorosCaso['cas_det_gravedad'] . "</td>";
                                                        echo "<td>" . $deteriorosCaso['cas_det_area'] . "</td>";
                                                        echo "<td>" . $deteriorosCaso['det_tipo_deterioro'] . "</td>";
                                                        echo "<td>" . $deteriorosCaso['det_clasificacion'] . "</td>";
                                                        echo "</tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>