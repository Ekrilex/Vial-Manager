<div class="row">
    <div class="col-md-11 formulario">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Registrar Tramo</div>
            </div>
            <div class="card-body">
                <form action="<?php echo getUrl('Tramo','Tramo','postCreate')?>" method="POST">
                    <div class="row">
                        <div class="col-md-6 col-lg-4" >
                            <div class="form-group">
                                <label>Ingrese el nombre que lleva la via</label>
                                <input type="text" class="form-control" name="tra_nombre_via" maxlength="30" placeholder="Nombre Via" required>
                            </div>

                            <div class="form-group form-inline" style="margin-left:30px;">
                                <label for="inlineinput" class="col-md-3 col-form-label">ancho inicio</label>
                                <div class="col-md-4 p-1">
                                    <input type="number" class="form-control input-full" name="tra_ancho_inicio" id="inlineinput" min="0" max="10" step="0.1">
                                </div>
                            </div>

                            <div class="form-group form-inline" style="margin-left:30px;">
                                <label for="inlineinput" class="col-md-3 col-form-label">ancho fin</label>
                                <div class="col-md-4 p-1">
                                    <input type="number" class="form-control input-full" name="tra_ancho_fin" id="inlineinput" min="0" max="10" step="0.1">
                                </div>
                            </div>

                            <div class="form-group my-4">
                                <label>Seleccione el barrio</label>
                                <input type="text" class="form-control" name="Barrio_id" placeholder="Barrio" required>
                                <!--aun se debe definir la forma de seleccionar el barrio-->
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4" >

                            <div class="form-group">
                                <label>Ingrese la nomenclatura o direccion del tramo</label>
                                <input type="text" class="form-control" name="tra_nomenclatura" maxlength="45" placeholder="Nomenclatura/Direccion" required>
                            </div>

                            <div class="form-group form-group-default my-3">
                                <label>Tipo de Via(numero de calzadas)</label>
                                <select name="tipoCalzada" class="form-control">
                                    <option value="0">0 - tramo basico</option>
                                    <option value="2">2 - dos carriles</option>
                                    <option value="4">4 - cuatro carriles</option>
                                </select>
                            </div>

                            <div class="form-group form-group-default">
                                <label>Elemento Complementario</label>
                                <select name="Elemento_id" class="form-control">
                                    <option value="0">Tramo Basico</option>
                                    <option value="1">Enlace a la izquierda</option>
                                    <option value="2">Enlace a la derecha</option>
                                    <option value="3">Carril de giro a la izquierda</option>
                                    <option value="4">Retorno al separador central</option>
                                    <option value="5">interseccion en vias de dos o mas calzadas</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Seleccione el Eje Vial</label>
                                <input type="text" class="form-control" name="Eje_id" placeholder="Eje Vial" required>
                                <!--aun se debe definir la forma de seleccionar el Eje vial-->
                            </div>

                        </div>
                        <div class="col-md-6 col-lg-4" >
                            <div class="form-group">
                                <label>Ingrese el segmento del tramo</label>
                                <input type="number" class="form-control" name="tra_segmento" maxlength="5" min="0" max="99999" placeholder="Segmento" required>
                            </div>
                            <div class="form-group form-group-default my-3">
                                <label>Calzada</label>
                                <select name="Calzada_id" class="form-control">
                                    <option value="0">0 - tramo basico</option>
                                    <option value="1">1 - exterior izquierda</option>
                                    <option value="2">2 - interior izquierda</option>
                                    <option value="3">3 - interior derecha</option>
                                    <option value="4">4 - exterior derecha</option>
                                </select>
                                <!--los desplegables se corregiran cuando se incorpore el back con la base de datos-->
                            </div>
                            <div class="form-group form-group-default my-3">
                                <label>Jerarquia Vial</label>
                                <select name="Jerarquia_Vial_id" class="form-control">
                                    <option value="">Seleccione</option>
                                    <option value="1">Arteria Principal</option>
                                    <option value="2">Arteria Secundaria</option>
                                    <option value="3">Via Colectora</option>
                                    <option value="4">Via Local</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-action">
                 <button class="btn btn-secondary">Cancelar</button>
                <button class="btn btn-success">Guardar</button>
            </div>
        </div>
            
    </div>
    

</div>