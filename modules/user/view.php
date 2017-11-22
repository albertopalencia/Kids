

<section class="content-header responsive">
  <h1>
    <i class="fa fa-user icon-title"></i> Gestión de Usuarios
  </h1>
  <div class="row">
    <div  class="col-md-3 pull-right">
      <a class="btn btn-primary btn-social pull-right"
          href="?module=form_user&form=add" title="Agregar" data-toggle="tooltip">
        <i class="fa fa-plus"></i> Agregar
      </a>
    </div>
  </div>

</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">

    <?php

    if (empty($_GET['alert'])) {
      echo "";
    }

    elseif ($_GET['alert'] == 1) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
              Los nuevos datos de usuario se ha registrado correctamente.
            </div>";
    }

    elseif ($_GET['alert'] == 2) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
           Los datos de usuario ha sido cambiado satisfactoriamente.
            </div>";
    }

    elseif ($_GET['alert'] == 3) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
            El usuario ha sido activado correctamente.
            </div>";
    }

    elseif ($_GET['alert'] == 4) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
             El usuario se bloqueó con éxito.
            </div>";
    }

    elseif ($_GET['alert'] == 5) {
      echo "<div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-times-circle'></i> Error!</h4>
             Asegúrese de que el archivo que se sube es correcto.
            </div>";
    }

    elseif ($_GET['alert'] == 6) {
      echo "<div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-times-circle'></i> Error!</h4>
            Asegúrese de que la imagen no es más de 1 MB.
            </div>";
    }

    elseif ($_GET['alert'] == 7) {
      echo "<div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-times-circle'></i> Error!</h4>
             Asegúrese de que el tipo de archivo subido sea  *.JPG, *.JPEG, *.PNG.
            </div>";
    }
    ?>

      <div class="box box-primary">
        <div class="box-body">
          <div class="table-responsive">
            <table id="dataTables1" class="table table-bordered table-striped table-hover">

              <thead>
                <tr>
                  <th class="center">No.</th>
                  <th class="center">Foto</th>
                  <th class="center">Nombre de usuario</th>
                  <th class="center">Nombres</th>
                  <th class="center">Apellidos</th>
                  <th class="center">Status</th>
                  <th class="center"></th>
                </tr>
              </thead>
              <tbody>
              <?php
              $no = 1;

              $query = mysqli_query($mysqli, "SELECT * FROM usuarios ORDER BY id DESC")
                                              or die('error: '.mysqli_error($mysqli));


              while ($data = mysqli_fetch_assoc($query)) {

                echo "<tr>
                        <td width='50' class='center'>$no</td>";

                        if ($data['foto']=="") { ?>
                          <td class='center'>
                            <img class='img-user' src='images/user/user-default.png'
                            width='45'>
                          </td>
                        <?php
                        } else { ?>
                          <td class='center'>
                            <img class='img-user' src='images/user/<?php echo $data['foto']; ?>' width='45'>
                          </td>
                        <?php
                        }

                        if ($data['estado']=='1') {
                            $estado = 'Activo';
                        }else{
                            $estado = 'Bloqueado';
                        }


                echo "  <td class='center'>$data[username]</td>
                        <td class='center'>$data[nombres]</td>
                        <td class='center'>$data[apellidos]</td>
                        <td class='center'> $estado</td>

                        <td class='center' width='100'>
                            <div>";

                            if ($data['estado']=='0') { ?>
                              <a data-toggle="tooltip" data-placement="top" title="Bloqueado" style="margin-right:5px" class="btn btn-warning btn-sm"
                              href="modules/user/proses.php?act=off&id=<?php echo $data['id'];?>">
                                  <i style="color:#fff" class="glyphicon glyphicon-off"></i>
                              </a>
              <?php
                            }
                            else { ?>
                              <a data-toggle="tooltip" data-placement="top" title="activo"
                              style="margin-right:5px" class="btn btn-success btn-sm"
                              href="modules/user/proses.php?act=on&id=<?php echo $data['id'];?>">
                                  <i style="color:#fff" class="glyphicon glyphicon-ok"></i>
                              </a>
              <?php
                            }

                echo "      <a data-toggle='tooltip' data-placement='top' title='Modificar' class='btn btn-primary btn-sm'
                              href='?module=form_user&form=edit&id=$data[id]'>
                                  <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                              </a>
                            </div>
                        </td>
                      </tr>";
                $no++;
              }
              ?>
              </tbody>
            </table>
          </div>

        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section><!-- /.content