<?php

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=ReportesConsolidacion_".date("Y-m-d h:s").".xls" );
?>

<HTML LANG="es">
<head>
<style>

       /*  Reporte pagina      */

#tablereport { text-align:left; widht:100%;cellpadding:1px; cellspacing:1px;}
#tablereport .td { background: #00192F;color:white; width:200px;text-align:center; border-radius:2;}
#tablereport .tdrow {text-align:center; border:1px solid black;}
.reporte {
	background: green;color:white;
}
.dia { background: #00192F; border-radius:2;}
</style>

</head>
<body>
<?php

session_start();

require_once "../../config/database.php";

	if (empty($_SESSION['username']) && empty($_SESSION['password'])){
		echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
	}
	else {

		if (empty($_POST['fechainicial']) && empty($_POST['fechafin'])){
			echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
		}

		$fechaini = $_POST['fechainicial'];
		$fechafin = $_POST['fechafin'];

		$consulta = " SELECT * FROM personas WHERE fechacreacion
								 between '".$fechaini."' and '".$fechafin."' ";

		$query = $mysqli->query($consulta);

}
?>
 <center>
<table id="tablereport">

	<tr>
		<center><td colspan=9 class="td" > <h1> Reporte De Consolidacion</h1></br><h1>CBI</h1> </td><center>
	</tr>
	<tr >
		<td colspan=9 class="reporte" ><h3> Generado El Dia : <?php echo date("Y-m-d h:s");?> </h3></td>
	</tr>
	<tr >
		<td colspan=9 class="reporte"/>
	</tr>

	<tr>

		<td class="td">Nombres</td>
		<td class="td">Apellidos</td>
		<td class="td">Direccion</td>
		<td class="td">Email</td>
		<td class="td">Celular</td>
		<td class="td">Fecha Creacion</td>
    <td class="td">Observaciones</td>
		<td class="td">Llamada1</td>
		<td class="td">Llamada2</td>

	</tr>

<?php



  $contador = 0;
while($rows = $query->fetch_assoc()) {

        printf('<tr>
        <td class="tdrow"> %s </td>
				<td class="tdrow"> %s </td>
        <td class="tdrow"> %s </td>
        <td class="tdrow"> %s </td>
        <td class="tdrow"> %s </td>
				<td class="tdrow"> %s </td>
        <td class="tdrow"> %s </td>
				<td class="tdrow"> %s </td>
				<td class="tdrow"> %s </td>
				</tr>',
							$rows["nombres"],$rows["apellidos"],
							$rows["direccion"],$rows["email"],$rows["celular"],$rows["fechacreacion"]
              ,$rows["observaciones"],$rows["llamada1"],$rows["llamada2"]);
				$contador+=1;
	}


$mysqli->close();

?>
<tr >
	<td  class ="td" colspan=8 >
		<h3  align="left">TOTAL DE CONSOLIDADOS: &nbsp;&nbsp;&nbsp;  <?php echo $contador; ?></h3>
	</td>

</tr>

</table>
</center>

</body>
</html>
