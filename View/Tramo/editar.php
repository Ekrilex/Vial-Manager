<?php 

    while($tramoSeleccionado = pg_fetch_assoc($tramo)){
?>
    <div class="col-md-12">
        <form action="<?php echo getUrl('Tramo','Tramo','postUpdate')?>" method="POST" class="form">
            <div class="card">

                <div class="card-header">
                    <div class="card-title">Editar Tramo : <?php echo $tramoSeleccionado['tra_codigo']; ?></div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label>Nombre que lleva la via</label>
                                <input type="text" class="form-control valCaracteresEspeciales" name="tra_nombre_via" id="inputNombreVia" value="<?php echo $tramoSeleccionado['tra_nombre_via'];?>" maxlength="30" placeholder="Nombre Via" required>
                                <div id="error"></div>
                            </div>

                            <div class="form-group form-inline" style="margin-left:30px;">
                                <label for="inlineinput" class="col-md-5 col-form-label">ancho inicio (Metros)</label>
                                <div class="col-md-5 p-1">
                                    <input type="number" class="form-control input-full valAncho" name="tra_ancho_inicio" value="<?php echo $tramoSeleccionado['tra_ancho_inicio'];?>" id="inlineinput" min="0" max="10" step="0.1" placeholder="Metros" required> 
                                </div>
                            </div>

                            <div class="form-group form-inline" style="margin-left:30px;">
                                <label for="inlineinput" class="col-md-5 col-form-label">ancho fin (Metros)</label>
                                <div class="col-md-5 p-1">
                                    <input type="number" class="form-control input-full valAncho" name="tra_ancho_fin" value="<?php echo $tramoSeleccionado['tra_ancho_fin'];?>" id="inlineinput" min="0" max="10" step="0.1" placeholder="Metros" required>
                                </div>
                                <div id="errorAncho"></div>
                            </div>

                            <div class="form-group my-4">
                                <label>Seleccione el barrio</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-info" data-toggle="modal" data-target="#modalBarrio" type="button">Buscar</button>
                                    </div>
                                    <input type="text" style="color:black; font-weight:bold;" value="<?php echo $tramoSeleccionado['bar_descripcion'];?>" id="campoBarrio" class="form-control" placeholder="Barrio" aria-label="" aria-describedby="basic-addon1" required readonly>
                                    <input type="hidden" name="barrio_id" id="barrio_id" value="<?php echo $tramoSeleccionado['bar_id'];?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">

                            <div class="form-group">
                                <label>Ingrese la nomenclatura o direccion del tramo</label>
                                <input type="text" class="form-control" name="tra_nomenclatura" value="<?php echo $tramoSeleccionado['tra_nomenclatura'];?>" maxlength="45" placeholder="Nomenclatura/Direccion" required>
                            </div>

                            <div class="form-group form-group-default my-3">
                                <label>Tipo de Via(numero de calzadas)</label>
                                <select name="tipoCalzada" class="form-control" id="tipoCalzada" data-url="<?php echo getUrl('Tramo','Tramo','filtroCalzada',false,'ajax');?>" required>
                                    <?php 
                                        while($tipoCal = pg_fetch_assoc($tipoCalzada)){

                                            if($tipoCal['tipc_id'] == $tramoSeleccionado['tipc_id']){
                                                echo "<option value='".$tipoCal['tipc_id']."' selected>".$tipoCal['tipc_descripcion']."</option>";
                                            }else{
                                                echo "<option value='".$tipoCal['tipc_id']."'>".$tipoCal['tipc_descripcion']."</option>";
                                            }
                                            
                                        }
                                    
                                    ?>
                                </select>
                            </div>

                            <div class="form-group form-group-default">
                                <label>Elemento Complementario</label>
                                <select name="elemento_id" class="form-control" required>
                                    <?php 
                                    
                                        while($ele = pg_fetch_assoc($elementos)){
                                            if($ele['ele_id'] == $tramoSeleccionado['elemento_id']){
                                                echo "<option value='".$ele['ele_id']."' selected>".$ele['ele_descripcion']."</option>";
                                            }else{
                                                echo "<option value='".$ele['ele_id']."'>".$ele['ele_descripcion']."</option>";
                                            }

                                                
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Seleccione el Eje Vial</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-danger" data-toggle="modal" id="buscarEje" data-url="<?php echo getUrl('Tramo','Tramo','enviarEje',false,'ajax');?>" data-paginacionUrl="<?php echo getUrl("Tramo","Tramo","getPaginacionEje",false,"ajax"); ?>" data-target="#modalEje" type="button">Buscar</button>
                                    </div>
                                    <input type="text" style="color:black; font-weight:bold;" id="campoEje" value="<?php echo "Eje Vial Numero: ".$tramoSeleccionado['eje_numero'];?>" class="form-control" placeholder="Eje Vial" aria-label="" aria-describedby="basic-addon1" required readonly>
                                    <input type="hidden" name="eje_vial_id" id="eje_vial_id" value="<?php echo $tramoSeleccionado['eje_id'];?>">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label>Ingrese el N° del segmento del tramo</label>
                                <input type="number" class="form-control valSegmento" name="tra_segmento" value="<?php echo $tramoSeleccionado['tra_segmento'];?>" min="0" max="99999" placeholder="Segmento" required>
                                <div id="errorSegmento"></div>
                            </div>
                            <div class="form-group form-group-default my-3">
                                <label>Calzada</label>
                                <select name="calzada_id" class="form-control" id="calzada" required>
                                    <?php 
                                        while($calzada = pg_fetch_assoc($calzadas)){
                                            if($calzada['cal_id'] == $tramoSeleccionado['calzada_id']){
                                                echo "<option value='".$calzada['cal_id']."' selected>".$calzada['cal_calzada']." - ".$calzada['cal_orientacion_carril']."</option>";
                                            }else{
                                                echo "<option value='".$calzada['cal_id']."'>".$calzada['cal_calzada']." - ".$calzada['cal_orientacion_carril']."</option>";
                                            }
                                           
                                        }
                                    
                                    ?>
                                </select>
                                <!--los desplegables se corregiran cuando se incorpore el back con la base de datos-->
                            </div>
                            <div class="form-group form-group-default my-3">
                                <label>Jerarquia Vial</label>
                                <select name="jerarquia_vial_id" class="form-control" id="jerarquiaSelect" required>
                                    <?php 

                                        while($jerarquia = pg_fetch_assoc($jerarquias)){
                                            if($jerarquia['jer_id'] == $tramoSeleccionado['jerarquia_vial_id']){
                                                echo "<option value='".$jerarquia['jer_id']."' selected>".$jerarquia['jer_descripcion']."</option>";
                                            }else{
                                                echo "<option value='".$jerarquia['jer_id']."'>".$jerarquia['jer_descripcion']."</option>";
                                            }
                                        }
                                    
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-action">
                    <div id="cambiarEje"></div>
                    <a class="btn btn-secondary" href="<?php echo getUrl('Tramo','Tramo','getDetail',array("tra_id" => $tramoSeleccionado['tra_id']));?>">Volver</a>
                    <input type="hidden" name="tra_id" id="tra_id" value="<?php echo $tramoSeleccionado['tra_id'];?>">
                    <button class="btn btn-success" id="guardarRegistro">Guardar Cambios</button>
                </div>
            </div>
        </form>
    </div>

    <div class="modal col-md-12 col-sm-12" id="modalBarrio">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header btn-primary">
                    <h3 class="modal-title text-white">Buscar Barrio</h3>
                </div>
                <div class="modal-body btn-default">

                    <div class="form-group col-md-4">
                        <label class="text-white">Buscar: </label>
                        <input type="text" name="buscadorBarrio" id="buscadorBarrio" data-url="<?php echo getUrl('Tramo', 'Tramo', 'FiltroBarrio', false, 'ajax') ?>" data-paginacionUrl="<?php echo getUrl("Tramo","Tramo","getPaginacionBarrioFiltro",false,"ajax"); ?>" class="form-control border border-secondary">
                    </div>
                    <div class="form-group">
                        <table class="table table-head-bg-secondary table-hover" style="text-align:center;">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Comuna</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody id="contenidoModalBarrio">
                                <?php

                                    while($bar = pg_fetch_assoc($barrios)){
                                        echo "<tr>";
                                            echo "<td>".$bar['bar_id']."</td>";
                                            echo "<td>".$bar['bar_descripcion']."</td>";
                                            echo "<td>".$bar['com_id']."</td>";
                                            echo "<td>"
                                            ."<button class='btn btn-primary' id='seleccionarBarrio' value='".$bar['bar_id']."' data-url='".getUrl('Tramo','Tramo','elegirBarrio',false,'ajax')."'>Seleccionar</button>"
                                            ."</td>";
                                        echo "</tr>";
                                    }

                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="contenidoPaginacionBarrio">
                        <nav>
                            <div id="cuentaPaginasB"><?php echo "Pagina 1 De ".$numeroPaginas;?></div>
                            <ul class="pagination justify-content-end">
                                        
                                <li class="page-item text-dark disabled" id="anteriorB"><a class="page-link paginacionStaticB" data-paginasTotales="<?php echo $numeroPaginas;?>" data-accion="0" data-urlPagina="<?php echo getUrl("Tramo","Tramo","postPaginacionBarrio",false,"ajax");?>">Anterior</a></li>
                                    <?php 
                                        for($i = 0;$i<$numeroPaginas;$i++){
                                            if(($i+1) >= $inicioCuenta && ($i+1) <= $finCuenta){

                                                if($i == 0){
                                                    echo "<li class='page-item active' id='paginaB".($i+1)."'><a class='page-link elemPaginacionB' data-numeroPagina='".$i."' data-paginasTotales='".$numeroPaginas."' data-urlPagina='".getUrl("Tramo","Tramo","postPaginacionbarrio",false,"ajax")."'>".($i+1)."</a></li>";
                                                }else{
                                                    echo "<li class='page-item text-dark' id='paginaB".($i+1)."'><a class='page-link elemPaginacionB' data-numeroPagina='".$i."' data-paginasTotales='".$numeroPaginas."' data-urlPagina='".getUrl("Tramo","Tramo","postPaginacionBarrio",false,"ajax")."'>".($i+1)."</a></li>";
                                                }

                                            }else{

                                                echo "<li class='page-item text-dark' style='display:none;' id='paginaB".($i+1)."'><a class='page-link elemPaginacionB' data-numeroPagina='".$i."' data-paginasTotales='".$numeroPaginas."' data-urlPagina='".getUrl("Tramo","Tramo","postPaginacionBarrio",false,"ajax")."'>".($i+1)."</a></li>";

                                            }
                                        }
                                            
                                    ?>
                                <li class="page-item text-dark <?php if($numeroPaginas == 1){ echo "disabled";} ?>" id="siguienteB"><a class="page-link paginacionStaticB" data-paginasTotales="<?php echo $numeroPaginas;?>" data-accion="1" data-urlPagina="<?php echo getUrl("Tramo","Tramo","postPaginacionBarrio",false,"ajax");?>">Siguiente</a></li>
                            </ul>
                            <input type='hidden' id="inicioCuentaBarrio" value="<?php echo $inicioCuenta;?>">
                            <input type='hidden' id="finCuentaBarrio" value="<?php echo $finCuenta;?>">
                        </nav>  
                    </div>
                </div>
                <div class="modal-footer btn-default">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal col-md-12 col-sm-12" id="modalEje">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header btn-danger">
                    <h3 class="modal-title text-white">Buscar Eje</h3>
                </div>
                <div class="modal-body btn-default">

                    <div class="form-group col-md-4">
                        <label class="text-white">Buscar: </label>
                        <input type="text" name="buscadorEje" id="barraBuscarEje" data-url="<?php echo getUrl('Tramo', 'Tramo', 'filtroEje', false, 'ajax') ?>" data-paginacionUrl="<?php echo getUrl("Tramo","Tramo","getPaginacionEjeFiltro",false,"ajax"); ?>" class="form-control border border-secondary">
                    </div>
                    <div class="form-group">
                        <table class="table table-head-bg-info table-hover" style="text-align:center;">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Numero</th>
                                    <th>Jerarquia</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody id="contenidoEje">

                            </tbody>
                        </table>

                    </div>
                    <div id="contenidoPaginacion">
                                              
                    </div>
                </div>
                <div class="modal-footer btn-default">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<?php 
    }
?>

