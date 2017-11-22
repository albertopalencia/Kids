<?php

require_once "config/database.php";

$id_user = $_SESSION['id'];
$rol_id = $_SESSION['rolid'];

$consulta = " SELECT
          		    men.menuid
                  ,men.nombre
                  ,men.Link
                  ,men.Icono
                  ,men.accion
                  ,men.controlador
            FROM menus men , rolesusuarios roluser
            WHERE roluser.UserId = '$id_user' and roluser.RolId = '$rol_id' ";

$query = mysqli_query($mysqli, $consulta) or die('error'.mysqli_error($mysqli));  ?>

 <ul class="sidebar-menu">

     <li class="header">MENU</li>
      <?php

        if ($_GET["module"]=="start") {
              $module="start";
              $active="active";
        }
        else if ($_GET["module"]=="alumnos") {
            $module="alumnos";
            $active="active";
        }
        elseif ($_GET["module"]=="reportes") {
          $module="reportes";
          $active="active";
        }
        elseif ($_GET["module"]=="user") {
            $module="user";
            $active="active";
        } else {
            $active="";
        }
        ?>
        <li class="<?php if($module == 'start'){ echo $active; }?>">
             <a href="?module=start">
               <i class="fa fa-dashboard"></i>
                Inicio
             </a>
        </li>
  <?php

   while ($data = mysqli_fetch_assoc($query)) {

          $selectmenu = "SELECT
                         pant.Nombre,pant.Controller,pant.Action,pant.Datos,pant.Secuencia,pant.Icono
                         ,per.ver,per.agregar,per.editar,per.borrar
                                   FROM permisosroles per JOIN pantallas pant
                         on per.pantallaid = pant.PantallaId
                       JOIN rolesusuarios roluser on per.rolid = roluser.RolId
                       WHERE roluser.UserId = '$id_user' and per.menuid ='".$data['menuid']."'";

            $resultmenu = mysqli_query($mysqli, $selectmenu) or die('error'.mysqli_error($mysqli));


          while ($menuitem = mysqli_fetch_assoc($resultmenu)) { ?>

                <li class="<?php if($module ==$menuitem['Controller']){ echo $active; } ?>
                         treeview">
                    <a href="javascript:void(0)">
                      <i class="<?php echo $data['Icono']; ?>"></i>
                      <?php echo $data['nombre']; ?>
                    </a>
                <ul class="treeview-menu">
                    <li class="active">
                      <a href="?module=<?php echo $menuitem['Controller']; ?>">
                        <i class="<?php echo $menuitem['Icono']; ?>"></i>
                            <?php echo $menuitem['Nombre']; ?>
                      </a>
                    </li>
                </ul>
              </li>

            <?php  }// fin segundo while

           } ?>


  </ul>
