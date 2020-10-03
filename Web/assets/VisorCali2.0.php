<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Vial Manager</title>
	<link rel="stylesheet" href="misc/img/dc.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script type="text/javascript" src="misc/lib/mscross-1.1.9.js"></script>
	<!-- libreria para utilizar ajax en conjunto don mapserver-->
</head>

<body style="background-color:rgb(18, 18, 36); background-image:url('misc/img/FondoVisor.jpg'); background-size: 100% 100%;">
	<?php 

		if(!extension_loaded('MapScript')){
			dl('php_mapscript.'.PHP_SHLIB_SUFFIX); 
		}

		$mapa = ms_newMapObj('Segmentacion.map');

		$mapa->legend->imagecolor->setRGB(0, 0, 0);
		$mapa->legend->label->color->setRGB(250, 250, 250);

		$Leyenda = $mapa->drawLegend();
		$urlLeyenda = $Leyenda->saveWebImage();

		$Escala = $mapa->drawScaleBar();
		$urlEscala = $Escala->saveWebImage();

		

		

	?>

	<table id="TablaContenido" cellpadding="20px" style="color:white; box-shadow:3px 3px 3px 0px;">
		<tr>
			<th class="tituloTabla TitleGeo" >
				GeoVisor <img src="misc/img/Map.png" width="30px" valign="top">
			</th>
			<th class="tituloTabla" style="width:25%; border:2px solid white; border-bottom:none;">
				On/Off &nbsp;<img src="misc/img/OnOff.png" width="30px" valign="middle">
			</th>
		</tr>
		<tr>
			<td rowspan="3" class="seccionMapa" style="border:2px solid white; border-top:none;">
				<div class="mscross" style="width:900px; height:700px; -moz-user-select:none; position:relative; " id="dc_main"></div>
			</td>
			<td class="seccionSwitch" style="border:2px solid white; border-top:none;">
				<div id="Layer2" >
					<p>
					  <a class="btn btn-secondary text-light" style="border:1px solid cyan;" data-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapseExample">
					    Capas Segmentacion
					  </a>
					</p>
					
					    <form name="select_layers">
					    	<div class="collapse" id="collapse1">
								<p align="left">
									<input type="checkbox" name="layer[0]" value="Segmentacion" onclick="chgLayers();" UNCHECKED>
									<strong>Labels Mapa</strong>
								<p align="left">
									<input type="checkbox" id="layer[2]" value="SegmentacionNoLabel" onclick="chgLayers();" CHECKED>
									<strong>Segmentacion</strong>
							</div>
					<p>
					   <a class="btn btn-secondary text-light" style="border:1px solid lightgreen;" data-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapseExample">
						   Capa unipoligonal
						</a>
					</p>
					
							<div class="collapse" id="collapse2">
									<p align="left">
										<input type="checkbox" name="layer[1]" value="Cali" onclick="chgLayers();" CHECKED>
										<strong>Cali</strong>

							</div>

						</form>
				</div>
			</td>
		</tr>
		<tr>
			<th class="tituloTabla" style="border:2px solid white; border-bottom:none;">
				Leyenda <img src="misc/img/Legend.png" width="50px" valign="middle">
			</th>
		</tr>
		<tr>
			<td class="seccionLeyenda" style="border:2px solid white; border-top:none;">
				<img src="<?php echo $urlLeyenda;?>" border="2px">
			</td>
			
		</tr>
		<tr>
			<td style="border-left:2px solid white;">
				<img src="<?php echo $urlEscala;?>" border="2px" class="escala" style="margin-left:5%;">
			</td>
		</tr>
			

				
			
	</table>

	<div id="Layer1">
		<div style="width:200px; height:100px; -moz-user-select:none; position:relative; z-index: 100; box-shadow: 3px 3px 3px 0px;" id="dc_main2">

		</div>
	</div>
	<script type="text/javascript">
		
		myMap1 = new msMap(document.getElementById("dc_main"), "standardRight");

		myMap1.setCgi("/cgi-bin/mapserv.exe");

		myMap1.setMapFile('/ms4w/Apache/htdocs/geoFinal/Segmentacion.map');

		myMap1.setFullExtent(1049214.34, 1078487.53, 860243.46);
		myMap1.setLayers('Cali SegmentacionNoLabel Norte');


		myMap2 = new msMap(document.getElementById("dc_main2"));

		myMap2.setActionNone();
		myMap2.setFullExtent(1054114.34, 1068487.53, 860243.46);

		myMap2.setMapFile('/ms4w/Apache/htdocs/geoFinal/Segmentacion.map');

		myMap2.setLayers('Cali');
		myMap1.setReferenceMap(myMap2);


		//Clase 30/09/2020
		//agregar boton al toolbar del mapa

		var insertarDano = new msTool('ObtenerCoordenadas', insertd, 'misc/img/marker-gold.png', queryI);

		myMap1.getToolbar(0).addMapTool(insertarDano);

		

		function chgLayers()
		{
			var list = "Layers ";
			var objForm = document.forms[0];

			for(i=0;i<document.forms[0].length;i++)
			{

				if(objForm.elements["layer["+ i +"]"].checked == true){

					list += objForm.elements["layer["+ i +"]"].value+" ";

				}


				
				myMap1.setLayers(list);
				myMap2.setLayers(list);
				myMap1.redraw();
				myMap2.redraw();
			}
			//alert(list);

		}


		var seleccionado = false;

		function insertd(event, map){//function que determinara si la opcion fue elegida y cambia el estilo del cursor

			map.getTagMap().style.cursor="crosshair";
			seleccionado = true;
		}

		function queryI(event, map, x, y, xx, yy){

			if(seleccionado){
				alert("Coordenadas del mapa: "+x+" y "+y+ " reales x : " + xx + " reales y: " + yy);
				seleccionado = false;
				map.getTagMap().style.cursor="default";
			}
		}
		//registrar la coordenada que detecta el mapa y visualizarla con ajax 
		//crear un formulario con una modal para registrar la informacion respectiva para mostrar en el mapa

		myMap1.redraw();
		myMap2.redraw();

	</script>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reF/GAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>