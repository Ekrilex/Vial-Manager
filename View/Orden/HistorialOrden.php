
<div class="container"><br>
    <div class="card col-md-12 col-sm-12 col-lg-12" style="max-width: 73rem;">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h3 class="card-title">Historial de Ordenes de Mantenimiento <span class="flaticon-agenda"></span>&nbsp;&nbsp;<span class="icon-magnifier"></span></h3>
              
            </div>
        </div>   
         <br>
        <div class="table-responsive">
            <table id="Tbl-orden" class="table table-striped   table-head-bg-warning  table-striped-bg-default" >
                <thead>
                    <tr>
                        <th>#</th> 
                        <th>Usuario</th>
                        <th>Fecha de Modificacion</th>
                        <th>Nombre de la tabla</th>
                        <th style="width: 10%;text-align: center;">Acci&oacute;n</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($bit=pg_fetch_assoc($bitacora)) {
                    
                        echo "<tr>";
                        echo "<td>".$bit['bit_id']."</td>";
                        echo "<td>".$bit['bit_usuario']."</td>";
                        echo "<td>".$bit['bit_fecha_modificacion']."</td>";
                        echo "<td>".$bit['bit_tabla']."</td>";           
                        echo "<td><a href='".getUrl("Orden","Orden","getDetalle",array("bit_id" => $bit['bit_id']))."'><button id='DetalleOrden'  class='btn btn-primary btn-round text-light' ><i class='flaticon-shapes'></i> Ver detalle</button></a>";
                        echo "</tr>";
                    } ?>
                </tbody>
            </table>
        </div><br><br>
           
    </div>
</div>


