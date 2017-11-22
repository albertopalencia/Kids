
<?php
session_start();

header('Content-type: application/json; charset=utf-8');

require_once "../../config/database.php";

if (empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}

else {
    if ($_POST['act']=='insert') {

        $jsondata = array();

        $hijos = trim($_POST['hijos']);
        $nombres = trim($_POST['nombreacu']);
        $documento = trim($_POST['documento']);
        $fecha = date('y-m-d H:m');
        $password  = md5(mysqli_real_escape_string($mysqli, trim($_POST['clave'])));
        $creadopor = $_SESSION['id'];
        $insert = "INSERT INTO alumno(hijos,cedula_acudiente,nombrecompleto,fechacreacion,clave,status,creado_por)
                    VALUES ('$hijos','$documento','$nombres','$fecha','$password','entrada','$creadopor')";

        $query = mysqli_query($mysqli, $insert) or die('error: '.mysqli_error($mysqli));

        if ($query) {
            $jsondata["success"] = true;
            $jsondata["message"] = '';
        }else {
          $jsondata["success"] = false;
          $jsondata["message"] = 'ocurrio un error al momento de crear el registro';
        }


        echo json_encode($jsondata, JSON_FORCE_OBJECT);
    }

    if (isset($_POST['buscar'])) {

          $jsondata = array();

          $documento=trim($_POST['documentosalida']);
          $clave  = md5(mysqli_real_escape_string($mysqli, trim($_POST['clavesalida'])));

          $query = "SELECT hijos,id FROM alumno where cedula_acudiente='$documento' ";
          $query.=" and clave = '$clave' and status ='entrada'";

          $result= mysqli_query($mysqli, $query) or die('error: '.mysqli_error($mysqli));
          $rows= mysqli_num_rows($result);

        	if ($rows > 0) {
          		$data  = mysqli_fetch_assoc($result);
              $jsondata["success"] = true;
              $jsondata["message"] = $data;
        	}
        	else {
            $jsondata["success"] = true;
            $jsondata["message"] = '';
        	}

            echo json_encode($jsondata, JSON_FORCE_OBJECT);
    }

    elseif ($_GET['act']=='delete') {
        if (isset($_GET['id'])) {
            $codigo = $_GET['id'];

            $query = mysqli_query($mysqli, "DELETE FROM alumno WHERE id='$codigo'")
                                            or die('error '.mysqli_error($mysqli));


            if ($query) {
                header("location: ../../main.php?module=alumnos&alert=3");
            }
        }
    }
}
?>
