 <?php
    while ($det=pg_fetch_assoc($deterioro)) {
        
    echo "<tr>";
    echo "<td>".$det['det_id']."</td>";
    echo "<td>".$det['det_nombre']."</td>";
    echo "<td>".$det['det_tipo_deterioro']."</td>";
    echo "<td>".$det['det_clasificacion']."</td>";
    echo "<td><button data-toggle='tooltip' class='btn btn-link btn-primary icon-note' id='editar' value='".$det['det_id']."' data-url='".getUrl("Deterioro","Deterioro","getUpdate",false,"ajax")."' data-original-title='Editar'></button></td>";
    echo "<td><button data-toggle='tooltip' class='btn btn-link btn-danger flaticon-interface-5' id='eliminar' value='".$det['det_id']."' data-url='".getUrl("Deterioro","Deterioro","getDelete",false,"ajax")."' data-original-title='Eliminar'></button></td>";
    echo "</tr>";
} ?>