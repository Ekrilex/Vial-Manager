
<?php
      while ($cas=pg_fetch_assoc($Caso)) {        
        echo "<tr style='text-align:center;'>";
        echo "<td>".$cas['cas_det_id']."</td>";
        echo "<td>".$cas['cas_det_gravedad']."</td>";
        echo "<td>".$cas['cas_det_area']."</td>"; 
        echo "<td>".$cas['cas_det_extension']."</td>";
        echo "<td>".$cas['deterioro_id']."</td>";
        echo "<td>".$cas['caso_id']."</td>";
        echo "</tr>";        
      }

?>		
