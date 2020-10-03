<?php 

	if(!extension_loaded("MapScript")){
		dl("php_mapscript.".PHP_SHLIB_SUFFIX);
	}


	$map = ms_newMapObj("conexion4111Poligono.map");
	//$map->getLayerByName('Segmentacion')->getClass(0)->label->color->setRGB(0,250,0);
	$mapImage = $map->draw();
	

	$urlImage = $mapImage->saveWebImage();

	

?>

<!DOCTYPE html>
<html>
<head>
	<title>Visor Mapa Final</title>
	<meta charset="UTF-8">
</head>
<body>
	<input type="IMAGE" name="mapa" src="<?php echo $urlImage;?>" border="1">
</body>
</html>