
<!--Hoja de estilos utilizada es web/assets/css/demo.css-->

<!-- <div class="container fondo"><br>

      <div style="text-align:center;background:white;color:blue;border-radius:50px 50px 50px;">

      <h2>Registrar usuario <span class="fas fa-user-plus" style="color:blue;"></span></h2>

</div><br>
  <form action="<?php echo getUrl("Usuario","Usuario","postCreate"); ?>" method="POST">

      <div style="width:95%;  border: 1 solid red;" class="container personal letra">
            <div class="row">
                  <div class="col-md-3">
                      <h3>Primer nombre: </h3>	
                  </div>     
                  <div class="col-md-3">
                     <input type="text" class="form-control"  id="bor1" name="primer_nombre">
                  </div> 
                  <div class="col-md-3">
                      <h3>Segundo nombre: </h3>	
                  </div>  
                  <div class="col-md-3">
                     <input type="text" class="form-control" id="bor2" name="segundo_nombre">
                  </div>         
            </div><br>
        <div class="row">
          <div class="col-md-3">
                <h3>Primer apellido:</h3>
          </div>
          <div class="col-md-3">
               <input type="text" class="form-control" id="bor3" name="primer_apellido">
          </div>
          <div class="col-md-3">
               <h3>Segundo apellido:</h3>
         </div>
          <div class="col-md-3">
              <input type="text"  class="form-control"  id="bor4" name="segundo_apellido">
          </div>
      </div><br>
          <div class="row">
          <div class="col-md-3">
            <h3>Tipo identificación:</h3>
          </div>
          <div class="col-md-3">
              <select class="form-control" name="documento" id="bor5">
              <option value="">Seleccione...</option>
              </select><br>
          </div>
          <div class="col-md-3">
            <h3>Numero de documento:</h3>
          </div>
          <div class="col-md-3">
             <input type="number" class="form-control"  id="bor6"name="numero_documento">
          </div>
      </div>

      <div class="row">
          <div class="col-md-3">
            <h3>Correo electronico:</h3>
          </div>	
          <div class="col-md-3">
            <input type="text"  class="form-control"  id="bor7" name="Correo_electronico">
          </div><br>
          <div class="col-md-3">
            <h3>Telefono:</h3>

          </div>
          <div class="col-md-3">
            <input type="number"  class="form-control"id="bor8" name="Telefono">
          </div>
      </div>
      </div><br><br>
          <div style="width:95%;  border: 1 solid red;" class="container personal letra">
            
            <div class="row">
                <div class="col-md-3">
                    <h3>Nickname: </h3>	
                </div>     
                <div class="col-md-3">
                  <input type="text" class="form-control" id="bor9" name="Nickname">
                </div> 
                <div class="col-md-3">
                  <h3>Rol: </h3>	
                </div>  
                <div class="col-md-3">
            <select class="form-control" name="rol" id="bor10">
              <option value="">Selecionne...</option>
              </select><br>  
                </div>         
            </div><br>
        <div class="row">
            <div class="col-md-3">
              <h3>Contraseña:</h3>
            </div>
            <div class="col-md-3">
                 <input type="password" class="form-control" id="bor11" name="clave">
            </div>
            <div class="col-md-3">
                 <h3>Confirmar contraseña:</h3>
           </div>
            <div class="col-md-3">
                <input type="password"  class="form-control"  id="bor12"name="confirmar_contraseña">
            </div>
         </div>
      </div><br><br>
      <div class="row" id="bon">
          <div class="col-md-4"></div>
            <div class="col-md-2 "> 
                <a class="boton-interfaz guardar" href="#ventana" data-toggle="modal"><button type="button" class="btn btn-primary">Guardar</button></a>
            </div>
            <div class="col-md-2 ">
               <a class="boton-interfaz cancelar" href="#ventana2" data-toggle="modal"><button type="button" class="btn btn-danger">Cancelar</button></a>
           </div>
      </div>
      <br><br>
      <div class="modal" id="ventana">
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
        </div>
    </form>
</div> -->

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

