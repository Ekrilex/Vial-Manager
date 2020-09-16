<?php 
    while($calzada = pg_fetch_assoc($calzadas)){
        echo "<option value='".$calzada['cal_id']."'>".$calzada['cal_calzada']." - ".$calzada['cal_orientacion_carril']."</option>";
    }
?>