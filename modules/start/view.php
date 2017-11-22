  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-home icon-title"></i> Inicio
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=start"><i class="fa fa-home"></i> Inicio</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-lg-12 col-xs-12">
        <div class="alert alert-info alert-dismissable">
          <button type="button" class="close" data-dismiss="alert"
          aria-hidden="true">&times;</button>
          <p style="font-size:15px">
            <i class="icon fa fa-user"></i> Bienvenido <strong>
              <?php echo $_SESSION['name_user']; ?></strong>
                a la aplicación de kids church.
          </p>
        </div>
      </div>
    </div>

    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div style="background-color:#00c0ef;color:#fff" class="small-box">
          <div class="inner">
            <?php

            $query = mysqli_query($mysqli, "SELECT COUNT(*) as numero FROM usuarios")
                      or die('Error '.mysqli_error($mysqli));

            $data = mysqli_fetch_assoc($query);
            ?>
            <h3><?php echo $data['numero']; ?></h3>
            <p>Usuarios</p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>

          <?php

          if (trim($_SESSION['rol'])=='Administrador') { ?>
            <a href="?module=form_user&form=add" class="small-box-footer" title="Agregar" data-toggle="tooltip">
              <i class="fa fa-plus"></i>

            </a>

          <?php
          } else { ?>
            <a class="small-box-footer"><i class="fa"></i></a>
          <?php
          }
          ?>
        </div>
      </div><!-- ./col -->




      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div style="background-color:blue;color:#fff" class="small-box">
          <div class="inner">
            <?php

            $query = mysqli_query($mysqli, "SELECT COUNT(*) as numero FROM alumno")
                      or die('Error '.mysqli_error($mysqli));

            $data = mysqli_fetch_assoc($query);
            ?>
            <h3><?php echo $data['numero']; ?></h3>
            <p>Total Registrados</p>
          </div>
          <div class="icon">
            <i class="fa fa-user"></i>
          </div>

          <?php

          if (trim($_SESSION['rol'])=='Administrador') { ?>
            <a href="?module=form_alumnos" class="small-box-footer" title="Agregar" data-toggle="tooltip">
              <i class="fa fa-plus"></i>
            </a>
          <?php
          } else { ?>
            <a class="small-box-footer"><i class="fa"></i></a>
          <?php
          }

          ?>
        </div>
      </div><!-- ./col -->

      <?php

      $query = mysqli_query($mysqli, "SELECT COUNT(*) as numero
              FROM alumno where status = 'salida'; ")
                or die('Error '.mysqli_error($mysqli));
      $conentregados = mysqli_fetch_assoc($query);



      $querysinsalida = mysqli_query($mysqli, "SELECT COUNT(*) as numero
              FROM alumno where status = 'entrada'; ")
                or die('Error '.mysqli_error($mysqli));
      $sinsalida = mysqli_fetch_assoc($querysinsalida);

      ?>
        <div class="col-lg-3 col-xs-6">
            <div style="background-color:green;color:#fff" class="small-box">
                  <div class="inner">
                    <h3><?php echo $conentregados['numero']; ?></h3>
                    <p>Total entregados</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-users"></i>
                  </div>
            </div>
        </div>

    <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div  style="background-color:red;color:#fff" class="small-box">
            <div class="inner">
              <h3><?php echo $sinsalida['numero']; ?></h3>
              <p>Total sin darle salida</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="?module=alumnos" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

    </div><!-- /.row -->
  </section><!-- /.content -->
