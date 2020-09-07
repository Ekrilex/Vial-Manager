  <?php
  
      foreach ($deterioro as $det) {

        echo "<tr>";
        echo "<td>".$det['det_id']."</td>";
        echo "<td>".$det['det_nombre']."</td>";
        echo "<td>".$det['det_tipo_deterioro']."</td>";

    echo "<td><button class='btn btn-primary' id='g' value='".$det['det_id']."' data-url='".getUrl("Deterioro","Deterioro","getUpdate",false,"ajax")."'>Modificar</button></td>";
         echo "<td><button class='btn btn-danger' id='e' value='".$det['det_id']."' data-url='".getUrl("Deterioro","Deterioro","getDelete",false,"ajax")."'>Eliminar</button></td>";
        echo "</tr>";
       }
  ?>