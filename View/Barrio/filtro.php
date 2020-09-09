<?php
    while($bar=pg_fetch_assoc($barrios)){
    // foreach($barrios as $bar){
        echo "<tr>";
        echo "<td>".$bar['bar_id']."</td>";
        echo "<td>".$bar['bar_descripcion']."</td>";
        echo "<td>".$bar['com_id']."</td>";
        echo "<td>".$bar['com_ubicacion']."</td>";
        echo "<td> <a href='".getUrl("Barrio","Barrio","getUpdate",array("bar_id"=>$bar['bar_id']))."'>
            <button data-toggle='tooltip' class='btn btn-link btn-primary btn-lg' data-original-title='Editar'>
            <i class='icon-note'></i></button></a> </td>";
        echo "<td> <a href='".getUrl("Barrio","Barrio","getDelete",array("bar_id"=>$bar['bar_id']))."'>
            <button data-toggle='tooltip' class='btn btn-link btn-danger' data-original-title='Eliminar'>
            <i class='flaticon-interface-5'></i> </button></a> </td>";
        echo "</tr>";
    }
?>