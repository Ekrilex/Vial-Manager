
<section id="heroVista" class="d-flex align-items-center justify-content-center">
   

</section>
 
<main id="main">
    
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <h1 class="text-center">Este espacio es para el GeoVisor de la ciudad de Cali</h1>
            <div class="mscross" style="margin-left:10%; width:900px; height:700px; -moz-user-select:none; position:relative; " id="dc_main"></div>
            <div id="Layer1">
                <div style="width:200px; margin-top: -30px; margin-left:70px; height:240px; -moz-user-select:none; position:relative; z-index: 100;" id="dc_main2"></div>
            </div>

        </div>
        <hr>
    </section>

    <?php include_once '../View/Mapa/ModalConsultarPunto.php'; ?>

</main>

<a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
<div id="preloader"></div>
<script type="text/javascript">
		myMap1 = new msMap(document.getElementById("dc_main"), "standardLeft");

		myMap1.setCgi("/cgi-bin/mapserv.exe");

		myMap1.setMapFile('/ms4w/Apache/htdocs/RepositorioVialManager/Vial-Manager/Web/assets/Maps/Segmentacion.map');
		//myMap1.setMapFile('/ms4w/Apache/htdocs/ADSI/VIALMANAGER/Vial-Manager/Web/assets/Maps/Segmentacion.map');

		myMap1.setFullExtent(1049214.34, 1078487.53, 860243.46);
		myMap1.setLayers('Cali SegmentacionNoLabel puntosMapa');


		myMap2 = new msMap(document.getElementById("dc_main2"));

		myMap2.setActionNone();
		myMap2.setFullExtent(1054114.34, 1068487.53, 860243.46);

		myMap2.setMapFile('/ms4w/Apache/htdocs/RepositorioVialManager/Vial-Manager/Web/assets/Maps/Segmentacion.map');
		//myMap2.setMapFile('/ms4w/Apache/htdocs/ADSI/VIALMANAGER/Vial-Manager/Web/assets/Maps/Segmentacion.map');

		myMap2.setLayers('Cali SegmentacionNoLabel');
		myMap1.setReferenceMap(myMap2);


		//Clase 30/09/2020
		//agregar boton al toolbar del mapa

		var insertarDano = new msTool('Cosultar Informacion Via', consultarDeterioro, '../View/Mapa/misc/img/point.png', queryC);

		myMap1.getToolbar(0).addMapTool(insertarDano);



		function chgLayers() {
			var list = "Layers ";
			var objForm = document.forms[0];

			for (i = 0; i < document.forms[0].length; i++) {

				if (objForm.elements["layer[" + i + "]"].checked == true) {

					list += objForm.elements["layer[" + i + "]"].value + " ";

				}



				myMap1.setLayers(list + " Norte");
				myMap2.setLayers(list);
				myMap1.redraw();
				myMap2.redraw();
			}

        }
        
        var seleccionado = false;

		function consultarDeterioro(event, map) { //function que determinara si la opcion fue elegida y cambia el estilo del cursor

			map.getTagMap().style.cursor = "crosshair";
			seleccionado = true;
		}

		function queryC(event, map, x, y, xx, yy) {

			if (seleccionado) {
				//alert("Coordenadas del mapa: "+x+" y "+y+ " reales x : " + xx + " reales y: " + yy);
				<?php
				$urlControlador = getUrl("Mapa", "Mapa", "indexPoint", false, "ajax");
				?>

				var urlControlador = "<?php echo $urlControlador; ?>";
				validaConsultar(xx, yy, urlControlador);
				seleccionado = false;
				map.getTagMap().style.cursor = "default";
			}
        }
        
        myMap1.redraw();
		myMap2.redraw();
	</script>
    <script type="text/javascript" src="../../assets/js/ajaxConsultarPunto.js"></script>
