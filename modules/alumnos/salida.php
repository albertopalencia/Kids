<?php

session_start();

header('Content-type: application/json; charset=utf-8');

if (empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
else {



    if ($_POST['act']=='salida') {

      $server   = "localhost";
      $username = "cbidba";
      $password = "cbik3y$$$";
      $database = "kids";

      $conexion = new mysqli($server, $username, $password, $database);

        if ($conexion->connect_error) {
          die('error'.$conexion->connect_error);
        }

          $jsondata = array();
          $fechasalida = date('y-m-d');
          $id=$_POST['id'];
          $salida = 'salida';
          $salidapor = $_SESSION['id'];
          $query = "UPDATE  alumno SET status='$salida',fechasalida='$fechasalida',salida_por='$salidapor'  Where id= '$id'; ";
          $resultado= mysqli_query($conexion, $query) or die('error: '.mysqli_error($conexion));
          if ($resultado) {
            $jsondata["success"] = true;
            $jsondata["message"] = '';
          }else {
            $jsondata["success"] = false;
            $jsondata["message"] = $query;
          }

          echo json_encode($jsondata, JSON_FORCE_OBJECT);
    }
}

 ?>
