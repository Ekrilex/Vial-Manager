
<?php 
    if(pg_num_rows($EjeVial)>0){

        while($Ejes = pg_fetch_assoc($EjeVial)){
            echo "<tr>";
                echo "<td>".$Ejes['eje_id']."</td>";
                echo "<td> Eje Vial N° ".$Ejes['eje_numero']."</td>";
                echo "<td>".$Ejes['jer_descripcion']."</td>";
                echo "<td>"
                ."<button class='btn btn-primary' id='seleccionarEje' value='".$Ejes['eje_id']."' data-url='".getUrl('Tramo','Tramo','elegirEje',false,'ajax')."'>Seleccionar</button>"
                ."</td>";
            echo "</tr>";

    
        }
    }else{
        echo "<td colspan='4'><label><span><i class='fas fa-info-circle'></i></span>&nbsp;No se han encontrado ejes con la jerarquia especificada</label></td>";
    }
?>
