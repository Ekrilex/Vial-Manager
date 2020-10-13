<?php 
    while($tramoSeleccionado = pg_fetch_assoc($tramo)){

    

?>
    <div class="page-inner">
        <div class="row" id="contenidoFormulario">
            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">
                        <div class="card-title">Detalle Tramo</div>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Codigo del tramo</label>
                                    <input type="text" class="form-control" style="color:black; font-weight:bold;" placeholder="Codigo" value="<?php echo $tramoSeleccionado['tra_codigo'];?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Nombre que lleva la via</label>
                                    <input type="text" class="form-control" style="color:black; font-weight:bold;" placeholder="Nombre Via" value="<?php echo $tramoSeleccionado['tra_nombre_via'];?>" readonly>
                                </div>

                                <div class="form-group form-inline" style="margin-left:30px;">
                                    <label for="inlineinput" class="col-md-4 col-form-label">ancho inicio</label>
                                    <div class="col-md-5 p-1">
                                        <input type="number" style="color:black; font-weight:bold;" class="form-control input-full" value="<?php echo $tramoSeleccionado['tra_ancho_inicio'];?>" id="inlineinput" readonly> Metros
                                    </div>
                                </div>

                                <div class="form-group form-inline" style="margin-left:30px;">
                                    <label for="inlineinput" class="col-md-4 col-form-label">ancho fin</label>
                                    <div class="col-md-5 p-1">
                                        <input type="number" style="color:black; font-weight:bold;" class="form-control input-full" value="<?php echo $tramoSeleccionado['tra_ancho_fin'];?>" id="inlineinput" readonly> Metros
                                        
                                    </div>
                                    
                                    
                                
                                </div>

                                <div class="form-group">
                                    <label>Barrio en el que se encuentra</label>
                                    <div class="input-group">
                                        <input type="text" style="color:black; font-weight:bold;" value="<?php echo $tramoSeleccionado['bar_descripcion'];?>" class="form-control" placeholder="Barrio" aria-label="" aria-describedby="basic-addon1" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Comuna respectiva</label>
                                    <div class="input-group">
                                        <input type="text" style="color:black; font-weight:bold;" value="<?php echo $tramoSeleccionado['comuna_id'];?>" class="form-control" placeholder="Barrio" aria-label="" aria-describedby="basic-addon1" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">

                                <div class="form-group">
                                    <label>Nomenclatura o Direccion</label>
                                    <input type="text" style="color:black; font-weight:bold;" class="form-control" value="<?php echo $tramoSeleccionado['tra_nomenclatura'];?>" placeholder="Nomenclatura/Direccion" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Tipo de Via(numero de calzadas)</label>
                                    <input type="text" style="color:black; font-weight:bold;" class="form-control" value="<?php echo $tramoSeleccionado['tipc_descripcion'];?>" placeholder="Tipo de calzada" readonly >
                                </div>

                                <div class="form-group">
                                    <label>Elemento Complementario</label>
                                    <input type="text" style="color:black; font-weight:bold;" class="form-control" value="<?php echo $tramoSeleccionado['ele_descripcion'];?>" placeholder="Elemento complementario" readonly >
                                </div>

                                <div class="form-group my-1">
                                    <label>Eje Vial al que es miembro</label>
                                    <div class="input-group">
                                        <input type="text" style="color:black; font-weight:bold;" class="form-control" value="<?php echo "Eje Vial: ".$tramoSeleccionado['eje_numero']; ?>" placeholder="Eje Vial" aria-label="" aria-describedby="basic-addon1" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Ultimo usuario que modific&oacute; el tramo</label>
                                    <div class="input-group">
                                        <input type="text" style="color:black; font-weight:bold;" class="form-control" value="<?php echo $tramoSeleccionado['usu_primer_nombre']." ".$tramoSeleccionado['usu_segundo_nombre']." ".$tramoSeleccionado['usu_primer_apellido']." ".$tramoSeleccionado['usu_segundo_apellido']; ?>" placeholder="Eje Vial" aria-label="" aria-describedby="basic-addon1" readonly>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Numero de Segmento del tramo</label>
                                    <input type="number" style="color:black; font-weight:bold;" class="form-control" value="<?php echo $tramoSeleccionado['tra_segmento'];?>" placeholder="Segmento" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Calzada</label>
                                    <input type="text" style="color:black; font-weight:bold;" class="form-control" value="<?php echo $tramoSeleccionado['cal_calzada']." - ".$tramoSeleccionado['cal_orientacion_carril'];?>" placeholder="Calzada" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Jerarquia Vial</label>
                                    <input type="text" style="color:black; font-weight:bold;" class="form-control" value="<?php echo $tramoSeleccionado['jer_descripcion'];?>" placeholder="Jerarquia Vial" readonly>
                                </div>
                                <div class="form-group my-1">
                                    <label>Fecha Creacion</label>
                                    <input type="text" style="color:black; font-weight:bold;" class="form-control" value="<?php echo $tramoSeleccionado['tra_fecha_creacion'];?>" placeholder="Fecha Creacion" readonly>
                                </div>
                                <div class="form-group my-1">
                                    <label>Estado</label>
                                    <?php 
                                        
                                        if($tramoSeleccionado['estado_id'] == 1){
                                            $colorEstado = "rgb(0,250,0)";
                                        }else if($tramoSeleccionado['estado_id'] == 2){
                                            $colorEstado = "red";
                                        }
                                    ?>
                                    <input type="text" style="color:<?php echo $colorEstado;?>; font-weight:bold;" class="form-control" value="<?php echo $tramoSeleccionado['est_descripcion'];?>" placeholder="Estado" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="modal col-md-12 col-sm-12" id="modalInhabilitar">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header btn-danger">
                                        <h3 class="modal-title text-white">Inhabilitar Tramo</h3>
                                    </div>
                                    <div class="modal-body btn-default">
                                        <label>Est&aacute; seguro que desea inhabilitar este tramo?</label>
                                    </div>
                                    <div class="modal-footer btn-default">
                                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                                            
                                        <a href="<?php echo getUrl('Tramo','Tramo','postDelete',array("tra_id"=>$tramoSeleccionado['tra_id'],"tra_codigo"=>$tramoSeleccionado['tra_codigo']))?>"><button type="button" class="btn btn-secondary">Inhabilitar</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        

                    </div>

                    <div class="card-action">
                        <a class="btn btn-secondary" href="<?php echo getUrl('Tramo','Tramo','index')?>">Salir</a>
                        <button class="btn btn-info" id="editarTramo" data-url="<?php echo getUrl("Tramo","Tramo","getUpdate",false,"ajax");?>" data-id="<?php echo $tramoSeleccionado['tra_id'];?>">Editar</button>
                        <?php 
                            
                            if($tramoSeleccionado['estado_id' ]== 1){
                                echo "<button class='btn btn-danger' data-toggle='modal' id='inhabilitarTramo' data-target='#modalInhabilitar'>Inhabilitar</button>";
                            }else{
                                echo "<button class='btn btn-success' data-toggle='modal' id='habilitarTramo' data-target='#modalHabilitar'>Habilitar</button>";
                            }
                        ?>
                        
                    </div>
                    <div class="modal col-md-12 col-sm-12" id="modalHabilitar">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                <div class="modal-header btn-success">
                                    <h3 class="modal-title text-white">Habilitar Tramo</h3>
                                </div>
                                <div class="modal-body btn-default">
                                    <label>Est&aacute; seguro que desea Habilitar este tramo?</label>
                                </div>
                                <div class="modal-footer btn-default">
                                    <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                                            
                                    <a href="<?php echo getUrl('Tramo','Tramo','postActivate',array("tra_id"=>$tramoSeleccionado['tra_id'],"tra_codigo"=>$tramoSeleccionado['tra_codigo']))?>"><button type="button" class="btn btn-info">Habilitar</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    
                </div>
            </div>

        </div>
    </div>
<?php 
    }

?>