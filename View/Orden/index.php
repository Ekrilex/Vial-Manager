<div class="container"><br>
  <div class="card col-md-12 col-sm-12 col-lg-12" style="max-width: 73rem;">
    <div class="card-header">
      <div class="d-flex align-items-center">
          <h3 class="card-title">Consultar Ordenes de mantenimiento  <span class="icon-book-open"></span>&nbsp;&nbsp;<span class="icon-magnifier"></span></h3>
          <?php if($_SESSION['rol'] != 4){?>
                <a type="button" class="text-light btn btn-warning btn-round ml-auto historial" href="<?php echo getUrl("Orden","Orden","historialOrd"); ?>">
                Ver Historial <i class="flaticon-agenda"></i></a>
          <?php }?>
      </div>
    </div>   
      <div class="card-body">
        <div class="table-responsive">
          <table id="Tbl-orden" class="display table table-striped table-head-bg-default table-hover " >
              <thead>
                <tr>
                  <th>#</th> 
                  <th>Fecha de creaci&oacute;n</th>
                  <th>Fecha de vencimiento</th>
                  <th>Responsable</th>
                  <th>Estado</th>
                  <th style="width: 20%;text-align: center;">Acci&oacute;n</th>   
                </tr>
              </thead>
              <tbody>
                <?php
                  while ($ord=pg_fetch_assoc($Orden)) {
              
                    echo "<tr>";
                    echo "<td>".$ord['ord_id']."</td>";
                    echo "<td>".$ord['ord_fecha_creacion']."</td>";
                    echo "<td>".$ord['ord_fecha_vencimiento']."</td>";
                    echo "<td>".$ord['usu_nickname']."</td>";
                    echo "<td>".$ord['est_descripcion']."</td>";
                    if($ord['est_descripcion']!="Finalizado" && $ord['est_descripcion']!="En Progreso"){     
                      if($_SESSION['rol'] != 4){     
                        $disabled = "inline"; 
                        $container = ""; 
                      }else{
                        $disabled = "none";
                        $container = "container"; 
                      }

                      echo "<td><a href='".getUrl("Orden","Orden","getUpdate",array("ord_id" => $ord['ord_id']))."' style='display:".$disabled.";'><button data-toggle='tooltip' class='btn btn-link btn-primary fas fa-search text-info' data-original-title='Editar'></button></a>";

                      echo "<a href='".getUrl("Orden","Orden","getDelete",array("ord_id" => $ord['ord_id']))."'><button data-toggle='tooltip' class='btn btn-link btn-danger fas fa-cog ".$container."' data-original-title='Gestionar'></button></a></td>";
                    }else{
                     
                        echo "<td><a href='".getUrl("Orden","Orden","getDelete",array("ord_id" => $ord['ord_id']))."'><button data-toggle='tooltip' class='btn btn-link btn-danger fas fa-cog container' data-original-title='Gestionar'></button></a></td>";
                      
                    }
                      echo "</tr>";
                    } 
                ?>
              </tbody>
          </table>
        </div>
      </div><br><br>
  </div>
</div>