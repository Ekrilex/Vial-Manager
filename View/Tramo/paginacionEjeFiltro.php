<div id="cuentaPaginas"><?php echo "Pagina: 1 "." De ".$numeroPaginas;?></div>
<nav>
    <ul class="pagination justify-content-end">
        
        <li class="page-item text-dark disabled" id="anterior"><a class="page-link paginacionStatic" data-busqueda="<?php echo $ejeBuscado?>" data-filtro="true" data-paginasTotales="<?php echo $numeroPaginas;?>" data-accion="0" data-urlPagina="<?php echo getUrl("Tramo","Tramo","postPaginacionEje",false,"ajax");?>">Anterior</a></li>
        <?php 
            for($i = 0;$i<$numeroPaginas;$i++){
                if(($i+1) >= $inicioCuenta && ($i+1) <= $finCuenta){

                    if($i == 0){
                        echo "<li class='page-item active' id='pagina".($i+1)."'><a class='page-link elemPaginacion' data-busqueda='".$ejeBuscado."' data-filtro='true' data-numeroPagina='".$i."' data-paginasTotales='".$numeroPaginas."' data-urlPagina='".getUrl("Tramo","Tramo","postPaginacionEje",false,"ajax")."'>".($i+1)."</a></li>";
                    }else{
                        echo "<li class='page-item text-dark' id='pagina".($i+1)."'><a class='page-link elemPaginacion' data-busqueda='".$ejeBuscado."' data-filtro='true' data-numeroPagina='".$i."' data-paginasTotales='".$numeroPaginas."' data-urlPagina='".getUrl("Tramo","Tramo","postPaginacionEje",false,"ajax")."'>".($i+1)."</a></li>";
                    }

                }else{
                    echo "<li class='page-item text-dark' style='display:none;' id='pagina".($i+1)."'><a class='page-link elemPaginacion' data-busqueda='".$ejeBuscado."' data-filtro='true' data-numeroPagina='".$i."' data-paginasTotales='".$numeroPaginas."' data-urlPagina='".getUrl("Tramo","Tramo","postPaginacionEje",false,"ajax")."'>".($i+1)."</a></li>";
                }
            }
        
        ?>
                                            
        <li class="page-item text-dark <?php if($numeroPaginas == 1){ echo "disabled";} ?>" id="siguiente"><a class="page-link paginacionStatic" data-busqueda="<?php echo $ejeBuscado?>" data-filtro="true" data-paginasTotales="<?php echo $numeroPaginas;?>" data-accion="1" data-urlPagina="<?php echo getUrl("Tramo","Tramo","postPaginacionEje",false,"ajax");?>">Siguiente</a></li>
    </ul>
    <input type='hidden' id="inicioCuentaEje" value="<?php echo $inicioCuenta;?>">
    <input type='hidden' id="finCuentaEje" value="<?php echo $finCuenta;?>">
</nav>  