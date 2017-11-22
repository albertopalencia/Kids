
<?php

require_once "config/database.php";

$username = mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars(trim($_POST['username'])))));
$password = md5(mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars(trim($_POST['password']))))));

$consulta = "SELECT u.*,r.id as rolid,r.nombre as rolname FROM usuarios u join rolesusuarios ru
                  on u.id = ru.userid join roles r
                  on ru.rolid = r.id
                WHERE username='$username' AND clave='$password' ";

	$query = mysqli_query($mysqli,$consulta) or die('error'.mysqli_error($mysqli));

	$rows  = mysqli_num_rows($query);



	if ($rows > 0) {

		$data  = mysqli_fetch_assoc($query);

		session_start();

		$_SESSION['id']   = $data['id'];
		$_SESSION['username']  = $data['username'];
		$_SESSION['password']  = $data['clave'];
		$_SESSION['name_user'] = $data['nombres'].' '.$data['apellidos'];
		$_SESSION['rolid'] = $data['rolid'];
    $_SESSION['rol'] = $data['rolname'] ;

		header("Location: main.php?module=start");
	}
	else {
		header("Location: index.php?alert=1");
	}

?>
