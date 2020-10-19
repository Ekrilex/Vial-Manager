<?php 
	include_once '../Lib/helpersVisi.php';
	include_once '../View/Partials/HtmlHeadVisi.php';
	
	echo "<body>";
		echo "<div class='wrapper static-sidebar'>";

			include_once '../View/Partials/navBarVisi.php';

			echo "<div class='main-panel'>";

				echo "<div class='content'>";
				
					if(isset($_GET['modulo'])){
						resolve();
					}else{
						include_once '../View/Partials/ContentVisi.php';
					}
					
				echo "</div>";

				include_once '../View/Partials/FooterVisi.php';

			echo "</div>";
			
		echo "</div>";
		include_once '../View/Partials/ScriptsVisi.php';
	echo "</body>";
?>