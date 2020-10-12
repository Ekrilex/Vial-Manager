<div class="modal fade" id="ventanaMapa" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header btn-secondary">
        <h5 class="modal-title" id="staticBackdropLabel">Interfaz de prueba</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body btn-default">
        <div>
            <div><h5>Por Favor registre la ubicacion del deterioro en el mapa con la opcion: <img</h5></div><br>

            <div class="mscross" style="width:950px; height:650px; -moz-user-select:none; border:2px solid rgb(128,76,249);" id="dc_main"></div>
            
            
            <script type="text/javascript">
                myMap1 = new msMap(document.getElementById("dc_main"), "standardLeft");

                myMap1.setCgi("/cgi-bin/mapserv.exe");

                //myMap1.setMapFile('/ms4w/Apache/htdocs/RepositorioVialManager/Vial-Manager/Web/assets/Maps/Segmentacion.map');
                myMap1.setMapFile('/ms4w/Apache/htdocs/ADSI/VIALMANAGER/Vial-Manager/Web/assets/Maps/Segmentacion.map');

                myMap1.setFullExtent(1049214.34, 1078487.53, 860243.46);
                myMap1.setLayers('Cali SegmentacionNoLabel');


                /*myMap2 = new msMap(document.getElementById("dc_main2"));

                myMap2.setActionNone();
                myMap2.setFullExtent(1054114.34, 1068487.53, 860243.46);*/

                //myMap2.setMapFile('/ms4w/Apache/htdocs/RepositorioVialManager/Vial-Manager/Web/assets/Maps/Segmentacion.map');
               /* myMap2.setMapFile('/ms4w/Apache/htdocs/ADSI/VIALMANAGER/Vial-Manager/Web/assets/Maps/Segmentacion.map');

                myMap2.setLayers('Cali');
                myMap1.setReferenceMap(myMap2);*/


                //Clase 30/09/2020
                //agregar boton al toolbar del mapa

                var insertarDano = new msTool('ObtenerCoordenadas', insertd, '../View/Visor/misc/img/marker-gold.png', queryI);

                myMap1.getToolbar(0).addMapTool(insertarDano);

                var seleccionado = false;

                function insertd(event, map) { //function que determinara si la opcion fue elegida y cambia el estilo del cursor

                    map.getTagMap().style.cursor = "crosshair";
                    seleccionado = true;
                }

                function queryI(event, map, x, y, xx, yy) {

                    if (seleccionado) {
                        alert("Coordenadas del mapa: " + x + " y " + y + " reales x : " + xx + " reales y: " + yy);
                        seleccionado = false;
                        map.getTagMap().style.cursor = "default";
                        
                        // var pixelesY = parseInt($('#dc_main').css('height').substr(0, 3));

                        // pixelesY = y/pixelesY;

                        

                        // var coordenadaY = 860243.46 +((1068487.53 - 860243.46 )*pixelesY);

                        //alert("y:"+coordenadaY);

                        document.getElementById("coordenadasx").value = xx;
                        document.getElementById("coordenadasy").value = yy+1000;

                        $('#ventanaMapa').modal('hide');
                    }

                    

                    // console.log(document.getElementById("cordenadaX").value);
                    // console.log(document.getElementById("cordenadaY").value);
                }

                myMap1.redraw();
                //myMap2.redraw();
            </script>
            <script type="text/javascript" src="assets/js/ajaxConsultarPunto.js"></script>
        </div>
      </div>
      <div class="modal-footer btn-default">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>