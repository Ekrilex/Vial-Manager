<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Identifiacion</th>
                <th scope="col">Usuario</th>
                <th scope="col">Nombres</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Cargo</th>
                <th scope="col">Estado</th>
                <th scope="col" colspan="3">
                    <center>Acciones</center>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($usuarios as $usu) {
            ?>
                <tr>
                    <td><?php echo $usu['usu_num_identificacion']; ?></td>
                    <td><?php echo $usu['usu_nickname']; ?></td>
                    <td><?php echo $usu['usu_primer_nombre'] . " " . $usu['usu_segundo_nombre'] ?></td>
                    <td><?php echo $usu['usu_primer_apellido'] . " " . $usu['usu_segundo_apellido'] ?></td>
                    <td><?php echo $usu['rol_nombre']; ?></td>
                    <td><?php echo $usu['est_descripcion']; ?></td>
                    <td><button onclick="userDelete('<?php echo $usu['usu_num_identificacion'];?>');" data-toggle="modal" data-target="#exampleModal" class="btn btn-lg" style="background-color:transparent; padding: 0px; color: red;"><i class="fas fa-user-slash"></i></button></td>
                    <td><a href="<?php echo getUrl("Usuario","Usuario","getUpdate",array("usu_id"=>$usu['usu_num_identificacion'])) ?>"><button class="btn btn-lg" style="background-color:transparent; padding: 0px; color: yellow;"><i class="fas fa-user-edit"></i></button></a></td>
                    <td><button onclick="userActivation('<?php echo $usu['usu_num_identificacion'];?>');" data-toggle="modal" data-target="#exampleModal2" class="btn btn-lg" style="background-color:transparent; padding: 0px; color: green;"><i class="fas fa-lock"></i></button></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
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
                    <button type="submit" class="btn btn-primary" >Aceptar</button>
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
                    <button type="submit" class="btn btn-primary" >Aceptar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const userDelete = ( identificacion ) => {
        console.log(identificacion);
        input = document.getElementById('inputcito');
        input.value = identificacion;
    }
    
    const userActivation = ( identificacion ) =>{
        console.log(identificacion);
        input = document.getElementById('inputcito2');
        input.value = identificacion;
    }
</script>