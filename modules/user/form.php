

<?php

$rolesquery= mysqli_query($mysqli, "SELECT * FROM roles ORDER BY Id ")
                                or die('error: '.mysqli_error($mysqli));



if ($_GET['form']=='add') {

 ?>
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Agregar Usuario
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=start"><i class="fa fa-home"></i> Inicio </a></li>
      <li><a href="?module=user"> Usuario </a></li>
      <li class="active"> agregar </li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" method="POST" action="modules/user/proses.php?act=insert" enctype="multipart/form-data">
            <div class="box-body">

              <div class="form-group">
                <label class="col-sm-2 control-label">Nombre de usuario</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="username" autocomplete="off" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Contraseña</label>
                <div class="col-sm-5">
                  <input type="password" class="form-control" name="clave" autocomplete="off" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Nombres</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nombres"
                  autocomplete="off" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Apellidos</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="apellidos"
                  autocomplete="off" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Permisos de acceso</label>
                <div class="col-sm-5">
                  <select class="form-control" name="roles" required>
                    <option value="">Seleccione</option>
                    <?php
                      while ($data = mysqli_fetch_assoc($rolesquery)) {
                         echo "<option value=".$data['Id'].">".$data['nombre']."</option>";
                      };
                     ?>
                  </select>
                </div>
              </div>
            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                  <a href="?module=user" class="btn btn-default btn-reset">Cancelar</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->
<?php
}

elseif ($_GET['form']=='edit') {
  	if (isset($_GET['id'])) {

      $consulta = "SELECT u.*,r.id as rolid,r.nombre as rolname FROM usuarios u join rolesusuarios ru
                        on u.id = ru.userid join roles r
                        on ru.rolid = r.id
                   WHERE u.id = '$_GET[id]' ";

      $query = mysqli_query($mysqli, $consulta)
                                      or die('error: '.mysqli_error($mysqli));
      $data  = mysqli_fetch_assoc($query);

  	}
?>

  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Modificar datos de Usuario
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=beranda"><i class="fa fa-home"></i> Inicio</a></li>
      <li><a href="?module=user"> Usuario </a></li>
      <li class="active"> Modificar </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" method="POST"
          action="modules/user/proses.php?act=update" enctype="multipart/form-data">
            <div class="box-body">

              <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

              <div class="form-group">
                <label class="col-sm-2 control-label">Nombre de Usuario</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="username"
                  ="off" value="<?php echo $data['username']; ?>" required>
                </div>
              </div>



              <div class="form-group">
                <label class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nombres"
                  autocomplete="off" value="<?php echo $data['nombres']; ?>" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Apellidos</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="apellidos"
                  autocomplete="off" value="<?php echo $data['apellidos']; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Telefono</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="telefono"
                  autocomplete="off" maxlength="13"
                  onKeyPress="return goodchars(event,'0123456789',this)"
                  value="<?php echo $data['telefono']; ?>">
                </div>
              </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Foto</label>
                <div class="col-sm-5">
                  <input type="file" name="foto">
                  <br/>
                <?php
                if ($data['foto']=="") { ?>
                  <img style="border:1px solid #eaeaea;border-radius:5px;"
                  src="images/user/user-default.png" width="128">
                <?php
                }
                else { ?>
                  <img style="border:1px solid #eaeaea;border-radius:5px;"
                  src="images/user/<?php echo $data['foto']; ?>" width="128">
                <?php
                }
                ?>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Permisos de acceso</label>
                <div class="col-sm-5">
                  <select class="form-control" name="roles" required>

                  <?php
                      while ($rs = mysqli_fetch_assoc($rolesquery)) {

                        if ($rs['Id']== $data['rolid']) {
                            echo "<option selected='selected' value='".$rs['Id']."'>".$rs['nombre']."</option>";
                        }else {
                          echo "<option  value='".$rs['Id']."'>".$rs['nombre']."</option>";
                        }

                      }
                      ?>

                  </select>
                </div>
              </div>
            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                  <a href="?module=user" class="btn btn-default btn-reset">Cancelar</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->
<?php
}
?>
