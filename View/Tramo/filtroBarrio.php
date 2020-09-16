<?php
    if(pg_num_rows($barrios) > 0){
        while($bar = pg_fetch_assoc($barrios)){
            echo "<tr>";
                echo "<td>".$bar['bar_id']."</td>";
                echo "<td>".$bar['bar_descripcion']."</td>";
                echo "<td>".$bar['com_id']."</td>";
                echo "<td>"
                ."<button class='btn btn-primary' id='seleccionarBarrio' value='".$bar['bar_id']."' data-url='".getUrl('Tramo','Tramo','elegirBarrio',false,'ajax')."'>Seleccionar</button>"
                ."</td>";
            echo "</tr>";
        }
    }else{

        echo "<label><span><i class='fas fa-info-circle'></i></span>&nbsp;No se han encontrado resultados de su busqueda</label>";

    }
?>