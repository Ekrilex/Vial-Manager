<?php

while ($casoSeleccionado = pg_fetch_assoc($casoConsulta)) {


?>

    <div class="page-inner">
        <div>
            <?php 
                if(isset($_SESSION['resultFinalizar'])){

                                        
            ?>
                <div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
                    <script>
                        setTimeout(function(){
                            $("#alert").html("<?php echo "<span class='text-success'>".$_SESSION['resultFinalizar']."</span>" ?><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>").fadeOut(5000) ;

                        }, 1000);
                    </script>
                </div>
            <?php 
                }
                unset($_SESSION['resultFinalizar']);
            ?>
        </div>
        <div>
            <?php 
                if(isset($_SESSION['resultFinalizarrError'])){

                                        
            ?>
                <div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <script>
                        setTimeout(function(){
                            $("#alert").html("<?php echo "<span class='text-danger'>".$_SESSION['resultFinalizarrError']."</span>" ?><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>").fadeOut(5000) ;

                        }, 1000);
                    </script>
                </div>
            <?php 
                }
                unset($_SESSION['resultFinalizarrError']);
            ?>
        </div>
        <div class="col-md-12" id="contenidoFormulario">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="card-title">Detalle Caso</div>
                        <?php 
                            $areaTramo = $casoSeleccionado['tra_ancho_inicio'] + $casoSeleccionado['tra_ancho_fin'];
                            $areaTramo *= 500 / 10; 
                        ?>
                        <div class="ml-auto"><h5 style="font-weight:bold;" class="text-light">Area del tramo: <?php echo $areaTramo;?>m²</h5></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label>Id:</label>
                                <input type="text" class="form-control" style="color:black; font-weight:bold;" placeholder="codigo caso" value="<?php echo $casoSeleccionado['cas_id']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Fotografia Inicio:</label>
                                <div>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#verFotoInicio">
                                        Ver Fotografia Inicio &nbsp;<i class='fas fa-file-image'></i>
                                    </button>

                                    <div class="modal fade" id="verFotoInicio" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header btn-primary">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Fotografia inicio:</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body btn-default">
                                                    <label>Fotografia Inicio de la via:</label><br>
                                                    <?php 
                                                        if($casoSeleccionado['cas_fotografia_inicio'] != ""){

                                                        

                                                    ?>
                                                        <img src="<?php echo $casoSeleccionado['cas_fotografia_inicio'] ?>" alt="no tiene" width="467px" height="300px" border="1px">                                                    <?php 
                                                        }else{
                                                            echo "<h5><span><i class='fas fa-info-circle'></i></span>&nbsp;Este caso aun no dispone de foto final</h5>";
                                                        }
                                                    ?>
                                                    

                                                </div>
                                                <div class="modal-footer btn-default">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tipo De Pavimento:</label>
                                <div>
                                    <span><?php echo $casoSeleccionado['pav_descripcion'] ?></span>
                                </div>
                            </div>
                            <div class="form-group mt--1">
                                <?php
                                if ($casoSeleccionado['orden_id'] == "") {
                                    $mensajeOrden = "No tiene orden vinculada";
                                } else {
                                    $mensajeOrden = $casoSeleccionado['orden_id'];
                                }
                                ?>
                                <label>Orden Vinculada:</label>
                                <input type="text" class="form-control" style="color:black; font-weight:bold;" placeholder="codigo caso" value="<?php echo $mensajeOrden; ?>" readonly>
                            </div>

                        </div>

                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label>Fecha de creacion:</label>
                                <input type="text" class="form-control" style="color:black; font-weight:bold;" placeholder="Fecha de creacion" value="<?php echo $casoSeleccionado['cas_fecha_creacion']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Fotografia Fin:</label>
                                <div>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#verFotoFin">
                                        Ver Fotografia Fin &nbsp;<i class='fas fa-file-image'></i>
                                    </button>
                                    <div class="modal fade" id="verFotoFin" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header btn-success">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Fotografia fin:</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body btn-default">
                                                    <label>Fotografia Despues de la intervencion:</label><br>
                                                    <?php 
                                                        if($casoSeleccionado['cas_fotografia_fin'] != ""){

                                                        

                                                    ?>
                                                        <img src="<?php echo $casoSeleccionado['cas_fotografia_fin'] ?>" alt="no tiene" width="467px" height="300px" border="1px">
                                                    <?php 
                                                        }else{
                                                            echo "<h5><span><i class='fas fa-info-circle'></i></span>&nbsp;Este caso aun no dispone de foto final</h5>";
                                                        }
                                                    ?>
                                                </div>
                                                <div class="modal-footer btn-default">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <img src="<?php //echo $casoSeleccionado['cas_fotografia_fin'] ?>" alt="no tiene" width="300px" height="200px"> -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Ultimo Usuario que Modifico El Caso:</label>
                                <input type="text" class="form-control" style="color:black; font-weight:bold;" placeholder="Usuario" value="<?php echo $casoSeleccionado['usu_primer_nombre'] . " " . $casoSeleccionado['usu_segundo_nombre'] . " " . $casoSeleccionado['usu_primer_apellido'] . " " . $casoSeleccionado['usu_segundo_apellido']; ?>" readonly>

                            </div>
                            <div class="form-group">
                                <label>Codigo Del Tramo:</label>
                                <input type="text" class="form-control" style="color:black; font-weight:bold;" placeholder="Fecha de creacion" value="<?php echo $casoSeleccionado['tra_codigo']; ?>" readonly>
                            </div>
                            
                        </div>
                        
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label>Fecha de vencimiento: </label>
                                <input type="text" class="form-control" style="color:black; font-weight:bold;" placeholder="Fecha de vencimiento" value="<?php echo $casoSeleccionado['cas_fecha_vencimiento']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <?php

                                if ($casoSeleccionado['cas_prioridad'] == 1 || $casoSeleccionado['cas_prioridad'] == 2) {

                                    $colorPrioridad = "rgb(0,250,0)";
                                    $nombrePrioridad = "Baja";
                                    $iconoPrioridad = "<i class='fas fa-thumbs-up text-success'></i>";
                                } else if ($casoSeleccionado['cas_prioridad'] == 3 || $casoSeleccionado['cas_prioridad'] == 4) {

                                    $colorPrioridad = "rgb(250,250,0)";
                                    $nombrePrioridad = "Media";
                                    $iconoPrioridad = "<i class='fas fa-exclamation-triangle text-warning'></i>";
                                } else if ($casoSeleccionado['cas_prioridad'] > 4 && $casoSeleccionado['cas_prioridad'] <= 7) {
                                    $colorPrioridad = "red";
                                    $nombrePrioridad = "Alta";
                                    $iconoPrioridad = "<i class='fas fa-flag text-danger'></i>";
                                }
                                ?>
                                <label>Prioridad:</label>
                                <div>
                                    <span style="color:<?php echo $colorPrioridad; ?>;"><?php echo $iconoPrioridad . " " . $nombrePrioridad; ?></span>
                                </div>


                            </div>
                            <div class="form-group mt-4">
                                <label>Entorno: </label>
                                <input type="text" class="form-control" style="color:black; font-weight:bold;" placeholder="Entorno" value="<?php echo $casoSeleccionado['ent_descripcion']; ?>" readonly>
                            </div>
                            <div class="form-group" >
                                <?php
                                if ($casoSeleccionado['est_id'] == 3 || $casoSeleccionado['est_id'] == 4) {

                                    $colorEstado = "rgb(255, 119, 0)";
                                }

                                if ($casoSeleccionado['est_id'] == 2) {
                                    $colorEstado = "rgb(250,0,0)";
                                }

                                if ($casoSeleccionado['est_id'] == 5) {
                                    $colorEstado = "rgb(0,250,0)";
                                }
                                ?>
                                <span id="form-estado">
                                    <label>Estado: </label>
                                    <input type="text" class="form-control" style="color:<?php echo $colorEstado; ?>; font-weight:bold;" placeholder="Estado" value="<?php echo $casoSeleccionado['est_descripcion']; ?>" readonly>
                                </span>
                            </div>

                        </div>
                    </div>
                    <div class="form-row col-md-12">
                        <label>Causa:</label>
                        <textarea class="form-control" style="color:black; font-weight:bold;" placeholder="Causa.." rows="4" maxlength="200" readonly><?php echo $casoSeleccionado['cas_causa']?></textarea>
                    </div>
                    <br>
                    <div class="form-group mr-2">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDetalleDeterioros">
                            Ver deterioros de la via <i class='fas fa-search text-white'></i>
                        </button>

                        <div class="modal fade" id="modalDetalleDeterioros" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header btn-secondary">
                                        <h5 class="modal-title" id="staticBackdropLabel">Deterioros que presenta la via <i class='fas fa-exclamation-triangle text-warning text-warning'></i></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body btn-default">
                                        <table class="table table-hover table-striped table-head-bg-secondary" border="1" style="text-align:center;">
                                            <thead>
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
                                    <div class="modal-footer btn-default">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <!--<label>Deterioros De La Via <i class='fas fa-exclamation-triangle text-warning text-warning'></i>:</label>-->
                           
                    </div>
                </div>
                <div class="card-action">
                    <a class="btn btn-secondary" href="<?php echo getUrl('Caso','Caso','index')?>">Salir</a>

                    <button class="btn btn-info" id="editarCaso" data-url="<?php echo getUrl("Caso","Caso","getUpdate",false,"ajax");?>" data-id="<?php echo $casoSeleccionado['cas_id'];?>">Editar</button>
                    <!-- <button class="btn btn-info" id="finalizarCaso" data-url="<?php //echo getUrl("Caso","Caso","getfinalize",false,"ajax");?>" data-id="<?php //echo $casoSeleccionado['cas_id'];?>">Editar</button> -->
                    <?php 
                        if($casoSeleccionado['orden_id'] != "" && $casoSeleccionado['est_id'] != 5){
                    ?>
                        <button class="btn btn-success" data-toggle="modal" id="finalizarCaso" data-target="#modalFinalizar" data-id="<?php echo $casoSeleccionado['cas_id'];?>">Finalizar</button>
                    <?php 
                    
                        }
                    ?>
                    <span id="inhabilitarHabilitar">
                        <?php 
                            if($casoSeleccionado['est_id' ] != 5 && $casoSeleccionado['orden_id'] == ""){
                                if($casoSeleccionado['est_id' ] != 2 ){
                                    echo "<button class='btn btn-danger botonCambiarEstado' data-toggle='modal' data-estado='".$casoSeleccionado['est_id']."' data-target='#modalInhabilitarCaso'>Inhabilitar</button>";
                                }else{
                                    echo "<button class='btn btn-success botonCambiarEstado' data-toggle='modal' data-estado='".$casoSeleccionado['est_id']."' data-target='#modalHabilitarCaso'>Habilitar</button>";
                                }
                            }
                        ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

<?php
    include_once '../View/Caso/modalFinalizar.php';
    include_once '../View/Caso/modalInhabilitar.php';
    include_once '../View/Caso/modalHabilitar.php';
}

?>