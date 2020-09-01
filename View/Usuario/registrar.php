<style>
    @media screen and (max-width: 765px){
      .boton-interfaz {

        position:absolute;
        bottom:1px;
        top:-25px;
        
      }

      .guardar{
        left:20%;
      }

      .cancelar{
        left:58%;
      }

      .fondo {
        background-image:url('../Web/assets/img/fondoAlternativoRegistroUsu.jpg');
        background-size:700px 1300px;
      }
    }
</style>
<!--Hoja de estilos utilizada es web/assets/css/demo.css-->

<div class="container fondo"><br>

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
                     <input type="text" class="form-control"  id="bor" name="primer_nombre">
                  </div> 
                  <div class="col-md-3">
                      <h3>Segundo nombre: </h3>	
                  </div>  
                  <div class="col-md-3">
                     <input type="text" class="form-control" id="bor" name="segundo_nombre">
                  </div>         
            </div><br>
        <div class="row">
          <div class="col-md-3">
                <h3>Primer apellido:</h3>
          </div>
          <div class="col-md-3">
               <input type="text" class="form-control" id="bor" name="primer_apellido">
          </div>
          <div class="col-md-3">
               <h3>Segundo apellido:</h3>
         </div>
          <div class="col-md-3">
              <input type="text"  class="form-control"  id="bor" name="segundo_apellido">
          </div>
      </div><br>
          <div class="row">
          <div class="col-md-3">
            <h3>Tipo identificación:</h3>
          </div>
          <div class="col-md-3">
              <select class="form-control" name="documento" id="bor">
                  <option>Cedula de ciudadania</option>
                  <option>Tarjeta de identidad</option>
                  <option>Documento extrangero</option>
              </select><br>
          </div>
          <div class="col-md-3">
            <h3>Numero de documento:</h3>
          </div>
          <div class="col-md-3">
             <input type="number" class="form-control"  id="bor"name="numero_documento">
          </div>
      </div>

      <div class="row">
          <div class="col-md-3">
            <h3>Correo electronico:</h3>
          </div>	
          <div class="col-md-3">
            <input type="text"  class="form-control"  id="bor"name="Correo_electronico">
          </div><br>
          <div class="col-md-3">
            <h3>Telefono:</h3>

          </div>
          <div class="col-md-3">
            <input type="number"  class="form-control"id="bor" name="Telefono">
          </div>
      </div>
      </div><br><br>
          <div style="width:95%;  border: 1 solid red;" class="container personal letra">
            
            <div class="row">
                <div class="col-md-3">
                    <h3>Nickname: </h3>	
                </div>     
                <div class="col-md-3">
                  <input type="text" class="form-control" id="bor" name="Nickname">
                </div> 
                <div class="col-md-3">
                  <h3>Rol: </h3>	
                </div>  
                <div class="col-md-3">
            <select class="form-control" name="Rol" id="bor">
              <option>Alimentador</option>
              <option>Sub-secretario</option>
              <option>Secretario</option>
              <option>Root</option>

              </select><br>  
                </div>         
            </div><br>
        <div class="row">
            <div class="col-md-3">
              <h3>Contraseña:</h3>
            </div>
            <div class="col-md-3">
                 <input type="password" class="form-control" id="bor" name="clave">
            </div>
            <div class="col-md-3">
                 <h3>Confirmar contraseña:</h3>
           </div>
            <div class="col-md-3">
                <input type="password"  class="form-control"  id="bor"name="confirmar_contraseña">
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
</div>
