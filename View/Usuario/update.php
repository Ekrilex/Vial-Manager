 <form id="form_user_edit" action="<?php echo getUrl("Usuario","Usuario","postUpdate") ?>" method="POST" >
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
                        <input type="text" class="form-control validEdit" name="primer_nombre" id="pri_nombre" value="<?php echo $index['usu_primer_nombre'] ?>" onchange="valVarchar(this,'ad1')">
                        <input type="hidden" name="id" value="<?php echo $index['usu_id'] ?>">
                        <small id="ad1" class="form-text text-muted text-danger"></small>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="">Segundo Nombre</label>
                        <input type="text" class="form-control validEdit" id="seg_nombre" name="segundo_nombre" value="<?php echo $index['usu_segundo_nombre'] ?>" onchange="valVarchar(this,'ad2')">
                        <small id="ad2" class="form-text text-muted text-danger"></small>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="">Primer Apellido</label>
                        <input type="text" class="form-control validEdit" id="pri_apellido" name="primer_apellido" value="<?php echo $index['usu_primer_apellido'] ?>" onchange="valVarchar(this,'ad3')">
                        <small id="ad3" class="form-text text-muted text-danger"></small>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="">Segundo Apellido</label>
                        <input type="text" class="form-control validEdit" id="seg_apellido" name="segundo_apellido" value="<?php echo $index['usu_segundo_apellido'] ?>" onchange="valVarchar(this,'ad4')">
                        <small id="ad4" class="form-text text-muted text-danger"></small>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="inputAddress">Correo Electronico</label>
                        <input type="text" class="form-control validEdit" id="correo" name="correo" value="<?php echo $index['usu_correo'] ?>" data-url="<?php echo getUrl('Usuario','Usuario','mailCheck',false,'ajax') ?>">
                        <small id="ad5" class="form-text text-muted text-danger"></small>
                        <small id="confirm" class="form-text text-muted text-info"></small>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputAddress2">Telefono</label>
                        <input type="number" class="form-control validEdit" id="telefono" name="telefono" value="<?php echo $index['usu_telefono'] ?>" onchange="valInt(this,'ad7')">
                        <small id="ad7" class="form-text text-muted text-danger"></small>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="inputCity">Numero de documento</label>
                        <input type="number" class="form-control validEdit" id="num_documento" name="numero_documento" value="<?php echo $index['usu_num_identificacion'] ?>" onchange="valInt(this,'ad8')">
                        <small id="ad8" class="form-text text-muted text-danger"></small>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputState">Tipo de documento</label>
                        <select id="tip_documento" name="tipo_documento" class="form-control validEdit">
                        <?php
                            echo "<option value=' ".$index['tipo_documento_id']." ' selected>".$index['tip_descripcion']."</option>";                     
                            
                            while ($index2=pg_fetch_assoc($documentos)) {
                                echo "<option value='".$index2['tip_id']."'>".$index2['tip_descripcion']."</option>";
                            }
                        ?>
                        </select>
                        <small id="ad8" class="form-text text-muted text-danger"></small>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="inputState">Rol</label>
                        <select id="tipo_rol" name="rol" class="form-control validEdit">
                        <?php
                            echo "<option value='".$index['rol_id']."' selected>".$index['rol_nombre']."</option>";

                            while ($index3=pg_fetch_assoc($roles)) {
                                echo "<option value='".$index3['rol_id']."'>".$index3['rol_nombre']."</option>";
                            }
                        ?>
                        </select>
                        <small id="ad9" class="form-text text-muted text-danger"></small>
                    </div>
                </div>
                <?php 
                    }
                ?>
            </div>
            <div class="card-action">
                <a href="<?php echo getUrl("Usuario","Usuario","index");?>" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-success" onclick="return mainValidationEdit();">Aceptar</button>
            </div>
        </div>
    </div>    
</form>
