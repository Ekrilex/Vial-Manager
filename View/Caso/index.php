<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Consultar Caso</h4>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="basic-datatables-caso" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Fecha Vencimiento</th>
                                    <th>Prioridad</th>
                                    <th>Disponibilidad</th>
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
                                            }else if($casos['cas_prioridad'] == 3 || $casos['cas_prioridad'] == 4){

                                                $colorPrioridad = "rgb(250,250,0)";
                                                $nombrePrioridad = "Media";
                                            }else if($casos['cas_prioridad'] > 4 && $casos['cas_prioridad'] <= 7){
                                                $colorPrioridad = "rgb(250,0,0)";
                                                $nombrePrioridad = "Alta";
                                            }

                                            echo "<td style='color:".$colorPrioridad.";'>".$nombrePrioridad."</td>";

                                            if($casos['cas_disponibilidad'] == 0){
                                                $avisoOrden = "No Tiene Orden";
                                            }else{
                                                $avisoOrden = "Tiene Orden";
                                            }

                                            echo "<td>".$avisoOrden."</td>";

                                            echo "<script>alert('el estado es: ' + ".$casos['estado_id'].");</script>";

                                            /*if(($casos['estado_id']+1) == 3 || ($casos['estado_id']+1) == 4){
                                                
                                                $colorEstado = "rgb(250,250,0)";

                                            }

                                            if(($casos['estado_id']+1) == 2){
                                                $colorEstado = "rgb(250,0,0)";
                                            }

                                            if(($casos['estado_id']+1) == 5){
                                                $colorEstado = "rgb(0,250,0)";
                                            }*/

                                            echo "<td>".$casos['est_descripcion']."</td>";

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