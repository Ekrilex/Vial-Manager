<!-- Inicio de formulario -->
<form action="<?php echo getUrl("Usuario","Usuario","postCreate",false,"ajax");?>" method="POST">
     <div class="col-md-12" style="margin-top: 20px;">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Registrar Usuario</div>
            </div>
            <div class="card-body" style="background-color: #1f283e">
                <?php if (isset($_SESSION['errores'])) { ?>
                <div class="alert alert-danger alert-dismissible fade show text-white" style="background-color: #1f283e;"  role="alert">
                    <?php
                        foreach ($_SESSION['errores'] as $errores => $error) {
                            echo $error."<br>";
                        }
                    ?>
                    <button type="button" class="close btn btn-border" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="ture">&times;</span>
                    </button>
                </div>
                <?php } unset($_SESSION['errores']); ?>
                <div class="form-row">
                    <div id="input1" class="form-group col-md-3">
                        <label for="inputEmail4">Primer Nombre</label>
                        <input type="text" class="form-control validacion" name="primer_nombre" id="pri_nombre"  placeholder="Ingrese el primer nombre" onchange="valVarchar(this,'ad1','input1')">
                        <small id="ad1" class="form-text text-muted text-danger"></small>
                        <div id="error"></div>
                    </div>

                    <div id="input2" class="form-group col-md-3">
                        <label for="inputPassword4">Segundo Nombre</label>
                        <input type="text" class="form-control validacion" name="segundo_nombre" id="seg_nombre"  placeholder="Ingrese el segundo nombre" onchange="valVarchar(this,'ad2', 'input2')" >
                        <small id="ad2" class="form-text text-muted text-danger"></small>
                        <div id="error"></div>
                    </div>

                    <div id="input3" class="form-group col-md-3">
                        <label for="inputPassword4">Primer Apellido</label>
                        <input type="text" class="form-control validacion" name="primer_apellido" id="pri_apellido"  placeholder="Ingrese el primer apellido" onchange="valVarchar(this,'ad3', 'input3')">
                        <small id="ad3" class="form-text text-muted text-danger"></small>
                        <div id="error"></div>
                    </div>

                    <div id="input4" class="form-group col-md-3">
                        <label for="inputPassword4">Segundo Apellido</label>
                        <input type="text" class="form-control validacion" name="segundo_apellido" id="seg_apellido"  placeholder="Ingrese el segundo apellido" onchange="valVarchar(this,'ad4', 'input4')">
                        <small id="ad4" class="form-text text-muted text-danger"></small>
                        <div id="error"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div id="input5" class="form-group col-md-8">
                        <label for="inputAddress">Correo Electronico</label>
                        <input type="text" class="form-control" name="Correo_electronico" id="correo"  placeholder="Ingrese el correo electronico" data-url="<?php echo getUrl('Usuario','Usuario','mailCheck',false,'ajax') ?>" >
                        <small id="ad5" class="form-text text-muted text-danger"></small>
                        <small id="confirm" class="form-text text-muted text-info"></small>
                        <div id="error"></div>
                    </div>

                    <div id="input6" class="form-group col-md-4">
                        <label for="inputAddress2">Telefono</label>
                        <input type="text" class="form-control validacion" name="Telefono" id="telefono" placeholder="Ingrese el telefono" onchange="valInt(this, 'ad7', 'input6')" >
                        <small id="ad7" class="form-text text-muted text-danger"></small>
                        <div id="error"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div id="input7" class="form-group col-md-5">
                        <label for="inputCity">Numero de documento</label>
                        <input type="text" class="form-control validacion" name="numero_documento" id="num_documento"  placeholder="Ingrese el numero de documento" onchange="valInt(this, 'ad8', 'input7')" >
                        <small id="ad8" class="form-text text-muted text-danger"></small>
                        <div id="error"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputState">Tipo de documento</label>
                        <select id="tipo_documento" class="form-control" name="documento">
                        <option value="" selected>Seleccione...</option>
                        <?php
                            while ($index2=pg_fetch_assoc($documentos)) {
                                echo "<option value='".$index2['tip_id']."'>".$index2['tip_descripcion']."</option>";
                            }
                        ?>
                        </select>
                        <small id="ad9" class="form-text text-muted text-danger"></small>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="inputState">Rol</label>
                        <select id="tipo_rol" class="form-control" name="rol" >
                        <option value="" selected>Seleccione...</option>
                        <?php
                            while ($index3=pg_fetch_assoc($roles)) {
                                echo "<option value='".$index3['rol_id']."'>".$index3['rol_nombre']."</option>";
                            }
                        ?>
                        </select>
                        <small id="ad10" class="form-text text-muted text-danger"></small>
                    </div>
                </div>

                <div class="form-row"> 
                    <div id="input8" class="form-group col-md-5">
                        <label for="inputPassword4">Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control validacion" id="password" placeholder="Ingrese la contraseña" name="clave" >
                            <div class="input-group-prepend">
                                <button onclick="mostrarContraseña()" class="btn btn-secondary btn-sm" type="button"><i class="fas fa-eye"></i></button>
                            </div>
                          </div>
                          <div id="error"></div>
                        <small id="ad12" class="form-text text-muted text-danger"></small>
                    </div>

                    <div id="input9" class="form-group col-md-5">
                        <label for="inputPassword4">Confirmar Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control validacion" id="confirmation" placeholder="Ingrese de nuevo la contraseña" name="clave2" >
                            <div class="input-group-prepend">
                                <button onclick="mostrarContraseña2()" class="btn btn-secondary btn-sm" type="button"><i class="fas fa-eye"></i></button>
                            </div>
                          </div>
                          <div id="error"></div>
                        <small id="ad13" class="form-text text-muted text-danger"></small>
                    </div>
                </div>
            </div>
            <div class="card-action">
                <button type="submit" class="btn btn-danger">Cancelar</button>
                <button type="submit" class="btn btn-success" id="enviar" onclick="return mainValidationRegister();">Aceptar</button>
            </div>
        </div>
    </div>
    
    <!-- <div class="modal" id="ventana">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-l">Registrar usuario</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                         <p class="modal-l">¿Esta seguro que desea guardar este registro?</p>
                    </div>
                    <div class="modal-footer" style="font-size:18px;">
                        <input type="submit" name="Si" value="Si" class="btn btn-primary" id="bor">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>            
                    </div>
              </div>
          </div>
      </div>
      
        <div class="modal" id="ventana2">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                 <h5 class="modal-l">Registrar usuario</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <div class="modal-body">
                    <p class="modal-l">¿Esta seguro que no desea guardar este registro?</p>
              </div>
              <div class="modal-footer" style="font-size:18px;">
                <a href="../Web/index.php"><button type="button" class="btn btn-primary">Si</button></a>    
                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>      
              </div>
            </div>
          </div>
        </div> -->
</form>

