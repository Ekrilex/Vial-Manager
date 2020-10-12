<div class="page-inner" id="formularioParte1">
    <div>
        <?php 
            if(isset($_SESSION['resultRegistrar'])){

                                    
        ?>
            <div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
                <script>
                    setTimeout(function(){
                        $("#alert").html("<?php echo "<span class='text-success'>".$_SESSION['resultRegistrar']."</span>" ?><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>").fadeOut(5000) ;

                    }, 1000);
                </script>
            </div>
        <?php 
            }
            unset($_SESSION['resultRegistrar']);
        ?>
    </div>
    <div>
        <?php 
            if(isset($_SESSION['resultRegistrarError'])){

                                    
        ?>
            <div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                <script>
                    setTimeout(function(){
                        $("#alert").html("<?php echo "<span class='text-danger'>".$_SESSION['resultRegistrarError']."</span>" ?><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>").fadeOut(5000) ;

                    }, 1000);
                </script>
            </div>
        <?php 
            }
            unset($_SESSION['resultRegistrarError']);
        ?>
    </div>
        
        <form id="form_case" method="POST" enctype="multipart/form-data">
            <div class="col-md-12" id="formParte1">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Registrar Caso</div>
                    </div>

                    <div class="card-body" >
                        <div class="form-row">
                            <div class="form-group col-md-4">
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

                            <div class="form-group col-md-4">
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
                                    <input class="validacion tramoValue" type='hidden' name="tramo_id" id="tramo_id" value="">
                                    <input class="validacion tramoValue" type='hidden' name="tra_ancho_inicio" id="ancho_inicio" value="">
                                    <input class="validacion tramoValue" type='hidden' name="tra_ancho_fin" id="ancho_fin" value="">
                                </div>
                                <small id="ad2" class="form-text text-muted text-danger"></small>
                            </div>

                            <div class="form-group form-group-default col-md-3 ml-3" style="height: 55px; margin-top: 30px">
                                <label>Seleccione el tipo de pavimento</label>
                                <select name="tipo_pavimento_id" class="form-control validacion" id="tipo_pavimento_id">
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
                                    <input type="text" class="form-control inputcito text-black" id="inputDeterioro1" style="color:black;" name="deterioro" data-tipo="" value="Deterioro" readonly>
                                    <div class="input-group-prepend">
                                        <button class="btn btn-default botonInput" id="1" type="button" data-toggle="modal" onclick="enviarID(this.id);" data-target="#modalDeterioro">
                                            <span class="btn-label">
                                                <i class="fas fa-directions"></i>
                                            </span>
                                            Buscar
                                        </button>
                                    </div>
                                    <input type='hidden' class="inputcito_hidden deteriorosValue validacion" name="deterioros[]" id="deterioro_id1" value="">
                                </div>
                                <small id="ad6" class="form-text text-muted text-danger"></small>
                            </div>

                            <div id="d2" class="form-group col-md-2 mt-2" style="padding: 15px">
                                <label>Gravedad</label>
                                <select name="gravedades[]" class="form-control gravedadValue validacion">
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
                                    <input type="number" class="form-control areaValue validacion" name="areas[]" aria-label="Amount (to the nearest dollar)">
                                    <div class="input-group-append">
                                        <span class="input-group-text">mm</span>
                                    </div>
                                </div>
                            </div>

                            <div id="d1" class="form-group col-md-5 mt-2">
                                <label>Deterioro</label>
                                <div class="input-group bg-info">
                                    <input type="text" class="form-control inputcito text-black" id="inputDeterioro2" style="color:black;" name="deterioro" value="Deterioro" readonly>
                                    <div class="input-group-prepend">
                                        <button class="btn btn-default botonInput" id="2" type="button" data-toggle="modal" onclick="enviarID(this.id);" data-target="#modalDeterioro">
                                            <span class="btn-label">
                                                <i class="fas fa-directions"></i>
                                            </span>
                                            Buscar
                                        </button>
                                    </div>
                                    <input type='hidden' class="inputcito_hidden deteriorosValue validacion" name="deterioros[]" id="deterioro_id2" value="">
                                </div>
                                <small id="ad6" class="form-text text-muted text-danger"></small>
                            </div>

                            <div id="d2" class="form-group col-md-2 mt-2" style="padding: 15px">
                                <label>Gravedad</label>
                                <select name="gravedades[]" class="form-control gravedadValue validacion">
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
                                    <input type="number" class="form-control areaValue validacion" name="areas[]" aria-label="Amount (to the nearest dollar)">
                                    <div class="input-group-append">
                                        <span class="input-group-text">mm</span>
                                    </div>
                                </div>
                            </div>

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
                                <a class="btn btn-danger text-light" href="<?php echo getUrl("Caso","Caso","index")?>">Cancelar</a>
                                <!-- <button type="button" class="btn btn-success ml-2" id="enviar">Continuar</button> -->
                                <button type="button" class="btn btn-success ml-2" id="envioData">Continuar</button>
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