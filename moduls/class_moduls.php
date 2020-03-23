<?php
	// Este es el include del ranking
	include('class_moduls_ranking.php');

	if ($_CONFIG[WebsiteGunzOffline] == "") {	

		if(isset($_GET['mod'])) {

				$mod = clean($_GET['mod']);

			}else{

				$mod = "index";

			}


		if ($_SESSION['UGradeID'] == 253) { // Banned Index Web No terminado
			
			include "moduls/mod/mig_$mod.php";
		
		}else{			

			if (file_exists("moduls/mod/mig_$mod.php")) {

				include "moduls/mod/mig_$mod.php";

			}else{
				
				Go_URL($URL_BASE . "error_log/404.php");

			}
		}


	}else{

		echo "<h1>Mantenimiento</h1>";
	}

	// Este es la columna 2, Comenzando desde la izquierda hacia la derecha.
	include('class_moduls_footer.php');
?>
