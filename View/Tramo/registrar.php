<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <form action="<?php echo getUrl('Tramo','Tramo','postCreate')?>" method="POST">
                <div class="card">
            
                    <div class="card-header">
                        <div class="card-title">Registrar Tramo</div>
                    </div>
                    <div class="card-body">
                    
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Ingrese el nombre que lleva la via</label>
                                    <input type="text" class="form-control" name="tra_nombre_via" maxlength="30" placeholder="Nombre Via" required>
                                </div>

                                <div class="form-group form-inline" style="margin-left:30px;">
                                    <label for="inlineinput" class="col-md-3 col-form-label">ancho inicio</label>
                                    <div class="col-md-4 p-1">
                                        <input type="number" class="form-control input-full" name="tra_ancho_inicio" id="inlineinput" min="0" max="10" step="0.1" required>
                                    </div>
                                </div>

                                <div class="form-group form-inline" style="margin-left:30px;">
                                    <label for="inlineinput" class="col-md-3 col-form-label">ancho fin</label>
                                    <div class="col-md-4 p-1">
                                        <input type="number" class="form-control input-full" name="tra_ancho_fin" id="inlineinput" min="0" max="10" step="0.1" required>
                                    </div>
                                </div>

                                <div class="form-group my-4">
                                    <label>Seleccione el barrio</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-info" data-toggle="modal" data-target="#modalBarrio" type="button">Buscar</button>
                                        </div>
                                            <input type="text" style="color:black; font-weight:bold;" id="campoBarrio" class="form-control" placeholder="Barrio" aria-label="" aria-describedby="basic-addon1" required readonly>
                                            <input type="hidden" name="barrio_id" id="barrio_id" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4" >

                                <div class="form-group">
                                    <label>Ingrese la nomenclatura o direccion del tramo</label>
                                    <input type="text" class="form-control" name="tra_nomenclatura" maxlength="45" placeholder="Nomenclatura/Direccion" required>
                                </div>

                                <div class="form-group form-group-default my-3">
                                    <label>Tipo de Via(numero de calzadas)</label>
                                    <select name="tipoCalzada" class="form-control" id="tipoCalzada" data-url="<?php echo getUrl('Tramo','Tramo','filtroCalzada',false,'ajax');?>" required>
                                        <?php 
                                            while($tipoCal = pg_fetch_assoc($tipoCalzada)){
                                                echo "<option value='".$tipoCal['tipc_id']."'>".$tipoCal['tipc_descripcion']."</option>";
                                            }
                                        
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group form-group-default">
                                    <label>Elemento Complementario</label>
                                    <select name="elemento_id" class="form-control" required>
                                        <?php 
                                        
                                            while($ele = pg_fetch_assoc($elementos)){
                                                echo "<option value='".$ele['ele_id']."'>".$ele['ele_descripcion']."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Seleccione el Eje Vial</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-danger" data-toggle="modal" id="buscarEje" data-url="<?php echo getUrl("Tramo","Tramo","enviarEje",false,"ajax")?>" data-target="#modalEje" type="button">Buscar</button>
                                        </div>
                                            <input type="text" style="color:black; font-weight:bold;" id="campoEje" class="form-control" placeholder="Eje Vial" aria-label="" aria-describedby="basic-addon1" required readonly>
                                            <input type="hidden" name="eje_vial_id" id="eje_vial_id" value="">
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6 col-lg-4" >
                                <div class="form-group">
                                    <label>Ingrese el N° del segmento del tramo</label>
                                    <input type="number" class="form-control" name="tra_segmento" min="0" max="99999" placeholder="Segmento" required>
                                </div>
                                <div class="form-group form-group-default my-3">
                                    <label>Calzada</label>
                                    <select name="calzada_id" class="form-control" id="calzada" required>
                                        <?php 
                                            while($calzada = pg_fetch_assoc($calzadas)){
                                                echo "<option value='".$calzada['cal_id']."'>".$calzada['cal_calzada']." - ".$calzada['cal_orientacion_carril']."</option>";
                                            }
                                        
                                        ?>
                                    </select>
                                    <!--los desplegables se corregiran cuando se incorpore el back con la base de datos-->
                                </div>
                                <div class="form-group form-group-default my-3">
                                    <label>Jerarquia Vial</label>
                                    <select name="jerarquia_vial_id" class="form-control" id="jerarquiaSelect" required>
                                        <option value="">Seleccione</option>
                                        <?php 
                                            while($jerarquia = pg_fetch_assoc($jerarquias)){
                                                echo "<option value='".$jerarquia['jer_id']."'>".$jerarquia['jer_descripcion']."</option>";
                                            }
                                        
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    
                    </div>
            
                    <div class="card-action">
                        <a class="btn btn-secondary" href="<?php echo getUrl('Tramo','Tramo','index')?>">Cancelar</a>
                        <button class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="modal col-md-12 col-sm-12" id="modalBarrio">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                                
                        <div class="modal-header btn-primary">
                            <h3 class="modal-title text-white">Buscar Barrio</h3>
                        </div>
                        <div class="modal-body" style="background-color:rgb(0,0,45);">
                            
                                <div class="form-group col-md-4">              
                                    <label class="text-white">Buscar: </label> 
                                    <input type="text" name="buscadorBarrio" id="buscadorBarrio" data-url="<?php echo getUrl("Tramo", "Tramo", "FiltroBarrio", false, "ajax") ?>" class="form-control">
                                </div> 
                                <div class="form-group">
                                    <table class="table table-head-bg-secondary" style="text-align:center;">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Nombre</th>
                                                <th>Comuna</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
                        </div>
                        <div class="modal-footer" style="background-color:rgb(0,0,45);">
                            <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                        </div>
                </div>
            </div>
        </div>

        <div class="modal col-md-12 col-sm-12" id="modalEje">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                                
                        <div class="modal-header btn-danger">
                            <h3 class="modal-title text-white">Buscar Eje</h3>
                        </div>
                        <div class="modal-body" style="background-color:rgb(0,0,45);">
                            
                                <div class="form-group col-md-4">              
                                    <label class="text-white">Buscar: </label> 
                                    <input type="text" name="buscadorBarrio" id="barraBuscarEje" data-url="<?php echo getUrl("Tramo", "Tramo", "filtroEje", false, "ajax") ?>" class="form-control">
                                </div> 
                                <div class="form-group">
                                    <table class="table table-head-bg-info" style="text-align:center;">
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
                        </div>
                        <div class="modal-footer" style="background-color:rgb(0,0,45);">
                            <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                        </div>
                </div>
            </div>
        </div>

    </div>
</div>