

<?php
session_start();


require_once "../../config/database.php";


if (empty($_SESSION['username']) && empty($_SESSION['password'])){
	echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}

else {

	if ($_GET['act']=='insert') {

		if (isset($_POST['Guardar'])) {

			$username  = mysqli_real_escape_string($mysqli, trim($_POST['username']));
			$password  = md5(mysqli_real_escape_string($mysqli, strtolower(trim($_POST['password']))));
			$foto = 'user-default.png';
			$nombres = mysqli_real_escape_string($mysqli, trim($_POST['nombres']));
			$apellidos = mysqli_real_escape_string($mysqli, trim($_POST['apellidos']));
			$rolid= mysqli_real_escape_string($mysqli, trim($_POST['roles']));

      $query = mysqli_query($mysqli, "INSERT INTO usuarios(username,clave,nombres,apellidos,foto,estado)
                                            VALUES('$username','$password','$nombres','$apellidos','$foto','1')")
                                            or die('error: '.mysqli_error($mysqli));

      if ($query) {

				 $consultamaxid = mysqli_query($mysqli," SELECT MAX(id) as maximo from usuarios ");
				 $maxid = mysqli_fetch_assoc($consultamaxid);
				 $userid=$maxid['maximo'];

				 $rolesuser = mysqli_query($mysqli, "INSERT INTO rolesusuarios(UserId,RolId)
																					 	  VALUES('$userid','$rolid')")
																			 or die('error: '.mysqli_error($mysqli));

        header("location: ../../main.php?module=user&alert=1");
      }
		}
	}

	elseif ($_GET['act']=='update') {

		if (isset($_POST['Guardar'])) {

			if (isset($_POST['id'])) {

				$id            			= mysqli_real_escape_string($mysqli, trim($_POST['id']));
				$username           = mysqli_real_escape_string($mysqli, trim($_POST['username']));
				$password           = md5(mysqli_real_escape_string($mysqli, strtolower(trim($_POST['clave']))));
				$nombres          	= mysqli_real_escape_string($mysqli, trim($_POST['nombres']));
				$apellidos           = mysqli_real_escape_string($mysqli, trim($_POST['apellidos']));
				$telefono            = mysqli_real_escape_string($mysqli, trim($_POST['telefono']));
				$rolid    						= mysqli_real_escape_string($mysqli, trim($_POST['roles']));

				$name_file          = $_FILES['foto']['name'];
				$ukuran_file        = $_FILES['foto']['size'];
				$tipe_file          = $_FILES['foto']['type'];
				$tmp_file           = $_FILES['foto']['tmp_name'];


				$allowed_extensions = array('jpg','jpeg','png');


				$path_file          = "../../images/user/".$name_file;

				$file               = explode(".", $name_file);
				$extension          = array_pop($file);

				if (empty($_POST['clave']) && empty($_FILES['foto']['name'])) {

                    $query = mysqli_query($mysqli, "UPDATE usuarios SET username 	= '$username',
                    																		nombres 	= '$nombres',
                    																		apellidos = '$apellidos',
                    																		telefono  = '$telefono'
                    																WHERE id 	= '$id'")
                                                    or die('error: '.mysqli_error($mysqli));
                    if ($query) {

										  $consulta =	"UPDATE rolesusuarios SET RolId = '$rolid' WHERE UserId 	= '$id' ";

											echo "consulta ".$consulta;

											$rolesuser = mysqli_query($mysqli, $consulta) or die('error: '.mysqli_error($mysqli));




                        header("location: ../../main.php?module=user&alert=2");
                    }
				}

				elseif (!empty($_POST['clave']) && empty($_FILES['foto']['name'])) {


					$query = mysqli_query($mysqli, "UPDATE usuarios SET username 	= '$username',
																							nombres 	= '$nombres',
																							apellidos       = '$apellidos',
																							clave       = '$password',
																							telefono     = '$telefono'
																					WHERE id 	= '$id'")
																					or die('error: '.mysqli_error($mysqli));
                    if ($query) {

												$rolesuser = mysqli_query($mysqli, "UPDATE rolesusuarios SET RolId = '$rolid'
																												WHERE UserId 	= '$id'")
																										or die('error: '.mysqli_error($mysqli));
                        header("location: ../../main.php?module=user&alert=2");
                    }
				}

				elseif (empty($_POST['clave']) && !empty($_FILES['foto']['name'])) {

					if (in_array($extension, $allowed_extensions)) {

	                    if($ukuran_file <= 1000000) {

	                        if(move_uploaded_file($tmp_file, $path_file)) {

														$query = mysqli_query($mysqli, "UPDATE usuarios SET username 	= '$username',
	 							 																							nombres 	= '$nombres',
	 							 																							apellidos       = '$apellidos',
	 							 																							foto       = '$name_file',
	 							 																							telefono     = '$telefono'
	 							 																					WHERE id 	= '$id'")
	 							 																					or die('error: '.mysqli_error($mysqli));

					                    if ($query) {
																	$rolesuser = mysqli_query($mysqli, "UPDATE rolesusuarios SET RolId = '$rolid'
																																WHERE UserId 	= '$id'")
																														or die('error: '.mysqli_error($mysqli));
					                        header("location: ../../main.php?module=user&alert=2");
					                    }
                        	} else {

	                            header("location: ../../main.php?module=user&alert=5");
	                        }
	                    } else {

	                        header("location: ../../main.php?module=user&alert=6");
	                    }
	                } else {

	                    header("location: ../../main.php?module=user&alert=7");
	                }
				}

				else {

					if (in_array($extension, $allowed_extensions)) {

	                    if($ukuran_file <= 1000000) {

	                        if(move_uploaded_file($tmp_file, $path_file)) {


														$query = mysqli_query($mysqli, "UPDATE usuarios SET username 	= '$username',
																															nombres 	= '$nombres',
																															apellidos       = '$apellidos',
																															foto       = '$name_file',
																															clave       = '$password',
																															telefono     = '$telefono'
																													WHERE id 	= '$id'")
																													or die('error: '.mysqli_error($mysqli));

				                    if ($query) {
															$rolesuser = mysqli_query($mysqli, "UPDATE rolesusuarios SET RolId = '$rolid'
																														WHERE UserId 	= '$id'")
																												or die('error: '.mysqli_error($mysqli));
				                        header("location: ../../main.php?module=user&alert=2");
				                    }
                        	} else {

	                            header("location: ../../main.php?module=user&alert=5");
	                        }
	                    } else {

	                        header("location: ../../main.php?module=user&alert=6");
	                    }
	                } else {

	                    header("location: ../../main.php?module=user&alert=7");
	                }
				}
			}
		}
	}

/************** CAMBIOS DE ESTADO ************/
	elseif ($_GET['act']=='on') {
		if (isset($_GET['id'])) {

			$id_user = $_GET['id'];
			$status  = "activo";


            $query = mysqli_query($mysqli, "UPDATE usuarios SET estado  = '$status'
                                                          WHERE id = '$id_user'")
                                            or die('error: '.mysqli_error($mysqli));


            if ($query) {

                header("location: ../../main.php?module=user&alert=3");
            }
		}
	}


	elseif ($_GET['act']=='off') {
		if (isset($_GET['id'])) {

			$id_user = $_GET['id'];
			$status  = "bloqueado";


            $query = mysqli_query($mysqli, "UPDATE usuarios SET estado  = '$status'
                                                          WHERE id = '$id_user'")
                                            or die('Error : '.mysqli_error($mysqli));


            if ($query) {

                header("location: ../../main.php?module=user&alert=4");
            }
		}
	}
}
?>
