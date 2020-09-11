<?php
    while ($usu=pg_fetch_assoc($usuarios)) {
?>
        <tr>
            <td><?php echo $usu['usu_num_identificacion']; ?></td>
            <td><?php echo $usu['usu_nickname']; ?></td>
            <td><?php echo $usu['usu_primer_nombre'] . " " . $usu['usu_segundo_nombre'] ?></td>
            <td><?php echo $usu['usu_primer_apellido'] . " " . $usu['usu_segundo_apellido'] ?></td>
            <td><?php echo $usu['rol_nombre']; ?></td>
            <td><?php echo $usu['est_descripcion']; ?></td>
            <td><button onclick="userDelete('<?php echo $usu['usu_num_identificacion'];?>');" data-toggle="modal" data-target="#exampleModal" class="btn btn-lg" style="background-color:transparent; padding: 0px; color: red;"><i class="fas fa-user-slash"></i></button></td>
            <td><a href="<?php echo getUrl("Usuario","Usuario","getUpdate",array("usu_id"=>$usu['usu_num_identificacion'], "rol_id"=>$usu['rol_id'], "tip_id"=>$usu['tip_id'])) ?>"><button class="btn btn-lg" style="background-color:transparent; padding: 0px; color: yellow;"><i class="fas fa-user-edit"></i></button></a></td>
            <td><button onclick="userActivation('<?php echo $usu['usu_num_identificacion'];?>');" data-toggle="modal" data-target="#exampleModal2" class="btn btn-lg" style="background-color:transparent; padding: 0px; color: green;"><i class="fas fa-lock"></i></button></td>
        </tr>
<?php
    }
?>