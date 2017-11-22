
<?php
session_start();


require_once "../../config/database.php";

if (empty($_SESSION['username']) && empty($_SESSION['password'])){
	echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}

else {

	if ($_GET['act']=='update') {
		if (isset($_POST['Guardar'])) {
			if (isset($_POST['id'])) {

				$id            = mysqli_real_escape_string($mysqli, trim($_POST['id']));
				$username           = mysqli_real_escape_string($mysqli, trim($_POST['username']));
				$nombres          = mysqli_real_escape_string($mysqli, trim($_POST['nombres']));
				$apellidos             = mysqli_real_escape_string($mysqli, trim($_POST['apellidos']));
				$telefono            = mysqli_real_escape_string($mysqli, trim($_POST['telefono']));

				$name_file          = $_FILES['foto']['name'];
				$ukuran_file        = $_FILES['foto']['size'];
				$tipe_file          = $_FILES['foto']['type'];
				$tmp_file           = $_FILES['foto']['tmp_name'];


				$allowed_extensions = array('jpg','jpeg','png');


				$path_file          = "../../images/user/".$name_file;


				$file               = explode(".", $name_file);
				$extension          = array_pop($file);


				if (empty($_FILES['foto']['name'])) {

                    $query = mysqli_query($mysqli, "UPDATE usuarios SET
																							username 	= '$username',
                    													nombres 	= '$nombres',
																							apellidos = '$apellidos',
                    													telefono     = '$telefono'
                                              WHERE id 	= '$id' ")
                            or die('error: '.mysqli_error($mysqli));


                    if ($query) {

                        header("location: ../../main.php?module=profile&alert=1");
                    }
				}

				else {

					if (in_array($extension, $allowed_extensions)) {

	                    if($ukuran_file <= 1000000) {


	                        if(move_uploaded_file($tmp_file, $path_file)) {

			                    $query = mysqli_query($mysqli, "UPDATE usuarios
																									SET username 	= '$username',
			                    													 nombres 	  = '$nombres',
			                    													apellidos   = '$apellidos',
			                    													telefono    = '$telefono',
			                    													foto     	= '$name_file'
			                                            WHERE id 	= '$id'")
			                         or die('error: '.mysqli_error($mysqli));


			                    if ($query) {

			                        header("location: ../../main.php?module=profile&alert=1");
			                    }
                        	} else {

	                            header("location: ../../main.php?module=profile&alert=2");
	                        }
	                    } else {

	                        header("location: ../../main.php?module=profile&alert=3");
	                    }
	                } else {

	                    header("location: ../../main.php?module=profile&alert=4");
	                }
				}
			}
		}
	} else if($_GET['act']=='password') {

		if (isset($_POST['Reset'])) {

				if (isset($_POST['id'])) {

						$id  = mysqli_real_escape_string($mysqli,trim($_POST['id']));
						$repassword = md5(mysqli_real_escape_string($mysqli, strtolower(trim($_POST['repassword']))));


						$query = mysqli_query($mysqli, "UPDATE usuarios SET
																			clave 	= '$repassword'
																			WHERE id = '$id' ")
										or die('error: '.mysqli_error($mysqli));


						if ($query) {
								header("location: ../../main.php?module=profile&alert=5");

						}else {
							 header("location: ../../main.php?module=profile&alert=2");
						}
				}
		}
	}
}
?>
