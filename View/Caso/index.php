<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Consultar Caso</h4>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="basic-datatables-caso" class="display table table-striped table-hover" style="text-align:center;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Fecha Vencimiento</th>
                                    <th>Prioridad</th>
                                    <th>Orden</th>
                                    <th>Estado</th>
                                    <th>Ver Detalle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                    while($casos = pg_fetch_assoc($casosConsulta)){
                                        echo "<tr>";
                                            echo "<td>".$casos['cas_id']."</td>";
                                            echo "<td>".$casos['usu_primer_nombre']." ".$casos['usu_primer_apellido']."</td>";
                                            echo "<td>".$casos['cas_fecha_vencimiento']."</td>";

                                            if($casos['cas_prioridad'] == 1 || $casos['cas_prioridad'] == 2){
                                                
                                                $colorPrioridad = "rgb(0,250,0)";
                                                $nombrePrioridad = "Baja";
                                                $iconoPrioridad = "<i class='fas fa-thumbs-up text-success'></i>";

                                            }else if($casos['cas_prioridad'] == 3 || $casos['cas_prioridad'] == 4){

                                                $colorPrioridad = "rgb(250,250,0)";
                                                $nombrePrioridad = "Media";
                                                $iconoPrioridad = "<i class='fas fa-exclamation-triangle text-warning'></i>";

                                            }else if($casos['cas_prioridad'] > 4 && $casos['cas_prioridad'] <= 7){
                                                $colorPrioridad = "rgb(250,0,0)";
                                                $nombrePrioridad = "Alta";
                                                $iconoPrioridad = "<i class='fas fa-flag text-danger'></i>";
                                            }

                                            echo "<td style='color:".$colorPrioridad.";'>".$iconoPrioridad." ".$nombrePrioridad."</td>";

                                            if($casos['cas_disponibilidad'] != 0){
                                                $avisoOrden = "Vinculado a orden #".$casos['orden_id']; 
                                            }else{
                                                $avisoOrden = "No vinculado a orden"; 
                                            }

                                            echo "<td>".$avisoOrden."</td>";

                                            //echo "<script>alert('el estado es: ' + ".$casos['est_id'].");</script>";

                                            if($casos['est_id'] == 3 || $casos['est_id'] == 4){
                                                
                                                $colorEstado = "rgb(250,250,0)";

                                            }

                                            if($casos['est_id'] == 2){
                                                $colorEstado = "rgb(250,0,0)";
                                            }

                                            if($casos['est_id'] == 5){
                                                $colorEstado = "rgb(0,250,0)";
                                            }

                                            echo "<td style='color:".$colorEstado.";'>".$casos['est_descripcion']."</td>";

                                            echo "<td><a href='".getUrl("Caso","Caso","getDetail",array("cas_id" => $casos['cas_id']))."'><i class='fas fa-search text-info'></i></a></td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>