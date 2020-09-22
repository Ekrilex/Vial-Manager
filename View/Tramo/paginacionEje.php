<div id="cuentaPaginas"><?php echo "Pagina: 1 "." De ".$numeroPaginas;?></div>
<nav>

    <ul class="pagination justify-content-end">
        
        <li class="page-item text-dark disabled" id="anterior"><a class="page-link paginacionStatic" data-paginasTotales="<?php echo $numeroPaginas;?>" data-accion="0" data-urlPagina="<?php echo getUrl("Tramo","Tramo","postPaginacionEje",false,"ajax");?>">Anterior</a></li>
        <?php 
            for($i = 0;$i<$numeroPaginas;$i++){
                /*ciclo que genera los botones de las paginas, la paginas que se visualicen estaran dentro del
                rango de los valores inicioCuenta y finCuenta, debido a que estos se utilizan si 
                es necerario "rotar" la paginacion debido a una cantidad grande de paginas*/
                if(($i+1) >= $inicioCuenta && ($i+1) <= $finCuenta){
                    if($i == 0){
                        echo "<li class='page-item active' id='pagina".($i+1)."'><a class='page-link elemPaginacion' data-numeroPagina='".$i."' data-paginasTotales='".$numeroPaginas."' data-urlPagina='".getUrl("Tramo","Tramo","postPaginacionEje",false,"ajax")."'>".($i+1)."</a></li>";
                    }else{
                        echo "<li class='page-item text-dark' id='pagina".($i+1)."'><a class='page-link elemPaginacion' data-numeroPagina='".$i."' data-paginasTotales='".$numeroPaginas."' data-urlPagina='".getUrl("Tramo","Tramo","postPaginacionEje",false,"ajax")."'>".($i+1)."</a></li>";
                    }

                }else{
                    /*las paginas que se encuentren fuera del rango tendran un display: "none" para que no 
                    aparezcan en la interfaz y puedan ser activadas en el futuro cuando se rote la paginacion*/ 
                    echo "<li class='page-item text-dark' style='display:none;' id='pagina".($i+1)."'><a class='page-link elemPaginacion' data-numeroPagina='".$i."' data-paginasTotales='".$numeroPaginas."' data-urlPagina='".getUrl("Tramo","Tramo","postPaginacionEje",false,"ajax")."'>".($i+1)."</a></li>";
                }
            }

            /*si la consulta tiene menos de 7 paginas el algoritmo no realizara la rotacion de estas
            ya que el maximo y el minimo estan visibles al usuario*/
        
        ?>
                                            
        <li class="page-item text-dark <?php if($numeroPaginas == 1){ echo "disabled";} ?>" id="siguiente"><a class="page-link paginacionStatic" data-paginasTotales="<?php echo $numeroPaginas;?>" data-accion="1" data-urlPagina="<?php echo getUrl("Tramo","Tramo","postPaginacionEje",false,"ajax");?>">Siguiente</a></li>
    </ul>
    <input type='hidden' id="inicioCuentaEje" value="<?php echo $inicioCuenta;?>">
    <input type='hidden' id="finCuentaEje" value="<?php echo $finCuenta;?>">
</nav>  