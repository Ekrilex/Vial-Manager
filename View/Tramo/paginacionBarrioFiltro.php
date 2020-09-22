<nav>
    <div id="cuentaPaginasB"><?php echo "Pagina 1 De ".$numeroPaginas;?></div>
    <ul class="pagination justify-content-end">
    
        <li class="page-item text-dark disabled" id="anteriorB"><a class="page-link paginacionStaticB" data-busqueda="<?php echo $barrioBuscado?>" data-filtro="true" data-paginasTotales="<?php echo $numeroPaginas;?>" data-accion="0" data-urlPagina="<?php echo getUrl("Tramo","Tramo","postPaginacionBarrio",false,"ajax");?>">Anterior</a></li>
        <?php 
            for($i = 0;$i<$numeroPaginas;$i++){

                if(($i+1) >= $inicioCuenta && ($i+1) <= $finCuenta){
                    if($i == 0){
                        echo "<li class='page-item active' id='paginaB".($i+1)."'><a class='page-link elemPaginacionB' data-busqueda='".$barrioBuscado."' data-filtro='true' data-numeroPagina='".$i."' data-paginasTotales='".$numeroPaginas."' data-urlPagina='".getUrl("Tramo","Tramo","postPaginacionBarrio",false,"ajax")."'>".($i+1)."</a></li>";
                    }else{
                        echo "<li class='page-item text-dark' id='paginaB".($i+1)."'><a class='page-link elemPaginacionB' data-busqueda='".$barrioBuscado."' data-filtro='true' data-numeroPagina='".$i."' data-paginasTotales='".$numeroPaginas."' data-urlPagina='".getUrl("Tramo","Tramo","postPaginacionBarrio",false,"ajax")."'>".($i+1)."</a></li>";
                    }
                }else{
                    echo "<li class='page-item text-dark' style='display:none;' id='paginaB".($i+1)."'><a class='page-link elemPaginacionB' data-busqueda='".$barrioBuscado."' data-filtro='true' data-numeroPagina='".$i."' data-paginasTotales='".$numeroPaginas."' data-urlPagina='".getUrl("Tramo","Tramo","postPaginacionBarrio",false,"ajax")."'>".($i+1)."</a></li>";
                }
            }
        
        ?>
                                            
        <li class="page-item text-dark <?php if($numeroPaginas == 1){ echo "disabled";} ?>" id="siguienteB"><a class="page-link paginacionStaticB" data-busqueda="<?php echo $barrioBuscado?>" data-filtro="true" data-paginasTotales="<?php echo $numeroPaginas;?>" data-accion="1" data-urlPagina="<?php echo getUrl("Tramo","Tramo","postPaginacionBarrio",false,"ajax");?>">Siguiente</a></li>
    </ul>
    <input type='hidden' id="inicioCuentaBarrio" value="<?php echo $inicioCuenta;?>">
    <input type='hidden' id="finCuentaBarrio" value="<?php echo $finCuenta;?>">
</nav>  