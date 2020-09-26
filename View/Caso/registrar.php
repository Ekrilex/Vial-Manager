<div class="page-inner">
    <form id="form_case" action="<?php echo getUrl("Caso", "Caso", "postCreate"); ?>" method="POST" enctype="multipart/form-data">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Registrar Caso</div>
                </div>

                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Entorno</label>
                            <div class="input-group bg-info">
                                <input type="text" class="form-control" style="color:black;" name="entorno" id="entorno" value="Entorno" readonly>
                                <div class="input-group-prepend">
                                    <button class="btn btn-default" data-toggle="modal" data-target="#modalEntorno" type="button">
                                        <span class="btn-label">
                                            <i class="fas fa-street-view"></i>
                                        </span>
                                        Buscar
                                    </button>
                                </div>
                                <input class="validacion" type='hidden' name="entorno_id" id="entorno_id" value="">
                            </div>
                            <small id="ad1" class="form-text text-muted text-danger"></small>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Tramo</label>
                            <div class="input-group bg-info">
                                <input type="text" class="form-control" style="color:black;" name="tramo_id" id="tramo" value="Tramo" readonly>
                                <div class="input-group-prepend">
                                    <button class="btn btn-default" type="button" data-toggle="modal" data-target="#modalTramo">
                                        <span class="btn-label">
                                            <i class="fas fa-road"></i>
                                        </span>
                                        Buscar
                                    </button>
                                </div>
                                <input class="validacion" type='hidden' name="tramo_id" id="tramo_id" value="">
                                <input class="validacion" type='hidden' name="tra_ancho_inicio" id="ancho_inicio" value="">
                                <input class="validacion" type='hidden' name="tra_ancho_fin" id="ancho_fin" value="">
                            </div>
                            <small id="ad2" class="form-text text-muted text-danger"></small>
                        </div>
                    </div>

                    <div class="form-row mt-4">
                        <div class="form-group form-group-default col-md-6">
                            <label>Adjuntar Imagen inicial de la via</label>
                            <input type="file" class="form-control validacion" name="cas_fotografia_inicio" id="fotografia_inicio">
                        </div>

                        <div class="form-group form-group-default col-md-5 ml-3">
                            <label>Seleccione el tipo de pavimento</label>
                            <select name="tipo_pavimento_id" class="form-control validacion">
                                <?php
                                while ($tiposP = pg_fetch_assoc($eject2)) {
                                    echo "<option value='" . $tiposP['pav_id'] . "'>" . $tiposP['pav_descripcion'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row col-md-12 mt-3">
                        <label>Causa</label>
                        <textarea class="form-control validacion" name="cas_causa" id="cas_causa" rows="4" maxlength="200"></textarea>
                        <small id="ad5" class="form-text text-muted text-danger"></small>
                    </div>

                    <div class="form-row">

                        <!-- <div id="div_det"> -->
                        <div id="d1" class="form-group col-md-5 mt-2">
                            <label>Deterioro</label>
                            <div class="input-group bg-info">
                                <input type="text" class="form-control inputcito text-black" id="inputDeterioro1" style="color:black;" name="deterioro" value="Deterioro" readonly>
                                <div class="input-group-prepend">
                                    <button class="btn btn-default botonInput" id="1" type="button" data-toggle="modal" onclick="enviarID(this.id);" data-target="#modalDeterioro">
                                        <span class="btn-label">
                                            <i class="fas fa-directions"></i>
                                        </span>
                                        Buscar
                                    </button>
                                </div>
                                <input type='hidden' class="inputcito_hidden validacion" name="deterioros[]" id="deterioro_id" value="">
                            </div>
                            <small id="ad6" class="form-text text-muted text-danger"></small>
                        </div>

                        <div id="d2" class="form-group col-md-2 mt-2" style="padding: 15px">
                            <label>Gravedad</label>
                            <select name="gravedades[]" class="form-control validacion">
                                <option value="" selected>Seleccione</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                            <small id="ad7" class="form-text text-muted text-danger"></small>
                        </div>

                        <div id="d3" class="form-group" style="margin-top: 13px;">
                            <label>Area</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                <div class="input-group-append">
                                    <span class="input-group-text">m</span>
                                </div>
                            </div>
                        </div>

                        <!-- <div id="d3" class="form-group" style="padding: 12px">
                            <label>Area</label>
                            <div class="input-group">
                                <input type="number" name="areas[]" class="form-control validacion">
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">M</span>
                            </div>
                            <small id="ad8" class="form-text text-muted text-danger"></small>
                        </div> -->

                        <!-- </div> -->


                        <div style="margin-top: 54px;" class="col-md-1 col-sm-1 col-xd-12">
                            <button type="button" id="search_det" class="btn btn-icon btn-round btn-info">
                                <i class="fas fa-plus-circle"></i>
                            </button>    
                        </div>
                        
                    </div>


                    <div class="" id="copy">

                    </div>

                    <div class="card-action">
                        <div>
                            <button type="submit" class="btn btn-danger">Cancelar</button>
                            <button type="submit" class="btn btn-success ml-2" id="enviar">Aceptar</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
    <?php
    include_once '../View/Caso/modalTramo.php';
    include_once '../View/Caso/modalEntorno.php';
    include_once '../View/Caso/modalDeterioro.php';
    ?>
</div>