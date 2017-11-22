
<?php
if (isset($_POST['id'])) {

  $query = mysqli_query($mysqli, "SELECT * FROM usuarios WHERE id='$_POST[id]'")
                                  or die('error '.mysqli_error($mysqli));
  $data  = mysqli_fetch_assoc($query);
}
?>

  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Modificar Perfil de Usuario
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=start"><i class="fa fa-home"></i> Inicio </a></li>
      <li><a href="?module=profile"> Perfil de usuario </a></li>
      <li class="active"> Modificar </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">

      <div class="col-md-9">
          <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#datospersonales" data-toggle="tab" aria-expanded="true">
                  Datos Personales</a></li>
                <li class=""><a href="#cambiarpassword" data-toggle="tab" aria-expanded="false">Cambiar Clave
                </a></li>
              </ul>

              <div class="tab-content">
                  <div class="tab-pane active" id="datospersonales">

                      <form role="form" class="form-horizontal" method="POST" action="modules/profile/proses.php?act=update" enctype="multipart/form-data">

                          <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

                          <div class="form-group">
                            <label class="col-sm-2 control-label">Nombre de usuario</label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control" name="username"
                              autocomplete="off" value="<?php echo $data['username']; ?>" required>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-2 control-label">Nombres</label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control" name="nombres"
                              autocomplete="off" value="<?php echo $data['nombres']; ?>" required>
                            </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Apellidos</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="apellidos"
                                      autocomplete="off" value="<?php echo $data['apellidos']; ?>"
                                       required>
                                    </div>
                          </div>

                            <div class="form-group">
                            <label class="col-sm-2 control-label">Telefono</label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control" name="telefono" autocomplete="off" maxlength="13" onKeyPress="return goodchars(event,'0123456789',this)" value="<?php echo $data['telefono']; ?>">
                            </div>
                          </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Foto</label>
                            <div class="col-sm-5">
                              <input type="file" name="foto">
                              <br/>
                            <?php
                            if ($data['foto']=="") { ?>
                              <img style="border:1px solid #eaeaea;border-radius:5px;" src="images/user/user-default.png" width="128">
                            <?php
                            }
                            else { ?>
                              <img style="border:1px solid #eaeaea;border-radius:5px;" src="images/user/<?php echo $data['foto']; ?>" width="128">
                            <?php
                            }
                            ?>
                            </div>

                        </div><!-- /.box body -->

                        <div class="box-footer">
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                              <a href="?module=profile" class="btn btn-default btn-reset">Cancelar</a>
                            </div>
                          </div>
                        </div><!-- /.box footer -->
                      </form>

                  </div>
                  <div class="tab-pane" id="cambiarpassword">

                          <form role="form" class="form-horizontal" method="POST"
                           action="modules/profile/proses.php?act=password" enctype="multipart/form-data">

                              <input type="hidden" name="id" value='<?php echo $data['id']; ?>'>

                              <div class="form-group">
                                <label class="col-sm-2 control-label">Clave Actual</label>
                                <div class="col-sm-5">
                                  <input type="password" class="form-control" name="password"
                                  autocomplete="off" required>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-2 control-label">Nueva Clave</label>
                                <div class="col-sm-5">
                                  <input type="password" class="form-control" name="repassword"
                                  autocomplete="off" required>
                                </div>
                              </div>
                              <div class="box-footer">
                                  <div class="form-group">
                                      <div class="col-sm-offset-2 col-sm-10">
                                      <input type="submit" class="btn btn-primary btn-submit" name="Reset" value="Guardar">
                                        <a href="?module=profile" class="btn btn-default btn-reset">Cancelar</a>
                                    </div>
                                  </div>
                              </div>
                          </form>
              </div>
         </div>
     </div>
    </div>   <!-- /.row -->
      </div>
  </section><!-- /.content -->
