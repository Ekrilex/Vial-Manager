
        <div class="page-inner">
        <div>
            <?php 
                if(isset($_SESSION['resultEditar'])){

                                        
            ?>
                <div id="alert" class="alert alert-primary alert-dismissible fade show" role="alert">
                    <script>
                        setTimeout(function(){
                            $("#alert").html("<?php echo "<span class='text-primary'>".$_SESSION['resultEditar']."</span>" ?><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>").fadeOut(5000) ;

                        }, 1000);
                    </script>
                </div>
            <?php 
                }
                unset($_SESSION['resultEditar']);
            ?>
        </div>
        <div>
            <?php 
                if(isset($_SESSION['resultEditarError'])){

                                        
            ?>
                <div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <script>
                        setTimeout(function(){
                            $("#alert").html("<?php echo "<span class='text-danger'>".$_SESSION['resultEditarError']."</span>" ?><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>").fadeOut(5000) ;

                        }, 1000);
                    </script>
                </div>
            <?php 
                }
                unset($_SESSION['resultEditarError']);
            ?>
        </div>
        <div>
            <?php 
                if(isset($_SESSION['resultInhabilitar'])){

                                        
            ?>
                <div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <script>
                        setTimeout(function(){
                            $("#alert").html("<?php echo "<span class='text-danger'>".$_SESSION['resultInhabilitar']."</span>" ?><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>").fadeOut(5000) ;

                        }, 1000);
                    </script>
                </div>
            <?php 
                }
                unset($_SESSION['resultInhabilitar']);
            ?>
        </div>
        <div>
            <?php 
                if(isset($_SESSION['resultHabilitar'])){

                                        
            ?>
                <div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
                    <script>
                        setTimeout(function(){
                            $("#alert").html("<?php echo "<span class='text-success'>".$_SESSION['resultHabilitar']."</span>" ?><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>").fadeOut(5000) ;

                        }, 1000);
                    </script>
                </div>
            <?php 
                }
                unset($_SESSION['resultHabilitar']);
            ?>
        </div>
        <div>
            <?php 
                if(isset($_SESSION['ErrorEjeEditar'])){

                                        
            ?>
                <div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <script>
                        setTimeout(function(){
                            $("#alert").html("<?php echo "<span class='text-danger'>".$_SESSION['ErrorEjeEditar']."</span>" ?><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>").fadeOut(9000) ;

                        }, 1000);
                    </script>
                </div>
            <?php 
                }
                unset($_SESSION['ErrorEjeEditar']);
            ?>
        </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Consultar Tramo</h4>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive">
                                <table id="basic-datatables-consultar" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>C&oacute;digo</th>
                                            <th>Nombre V&iacute;a</th>
                                            <th>Direcci&oacute;n</th>
                                            <th>B&aacute;rrio</th>
                                            <th>Fecha Creaci&oacute;n</th>
                                            <th>Estado</th>
                                            <th>Ver Detalle</th>
                                        </tr>
                                    </thead>
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
        