<?php

session_start();

require_once "../../config/database.php";


if (empty($_SESSION['username']) && empty($_SESSION['password'])){
	echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}

$action = (isset($_REQUEST['action']) &&
 $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

if($action == 'ajax'){

$periodo=intval($_REQUEST['periodo']);

	$txt_mes=array( "1"=>"Ene","2"=>"Feb","3"=>"Mar","4"=>"Abr","5"=>"May","6"=>"Jun",
				"7"=>"Jul",	"8"=>"Ago","9"=>"Sep","10"=>"Oct","11"=>"Nov",	"12"=>"Dic"
			 );//Arreglo que contiene las abreviaturas de los meses del año



			 $categorias []= array('Mes',"Invitados $periodo");


			for ($inicio = 1; $inicio <= 12; $inicio++) {

			    $mes=$txt_mes[$inicio];//Obtengo la abreviatura del mes
					$ingresos=generarInforme('Personas',$inicio,$periodo);//Obtengo el  monto de los ingresos
					$categorias []= array($mes,$ingresos);//Agrego elementos al arreglo
			}

				echo json_encode(($categorias));//Convierto el arreglo a formato json

}
?>
