<?php
require_once "config/database.php";


if (empty($_SESSION['username']) && empty($_SESSION['password'])){
	echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
else {


	if ($_GET['module'] == 'start' ) {
		include "modules/start/view.php";
	}

	/********************** MIEMBROS **********************/

	elseif ($_GET['module'] == 'alumnos') {

		include "modules/alumnos/view.php";
	}

	elseif ($_GET['module'] == 'form_alumnos') {
		include "modules/alumnos/form.php";
	}

	/**********************reportes**********************/

	elseif ($_GET['module'] == 'reportes') {

		include "modules/reportes/view.php";
	}

	/**********************USUARIO**********************/

	elseif ($_GET['module'] == 'user') {
		include "modules/user/view.php";
	}


	elseif ($_GET['module'] == 'form_user') {
		include "modules/user/form.php";
	}

	elseif ($_GET['module'] == 'profile') {
		include "modules/profile/view.php";
	}


	elseif ($_GET['module'] == 'form_profile') {
		include "modules/profile/form.php";
	}

	elseif ($_GET['module'] == 'password') {
		include "modules/password/view.php";
	}
else {
	echo "<meta http-equiv='refresh' content='0; url=logout.php'>";
}
		/********************** FIN USUARIO**********************/
}
?>
