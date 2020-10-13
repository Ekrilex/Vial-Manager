	<link rel="stylesheet" href="../View/Visor/misc/img/dc.css">

	<?php

	if (!extension_loaded('MapScript')) {
		dl('php_mapscript.' . PHP_SHLIB_SUFFIX);
	}

	$mapa = ms_newMapObj('assets/Maps/Segmentacion.map');

	// $mapa->legend->imagecolor->setRGB(17, 25, 43);
	// $mapa->legend->label->color->setRGB(250, 250, 250);

	$Leyenda = $mapa->drawLegend();
	$urlLeyenda = $Leyenda->saveWebImage();

	$Escala = $mapa->drawScaleBar();
	$urlEscala = $Escala->saveWebImage();





	?>
	<div class="page-inner">
		<div style="max-width: 940px">
			<div class="card">

				<div class="card-header">
					<div class="card-title">
						</h2>GeoVisor<i class="ml-2 fas fa-directions"></i></h2>
					</div>
				</div>

				<div class="card-body">
					<div class="mscross" style="width:900px; height:700px; -moz-user-select:none; position:relative; " id="dc_main"></div>
				</div>
			</div>
		</div>
	</div>

	<?php include_once '../View/Visor/ModalConsultarPunto.php'; ?>

	<div id="Layer1">
		<div style="width:200px; margin-top: -30px; margin-left:70px; height:240px; -moz-user-select:none; position:relative; z-index: 100;" id="dc_main2"></div>
	</div>
	<div class="custom-template">
		<div class="title">Settings</div>
		<div class="custom-content">
			<div class="switcher">
				<div class="switch-block">
					<h4>Capas Segmentacion</h4>
					<div class="btnSwitch">
						<form name="select_layers">
							<input type="checkbox" name="layer[0]" value="Segmentacion" onclick="chgLayers();" UNCHECKED>
							<strong>Labels Mapa</strong>
							<br>
							<input type="checkbox" name="layer[1]" value="Cali" onclick="chgLayers();" CHECKED>
							<strong>Cali</strong>
							<br>
							<input type="checkbox" name="layer[2]" value="SegmentacionNoLabel" onclick="chgLayers();" CHECKED>
							<strong>Segmentacion</strong>
							<br>
							<input type="checkbox" name="layer[3]" value="puntosMapa" onclick="chgLayers();" CHECKED>
							<strong>Deterioros del mapa</strong>
						</form>
					</div>
				</div>
				<div class="switch-block">
					<h4>Leyenda</h4>
					<div class="btnSwitch bg-default">
						<img src="<?php echo $urlLeyenda ?>" alt="">
					</div>
				</div>
			</div>
		</div>
		<div class="custom-toggle">
			<i class="flaticon-settings"></i>
		</div>
	</div>
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

		var insertarDano = new msTool('Cosultar Informacion Via', consultarDeterioro, '../View/Visor/misc/img/point.png', queryC);

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
				$urlControlador = getUrl("Visor", "Visor", "indexPoint", false, "ajax");
				?>

				var urlControlador = "<?php echo $urlControlador; ?>";
				validaConsultar(xx, yy, urlControlador);
				seleccionado = false;
				map.getTagMap().style.cursor = "default";
			}
		}
		//registrar la coordenada que detecta el mapa y visualizarla con ajax 
		//crear un formulario con una modal para registrar la informacion respectiva para mostrar en el mapa

		myMap1.redraw();
		myMap2.redraw();
	</script>
	<script type="text/javascript" src="assets/js/ajaxConsultarPunto.js"></script>