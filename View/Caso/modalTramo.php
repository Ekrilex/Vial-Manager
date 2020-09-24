<div class="modal fade" id="modalTramo" tabindex="-1" aria-labelledby="ModalTramo" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header btn-warning">
        <h5 class="modal-title" id="exampleModalLabel">Seleccionar Tramo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body btn-default">
        <div>
            <table class="table table-head-bg-warning table-hover" id="datatable-tramo">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Direccion</th>
                        <th>Nombre Via</th>
                        <th>Jerarquia Vial</th>
                        <th>Barrio</th>
                        <th>Seleccionar</th>                    
                    </tr>
                </thead>
                <tbody id="registrosTramo">
                    <?php 
                          while($tramos = pg_fetch_assoc($tramo)){
                              if($tramos['tra_disponibilidad'] == 0 && $tramos['estado_id'] == 1){
                                echo "<tr>";
                                    echo "<td>".$tramos['tra_codigo']."</td>";
                                    echo "<td>".$tramos['tra_nomenclatura']."</td>";
                                    echo "<td>".$tramos['tra_nombre_via']."</td>";
                                    echo "<td>".$tramos['jer_descripcion']."</td>";
                                    echo "<td>".$tramos['bar_descripcion']."</td>";
                                    echo "<td><button class='btn btn-secondary' id='selectTramo' value='".$tramos['tra_id']."' data-codigo='".$tramos['tra_codigo']."'><span><i class='fas fa-plus-circle text-light'></i></span></button></td>";
                                echo "</tr>";
                              }
                          }

                    ?>
                </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer btn-default">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>