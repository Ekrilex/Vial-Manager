<!-- Inicio de formulario -->
<form action="<?php echo getUrl("Usuario","Usuario","postCreate");?>" method="POST">
     <div class="col-md-12" style="margin-top: 20px;">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Registrar Usuario</div>
            </div>
            <div class="card-body" style="background-color: #1f283e">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="inputEmail4">Primer Nombre</label>
                        <input type="text" class="form-control validacion" name="primer_nombre"  placeholder="Ingrese el primer nombre" >
                        <div id="error"></div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="inputPassword4">Segundo Nombre</label>
                        <input type="text" class="form-control validacion" name="segundo_nombre"  placeholder="Ingrese el segundo nombre" >
                        <div id="error"></div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="inputPassword4">Primer Apellido</label>
                        <input type="text" class="form-control validacion" name="primer_apellido"  placeholder="Ingrese el primer apellido" >
                        <div id="error"></div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="inputPassword4">Segundo Apellido</label>
                        <input type="text" class="form-control validacion" name="segundo_apellido"  placeholder="Ingrese el segundo apellido" >
                        <div id="error"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="inputAddress">Correo Electronico</label>
                        <input type="text" class="form-control" name="Correo_electronico"  placeholder="Ingrese el correo electronico" >
                        <div id="error"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputAddress2">Telefono</label>
                        <input type="text" class="form-control validacion" name="Telefono"  placeholder="Ingrese el telefono" >
                        <div id="error"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="inputCity">Numero de documento</label>
                        <input type="text" class="form-control validacion" name="numero_documento"  placeholder="Ingrese el numero de documento" >
                        <div id="error"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputState">Tipo de documento</label>
                        <select id="inputState" class="form-control" name="documento">
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
                        <select id="inputState" class="form-control" name="rol" >
                        <option selected>Seleccione</option>
                        <?php
                            foreach ($roles as $index3) {
                                echo "<option value='".$index3['rol_id']."'>".$index3['rol_nombre']."</option>";
                            }
                        ?>
                        </select>
                    </div>
                </div>

                <div class="form-row"> 
                    <div class="form-group col-md-5">
                        <label for="inputPassword4">Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control validacion" id="inputtext" placeholder="Ingrese la contraseña" name="clave" >
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary btn-sm" type="button"><i class="fas fa-eye"></i></button>
                            </div>
                          </div>
                          <div id="error"></div>
                        <small class="form-text text-muted">
                            La contraseña debera de contener al menos una mayuscula y 5 numeros.
                        </small>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="inputPassword4">Confirmar Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control validacion" id="inputtext" placeholder="Ingrese de nuevo la contraseña" >
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary btn-sm" type="button"><i class="fas fa-eye"></i></button>
                            </div>
                          </div>
                          <div id="error"></div>
                        <small class="form-text text-muted">
                            Recuerde la contraseña debera de coincidir con la anterior
                        </small>
                    </div>
                </div>
            </div>
            <div class="card-action">
                <button type="submit" class="btn btn-danger">Cancelar</button>
                <button type="submit" class="btn btn-success" id="enviar">Aceptar</button>
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

