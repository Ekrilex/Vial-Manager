
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Consultar Tramo</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Nombre Via</th>
                                            <th>Dirección</th>
                                            <th>Bárrio</th>
                                            <th>Fecha Creación</th>
                                            <th>Estado</th>
                                            <th>Ver Detalle</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Código</th>
                                            <th>Nombre Via</th>
                                            <th>Dirección</th>
                                            <th>Bárrio</th>
                                            <th>Fecha Creación</th>
                                            <th>Estado</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                            while($tramos = pg_fetch_assoc($consultaTramos)){
                                                echo "<tr>";
                                                    echo "<td>".$tramos['tra_codigo']."</td>";
                                                    echo "<td>".$tramos['tra_nombre_via']."</td>";
                                                    echo "<td>".$tramos['tra_nomenclatura']."</td>";
                                                    echo "<td>".$tramos['bar_descripcion']."</td>";
                                                    echo "<td>".$tramos['tra_fecha_creacion']."</td>";

                                                    if($tramos['estado_id'] == 1){

                                                       $colorEstado = "rgb(0,250,0)";

                                                    }else if($tramos['estado_id'] == 2){

                                                       $colorEstado = "rgb(250,0,0)";

                                                    }

                                                    echo "<td style='color:".$colorEstado.";'>".$tramos['est_descripcion']."</td>";
                                                    echo "<td><a href='".getUrl("Tramo","Tramo","getDetail",array("tra_id" => $tramos['tra_id']))."'><i class='fas fa-search text-info'></i></a></td>";
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
        