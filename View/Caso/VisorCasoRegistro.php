<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Registrar Caso</div>
        </div>

        <div class="card-body">
            <div class="form-row">
                <div><label class="text-light" style="font-size:20px;">Por Favor registre la ubicacion del deterioro en el mapa con la opcion: <img src="../View/Visor/misc/img/point.png" alt="la imagen no se pudo cargar"></label></div>
                <div class="mscross" style="width:950px; height:650px; -moz-user-select:none; border:2px solid rgb(128,76,249);" id="dc_main"></div>

                <script type="text/javascript">
                    myMap1 = new msMap(document.getElementById("dc_main"), "standardLeft");
                    myMap1.setCgi("/cgi-bin/mapserv.exe");
                    
                    //myMap1.setMapFile('/ms4w/Apache/htdocs/ADSI/VIALMANAGER/Vial-Manager/Web/assets/Maps/Segmentacion.map');
                    myMap1.setMapFile('/ms4w/Apache/htdocs/RepositorioVialManager/Vial-Manager/Web/assets/Maps/Segmentacion.map');

                    myMap1.setFullExtent(1049214.34, 1078487.53, 860243.46);
                    myMap1.setLayers('Cali SegmentacionNoLabel');

                    var insertarDano = new msTool('ObtenerCoordenadas', insertd, '../View/Visor/misc/img/point.png', queryI);

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

                            document.getElementById("coordenadasx").value = xx;
                            document.getElementById("coordenadasy").value = yy;

                            $('#ventanaMapa').modal('hide');
                        }

                    }

                    myMap1.redraw();
                </script>
                <script type="text/javascript" src="assets/js/ajaxConsultarPunto.js"></script>
            </div>
            Por favor ingrese la imagen inicial del caso
            <br>
            <label for="file-upload" class="custom-file-upload">
                Adjuntar Imagen
            </label>
            <input id="file-upload" class="validacionMap" name="img_caso" type="file" />
        </div>

        <div class="card-footer">
            <div>
                <input type="hidden" class="validacionMap" id="coordenadasx" name="coordenadasx" value="">
                <input type="hidden" class="validacionMap" id="coordenadasy" name="coordenadasy" value="">
                <a class="btn btn-danger text-light mt-2" href="<?php echo getUrl("Caso", "Caso", "index") ?>">Cancelar</a>
                <button type="submit" class="btn btn-success mt-2 ml-2">Guardar Caso</button>
            </div>

        </div>
    </div>
</div>