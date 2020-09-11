 <form action="<?php echo getUrl("Usuario","Usuario","postUpdate") ?>" method="POST" >
     <div class="col-md-12" style="margin-top: 20px;">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Editar Usuario</div>
            </div>
            <div class="card-body" style="background-color: #1f283e">
                <?php 
                    while ($index=pg_fetch_assoc($users)) {
                ?>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="inputEmail4">Primer Nombre</label>
                        <input type="text" class="form-control" name="primer_nombre" id="inputEmail4" value="<?php echo $index['usu_primer_nombre'] ?>" required>
                        <input type="hidden" name="id" value="<?php echo $index['usu_id'] ?>">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="inputPassword4">Segundo Nombre</label>
                        <input type="text" class="form-control" id="inputtext" name="segundo_nombre" value="<?php echo $index['usu_segundo_nombre'] ?>" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="inputPassword4">Primer Apellido</label>
                        <input type="text" class="form-control" id="inputPassword4" name="primer_apellido" value="<?php echo $index['usu_primer_apellido'] ?>" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="inputPassword4">Segundo Apellido</label>
                        <input type="text" class="form-control" id="inputPassword4" name="segundo_apellido" value="<?php echo $index['usu_segundo_apellido'] ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="inputAddress">Correo Electronico</label>
                        <input type="text" class="form-control" id="inputAddress" name="correo" value="<?php echo $index['usu_correo'] ?>" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputAddress2">Telefono</label>
                        <input type="text" class="form-control" id="inputAddress2" name="telefono" value="<?php echo $index['usu_telefono'] ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="inputCity">Numero de documento</label>
                        <input type="text" class="form-control" id="inputCity" name="numero_documento" value="<?php echo $index['usu_num_identificacion'] ?>" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputState">Tipo de documento</label>
                        <select id="inputState" name="tipo_documento" class="form-control">
                        <?php
                            echo "<option value=' ".$index['tipo_documento_id']." ' selected>".$index['tip_descripcion']."</option>";                     
                            
                            while ($index2=pg_fetch_assoc($documentos)) {
                                echo "<option value='".$index2['tip_id']."'>".$index2['tip_descripcion']."</option>";
                            }
                        ?>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="inputState">Rol</label>
                        <select id="inputState" name="rol" class="form-control">
                        <?php
                            echo "<option value='".$index['rol_id']."' selected>".$index['rol_nombre']."</option>";

                            while ($index3=pg_fetch_assoc($roles)) {
                                echo "<option value='".$index3['rol_id']."'>".$index3['rol_nombre']."</option>";
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <?php 
                    }
                ?>
            </div>
            <div class="card-action">
                <button type="submit" class="btn btn-danger">Cancelar</button>
                <button type="submit" class="btn btn-success">Aceptar</button>
            </div>
        </div>
    </div>    
</form>
