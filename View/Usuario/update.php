 <form>
     <div class="col-md-12" style="margin-top: 20px;">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Editar Usuario</div>
            </div>
            <div class="card-body" style="background-color: #1f283e">
                <?php 
                    foreach ($users as $index) {
                ?>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="inputEmail4">Primer Nombre</label>
                        <input type="text" class="form-control" id="inputEmail4" value="<?php echo $index['usu_primer_nombre'] ?>" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="inputPassword4">Segundo Nombre</label>
                        <input type="text" class="form-control" id="inputtext" value="<?php echo $index['usu_segundo_nombre'] ?>" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="inputPassword4">Primer Apellido</label>
                        <input type="text" class="form-control" id="inputPassword4" value="<?php echo $index['usu_primer_apellido'] ?>" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="inputPassword4">Segundo Apellido</label>
                        <input type="text" class="form-control" id="inputPassword4" value="<?php echo $index['usu_segundo_apellido'] ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="inputAddress">Correo Electronico</label>
                        <input type="text" class="form-control" id="inputAddress" value="<?php echo $index['usu_correo'] ?>" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputAddress2">Telefono</label>
                        <input type="text" class="form-control" id="inputAddress2" value="<?php echo $index['usu_telefono'] ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="inputCity">Numero de documento</label>
                        <input type="text" class="form-control" id="inputCity" value="<?php echo $index['usu_num_identificacion'] ?>" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputState">Tipo de documento</label>
                        <select id="inputState" class="form-control">
                        <option selected>Seleccione...</option>
                        <?php
                            foreach ($documentos as $index2) {
                                echo "<option value='".$index2['Tip_id']."'>".$index2['Tip_descripcion']."</option>";
                            }
                        ?>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="inputState">Rol</label>
                        <select id="inputState" class="form-control" required>
                        <option selected>Seleccione</option>
                        <?php
                            foreach ($roles as $index3) {
                                echo "<option value='".$index3['rol_id']."'>".$index3['rol_nombre']."</option>";
                            }
                        ?>
                        </select>
                    </div>
                </div>

                <!-- <div class="form-row"> 
                    <div class="form-group col-md-5">
                        <label for="inputPassword4">Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="inputtext" required>
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary btn-sm" type="button"><i class="fas fa-eye"></i></button>
                            </div>
                        </div>
                        <small class="form-text text-muted">
                            La contraseña debera de contener al menos una mayuscula y 5 numeros.
                        </small>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="inputPassword4">Confirmar Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="inputtext" required>
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary btn-sm" type="button"><i class="fas fa-eye"></i></button>
                            </div>
                        </div>
                        <small class="form-text text-muted">
                            Recuerde la contraseña debera de coincidir con la anterior
                        </small>
                    </div>
                </div> -->
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
