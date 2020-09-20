<div class="col-md-12" style="margin-top: 20px;">
    <div class="card">
        <div class="card-header">
            <div class="card-tittle text-white"><h2>Consultar Usuario</h2></div>
        </div>
        <div class="card-body">
            <div class="table-resposive">
                <div class="row mt-3">
                    <table id="users-table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Identifiacion</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Cargo</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                                <th scope="col">Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($usu = pg_fetch_assoc($usuarios)) {
                            ?>
                                <tr>
                                    <th><?php echo $usu['usu_num_identificacion']; ?></th>
                                    <td><?php echo $usu['usu_nickname']; ?></td>
                                    <td><?php echo $usu['usu_primer_nombre'] . " " . $usu['usu_segundo_nombre'] ?></td>
                                    <td><?php echo $usu['usu_primer_apellido'] . " " . $usu['usu_segundo_apellido'] ?></td>
                                    <td><?php echo $usu['rol_nombre']; ?></td>
                                    <td><?php echo $usu['est_descripcion']; ?></td>
                                    <?php if ($usu['est_id'] == 1) { ?>
                                    <!-- <td><button id="delete" onclick="userDelete('<?php echo $usu['usu_num_identificacion']; ?>');" data-toggle="modal" data-target="#exampleModal" class="btn btn-lg" style="background-color:transparent; padding: 0px; color: red;"><i class="fas fa-user-slash"></i></button></td> -->
                                    <td><button id="delete" data-url="<?php echo getUrl("Usuario","Usuario","deleteUsuario"); ?>" data-id="<?= $usu['usu_num_identificacion'] ?>" class="btn btn-lg" style="background-color:transparent; padding: 0px; color: red;"><i class="fas fa-user-slash"></i></button></td>
                                    <?php } ?>
                                    <?php if($usu['est_id'] == 2 ){ ?>
                                    <!-- <td><button onclick="userActivation('<?php echo $usu['usu_num_identificacion']; ?>');" data-toggle="modal" data-target="#exampleModal2" class="btn btn-lg" style="background-color:transparent; padding: 0px; color: green;"><i class="fas fa-lock"></i></button></td>     -->
                                    <td><button id="activate" data-url="<?php echo getUrl("Usuario","Usuario","activationuser"); ?>" data-id="<?= $usu['usu_num_identificacion'] ?>" class="btn btn-lg" style="background-color:transparent; padding: 0px; color: green;"><i class="fas fa-lock"></i></button></td>    
                                    <?php } ?>
                                    <td><a href="<?php echo getUrl("Usuario", "Usuario", "getUpdate", array("usu_id" => $usu['usu_num_identificacion'], "rol_id" => $usu['rol_id'], "tip_id" => $usu['tip_id'])) ?>"><button class="btn btn-lg" style="background-color:transparent; padding: 0px; color: yellow;"><i class="fas fa-user-edit"></i></button></a></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>







<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmacion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo getUrl("Usuario", "Usuario", "deleteUsuario") ?>" method="POST">
                <div class="modal-body">
                    ¿Deseas inhabilitar al usuario?
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="inputcito" name="usu_num_identificacion" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmacion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo getUrl("Usuario", "Usuario", "activationUser") ?>" method="POST">
                <div class="modal-body">
                    ¿Deseas activar a este usuario?
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="inputcito2" name="usu_num_identificacion2" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
            </form>
        </div>
    </div>
</div>