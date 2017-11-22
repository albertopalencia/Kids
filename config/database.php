
<?php
/*
$server   = "localhost";
$username = "root";
$password = "";
$database = "consolidados";
*/


$server   = "localhost";
$username = "cbidba";
$password = "cbik3y$$$";
$database = "kids";


$mysqli = new mysqli($server, $username, $password, $database);


if ($mysqli->connect_error) {
    die('error'.$mysqli->connect_error);
}

function generarInforme($table,$mes,$periodo){

		global $mysqli;

		$fecha_inicial="$periodo-$mes-1";

		if ($mes==1 or $mes==3 or $mes==5 or $mes==7 or $mes==8 or $mes==10 or $mes==12){
			$dia_fin=31;
		} else if ($mes==2){
			if ($periodo%4==0){
				$dia_fin=29;
			} else {
				$dia_fin=28;
			}
		} else {
			$dia_fin=30;
		}
		$fecha_final="$periodo-$mes-$dia_fin";
    $consulta = " select count(*) as cantidad from $table where fechacreacion between '$fecha_inicial' and '$fecha_final' ";
		$query=mysqli_query($mysqli,$consulta);
		$row=mysqli_fetch_array($query);
		$cantidad=floatval($row['cantidad']);
		return $cantidad;
	}


?>
