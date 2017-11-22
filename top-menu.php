
<?php

require_once "config/database.php";


$query = mysqli_query($mysqli, "SELECT id, CONCAT(Nombres, ' ', Apellidos) as nombres, foto FROM usuarios WHERE id='$_SESSION[id]'")
                                or die('error: '.mysqli_error($mysqli));


$data = mysqli_fetch_assoc($query);
?>

<li class="dropdown user user-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">

  <?php
  if ($data['foto']=="") { ?>
    <img src="images/user/user-default.png" class="user-image" alt="User Image"/>
  <?php
  }
  else { ?>
    <img src="images/user/<?php echo $data['foto']; ?>" class="user-image" alt="User Image"/>
  <?php
  }
  ?>

    <span class="hidden-xs"><?php echo $data['nombres']; ?> <i style="margin-left:5px"

     class="fa fa-angle-down"></i></span>
  </a>
  <ul class="dropdown-menu">

    <li class="user-header">

      <?php
      if ($data['foto']=="") { ?>
        <img src="images/user/user-default.png" class="img-circle" alt="User Image"/>
      <?php
      }
      else { ?>
        <img src="images/user/<?php echo $data['foto']; ?>" class="img-circle" alt="User Image"/>
      <?php
      }
      ?>

      <p>
        <?php echo $data['nombres']; ?>
        <small><?php echo $_SESSION['rol']; ?></small>

      </p>
    </li>

    <!-- Menu Footer-->
    <li class="user-footer">
      <div class="pull-left">
        <a style="width:80px" href="?module=profile" class="btn btn-primary">Perfil</a>
      </div>

      <div class="pull-right">
        <a style="width:80px" data-toggle="modal" href="#logout" class="btn btn-primary">Salir</a>
      </div>
    </li>
  </ul>
</li>
