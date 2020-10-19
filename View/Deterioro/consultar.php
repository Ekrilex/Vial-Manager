
<div class="container"><br>
<br>
<script type="text/javascript"> setTimeout(function() { $(".alert").fadeOut(5000); },1000); </script>

<?php

if (isset($_SESSION['result'])) {

       echo "<div class='container'>
             <div class='alert alert-warning alert-dismissible fade show text-dark' role='alert'>";
             foreach ($_SESSION['result'] as $result2 => $res2) { 
              echo $res2;
             } 
       echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button></div><br>"; 

}unset($_SESSION['result']); 

?>
 
<div class="card col-md-12 col-sm-12 col-lg-12" style="max-width: 73rem;">
  <div class="card-header">
    <div class="d-flex align-items-center">
      <h3 class="card-title">Consultar deterioros&nbsp;&nbsp;<span class="icon-book-open"></span>&nbsp;&nbsp;<span class="icon-magnifier"></span></h3>

      <a type="button" class="text-light btn btn-success btn-round ml-auto" data-toggle="modal" data-target="#Nuevo">
      <i class="fa fa-plus"></i> A&ntilde;adir Deterioro</a>
    </div>
  </div>  
    <br>
    <!--<div class="row">
        <div class="col-lg-1 col-md-1 col-sm-1"></div>
        <div class="col-md-2 col-sm-3 col-lg-2 text-white">
        <h4>Buscar:</h4>   
        </div>
        <div class="col-md-7 col-sm-7 col-lg-5">
        <input class="form-control" id="filtro" data-url="<?php //echo getUrl("Deterioro","Deterioro","filtro",false,"ajax"); ?>" type="text" placeholder=" Buscar..">        
        </div>
    
      </div><br>--> 
     
      <div class="table-responsive">
       <table id="Tbl-deterioro" class="display table table-striped table-hover table-head-bg-secondary  table-striped-bg-default" >
         <thead>
          <tr>
           <th>#</th> 
           <th>Nombre deterioro</th>
           <th>Tipo deterioro</th>
           <th>Clasificaci&oacute;n</th>
           <th style="width: 19%;text-align: center;">Acci&oacute;n</th>
          </tr>
         </thead>
          <tbody>
           <?php
             while ($det=pg_fetch_assoc($deterioro)) {
        
              echo "<tr>";
              echo "<td>".$det['det_id']."</td>";
              echo "<td>".$det['det_nombre']."</td>";
              echo "<td>".$det['det_tipo_deterioro']."</td>";
              echo "<td>".$det['det_clasificacion']."</td>";
              echo "<td><button data-toggle='tooltip' class='btn btn-link btn-primary icon-note' id='editar' value='".$det['det_id']."' data-url='".getUrl("Deterioro","Deterioro","getUpdate",false,"ajax")."' data-original-title='Editar'></button>"
                      ."&nbsp;&nbsp;&nbsp;<button data-toggle='tooltip' class='btn btn-link btn-danger flaticon-interface-5' id='eliminar' value='".$det['det_id']."' data-url='".getUrl("Deterioro","Deterioro","postDelete",false,"ajax")."' data-original-title='Eliminar'></button></td>";
              echo "</tr>";
           } ?>
          </tbody>
        </table>
        <br><br>
      </div>
  

    <div class="modal col-md-12 col-sm-12 " id="Nuevo" data-backdrop="static"> 
     <div class="modal-dialog">
      <div class="modal-content">
       <div class="modal-header btn-success">
        <h3 class="modal-title text-white">Nuevo deterioro</h3>
       </div>
      <div class="modal-body btn-default">
        <div id="errores"></div>
          <form id="formEjemplo"> 
           
          <div class="row">
            <span class="col-md-1"></span>
            <div class="col-md-4 text-white">
              <h5>Nombre</h5>
            </div>
            <div class="col-md-6">
              <input type="text" class="form-control nombreD border border-success">
            </div>
            <div class="container" id="err"></div>
          </div><br><br>

          <div class="row">
             <span class="col-md-1"></span>    
           <div class="col-md-4 text-white">
             <h5>Tipo de da&ntilde;o</h5>
           </div>
           <div class="col-md-6">
             <select class="form-control Dano border border-success">
             <option value="">Seleccione..</option>
             <?php
              foreach ($tiposs as $tip) {
               echo "<option value='".$tip."'>".$tip."</option>";
             } ?>
             </select>
           </div>
           <div id="errN"></div>      
          </div><br><br>

          <div class="row">
            <span class="col-md-1"></span>    
           <div class="col-md-4 text-white">
            <h5>Clasificaci&oacute;n</h5>
           </div>
           <div class="col-md-6">
             <select class="form-control Clasi border border-success">
             <option value="">Seleccione..</option>
             <?php
              foreach ($clasi as $cla) {
              echo "<option value='".$cla."'>".$cla."</option>";
             } ?>
             </select>
           </div>
          </div><br><br>
      </div>
     </form> 
        <div class="modal-footer btn-default">
        <button type="submit" class="btn btn-primary guardar" data-url="<?php echo getUrl("Deterioro","Deterioro","postCreate",false,"ajax"); ?>">Guardar</button>
        <button type="button" class="btn btn-secondary cerrar" data-dismiss="modal">Cerrar</button>
        </div>     
      </div>
     </div>
    </div>


    <div class="modal col-md-12 col-sm-12" id="modal_editar">
     <div class="modal-dialog">
      <div class="modal-content">
       <form action="<?php echo getUrl("Deterioro","Deterioro","postUpdate"); ?>" method="POST">            
        <div class="modal-header btn-primary">
            <h3 class="modal-title text-white">Actualizar registro</h3>
        </div>
        <div class="modal-body btn-default">
          <div id="contenido_editar" class="text-white"></div>      
        </div>
        <div class="modal-footer btn-default">
        <input type="submit" class="btn btn-primary actualizar" value="Actualizar">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
       </form>
      </div>
     </div>
    </div>


  <!-- <div class="modal col-md-12 col-sm-12" id="modal_eliminar">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="<?php //echo getUrl("Deterioro","Deterioro","postDelete"); ?>" method="POST">          
        <div class="modal-header btn-danger">
          <h3 class="modal-title text-white">Eliminar registro</h3>
        </div>
        <div class="modal-body btn-default">
        <h3 class="container text-white" style="text-align:center;">¿Esta seguro de eliminar este registro?</h3>
            <div id="cotenido_eliminar" class="text-white"></div>  
        </div>
        <div class="modal-footer btn-default">
          <input type="submit" class="btn btn-danger" value="Aceptar">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
        </form>   
      </div>
    </div>
  </div> -->
</div>
<?php 
    $prueba=" ";
    while($Cade=pg_fetch_assoc($casoDeterioro)){
        
        $prueba.=$Cade['deterioro_id'].",";
    }
    echo "<input type='hidden' name='deterioros_id' id='deterioros_id' class='btn btn-danger' value=".$prueba.">";

?>
