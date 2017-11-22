  <script src="assets/js/alumnos/alumno.js"></script>



  <section class="content-header">
    <div class="row">
      <div class="col-md-6">
        <h3>
          <i class="fa fa-edit icon-title"></i> Nuevo
        </h3>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb">
          <li><a href="?module=start"><i class="fa fa-home"></i> Inicio </a></li>
          <li><a href="?module=alumnos"> <i class="fa fa-users"></i> Alumnos </a></li>
          <li class="active"> Nuevo </li>
        </ol>
      </div>
    </div>

  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-9">
        <div class="box box-primary">
          <div class="overlay" id="msgsave" style="display:none">
            <i class="fa fa-refresh fa-spin"></i>
          </div>
          <form  id="frmalumnos" name="frmalumnos" role="form" class="form-horizontal" enctype="application/x-www-form-urlencoded">
          <div class="box-header with-border">
            <h3 class="box-title">Registrar Ingreso</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="form-group  col-md-12">
                    <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                        <textarea class="form-control" placeholder="Nombres y Apellidos"
                        autocomplete="off" id="hijos" name="hijos" rows="3" cols="80"></textarea>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-credit-card" aria-hidden="true"></i>
                        </span>
                        <input type="text" placeholder="ingrese su documento"
                        name="documento" autocomplete="off" id="documento" class="form-control" >
                    </div>
                </div>

                <div class="form-group col-md-4">
                      <div class="input-group">
                          <span class="input-group-addon">
                              <i class="fa fa-user" aria-hidden="true"></i>
                          </span>
                          <input type="text" name="nombreacu" placeholder="Nombres y Apellidos"
                          autocomplete="off" id="nombreacu" class="form-control">
                      </div>
                </div>


                <div class="form-group col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-key" aria-hidden="true"></i>
                            </span>
                            <input type="password" name="clave" placeholder="Clave" autocomplete="off" id="clave"  class="form-control" />
                        </div>
                </div>



            </div>
        </div><!-- finaliza el box-body-->

            <div class="box-footer">
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group col-md-4">
                          <button type="submit" class="btn btn-primary btn-social"
                            name="Guardar">
                            <i class="fa fa-save"></i>Guardar
                          </button>
                          <a href="?module=alumnos" class="btn btn-danger btn-social">
                            <i class="fa fa-arrow-left"></i>
                            Regresar</a>
                      </div>
                  </div>
              </div>

            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->


      </div><!--/.col -->

      <div class="col-md-3">
        <div class="box box-primary">
          <div class="overlay" id="msgsavebuscar" style="display:none">
            <i class="fa fa-refresh fa-spin"></i>
          </div>
            <form class="form-horizontal" id="frmconsultar" enctype="application/x-www-form-urlencoded">

            <div class="box-header with-border">
              <h3 class="box-title">Registrar Salida</h3>
            </div>

            <div class="box-body">
                <div class="form-group">
                  <div class="input-group">
                      <span class="input-group-addon">
                          <i class="fa fa-credit-card" aria-hidden="true"></i>
                      </span>
                      <input type="text" placeholder="ingrese su documento" name="documentosalida"
                       autocomplete="off" id="documentosalida" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <span class="input-group-addon">
                          <i class="fa fa-key" aria-hidden="true"></i>
                      </span>
                      <input type="password" name="clavesalida" placeholder="ingrese su clave"
                      autocomplete="off" id="clavesalida"  class="form-control"/>
                  </div>
                </div>
                <div class="form-group" id="result" style="display:none">
                    <input type="hidden" id="idconfirmar" name="idconfirmar">
                    <p class="text-aqua">Quiere darle salida a los alumno(a)s ?</p>
                    <p id="alumna" class="text-yellow"></p>
                     <a id="linkconfirmar" href="javascript:void(0)"  class="btn btn-success btn-social">
                        <i class="fa fa-check"></i> Confirmar Entrega
                      </a>
                </div>
            </div>

          <div class="box-footer">
                <div class="form-group">
                  <button type="submit" name="buscar"  class="btn btn-sm btn-primary btn-social">
                    <i class="fa fa-search"></i>
                    Buscar</button>
                </div>
          </div>
          </form>

      </div>
      </div>
    </div>   <!-- /.row -->
  </section><!-- /.content -->
<?php


if ($_GET['form']=='edit') {
  if (isset($_GET['id'])) {

      $query = mysqli_query($mysqli, "SELECT * FROM alumno WHERE id='$_GET[id]'")
                                      or die('error: '.mysqli_error($mysqli));
      $data  = mysqli_fetch_assoc($query);
    }
?>

  <section class="content-header">
      <div class="row">
      <div class="col-md-6">
        <h3>
          <i class="fa fa-edit icon-title"></i> Modificar Alumno
        </h3>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb">
          <li><a href="?module=start"><i class="fa fa-home"></i> Inicio </a></li>
          <li><a href="?module=miembros"><i class="fa fa-users"></i> Alumnos </a></li>
          <li class="active"> Modificar </li>
        </ol>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/alumnos/proses.php?act=update" method="POST">

            <div class="box-body">
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group  col-md-6">
                          <label>Nombres</label>
                          <div class="input-group">
                              <span class="input-group-addon">
                                  <i class="fa fa-user" aria-hidden="true"></i>
                              </span>
                              <input  id="id" name="id" type="hidden" value="<?php echo $data['id']; ?>" />
                              <input id="nombres" name="nombres" type="text"
                              value="<?php echo $data['nombres']; ?>"
                              class="form-control" style="width: 90%" autocomplete="off" required>
                          </div>
                      </div>

                      <div class="form-group  col-md-6">
                          <label>Apellidos</label>
                          <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                              <input id="apellidos" name="apellidos" type="text"
                              class="form-control" style="width: 90%" autocomplete="off"
                              value="<?php echo $data['apellidos']; ?>" required>
                          </div>
                      </div>

                  </div>

              </div>


              <div class="row">
                  <div class="col-md-12">
                    <div class="form-group  col-md-6">
                        <label>Dirección</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>
                            <input id="direccion" name="direccion" type="text"
                             class="form-control" style="width:90%" autocomplete="off"
                               value="<?php echo $data['direccion']; ?>" required>
                        </div>
                    </div>
                      <div class="form-group col-md-6">
                          <label>Correo E.</label>
                          <div class="input-group">
                              <span class="input-group-addon">
                                  <i class="fa fa-envelope" aria-hidden="true"></i>
                              </span>
                              <input type="text" class="form-control" id="email"
                              name="email" style="width:80%" autocomplete="off"
                              value="<?php echo $data['email']; ?>" required>
                          </div>
                      </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group col-md-4">
                          <label>Fecha Nac.</label>
                          <div class="input-group">
                              <div class="input-group-addon">
                                  <i class="fa fa-calendar" aria-hidden="true"></i>
                              </div>
                              <input type="text" class="form-control" data-date-format="yyyy-mm-dd"
                              id="fechan" name="fechan" style="width:80%" value="<?php echo $data['fechanacimiento']; ?>">
                          </div><!-- /.input group -->
                      </div>

                      <div class="form-group col-md-4">
                          <label>Edad.</label>
                          <div class="input-group">
                              <div class="input-group-addon">
                                  <i class="fa fa-arrow-right" aria-hidden="true"></i>
                              </div>
                              <input type="text" class="form-control"
                              id="edad" name="edad" style="width:80%"  value="<?php echo $data['edad']; ?>">
                          </div><!-- /.input group -->
                      </div>

                      <div class="form-group col-md-4">
                          <label>Celular</label>
                          <div class="input-group">
                              <div class="input-group-addon">
                                  <i class="fa fa-phone" aria-hidden="true"></i>
                              </div>
                              <input type="text" class="form-control" id="celular"
                              name="celular" style="width:80%" value="<?php echo $data['celular']; ?>">
                          </div><!-- /.input group -->
                      </div>

                    </div>
                    </div>


              <div class="row">
                  <div class="col-md-12">


                      <div class="form-group col-md-6">
                          <label>Fecha Creacion</label>
                          <div class="input-group">
                              <div class="input-group-addon">
                                  <i class="fa fa-calendar" aria-hidden="true"></i>
                              </div>
                              <input type="text" class="form-control date-picker"
                               id="fechac" name="fechac" style="width:50%" data-date-format="yyyy-mm-dd"
                               value="<?php echo $data['fechacreacion']; ?>">
                          </div><!-- /.input group -->
                      </div>

                      <div class="form-group col-md-6">
                          <label>Invitador Por</label>
                          <div class="input-group">
                              <div class="input-group-addon">
                                  <i class="fa  fa-comment-o"></i>
                              </div>
                              <input type="text" class="form-control" id="invitado"
                              name="invitado" value="<?php echo $data['invitado']; ?>"/>
                          </div>
                      </div>

                  </div>
              </div>

              <div class="row">
                  <div class="col-md-12">
                    <div class="form-group col-md-4">
                        <label>Observaciones</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa  fa-comment-o"></i>
                            </div>
                            <textarea class="form-control" rows="3" id="observaciones"
                            name="observaciones" style="width: 100%">
                              <?php echo $data['observaciones']; ?>
                            </textarea>
                        </div>
                    </div>
                      <div class="form-group col-md-4">
                          <label>Llamada 1</label>
                          <div class="input-group">
                              <div class="input-group-addon">
                                  <i class="fa  fa-comment-o"></i>
                              </div>
                              <textarea class="form-control" rows="3" id="llamada1"
                              name="llamada1" style="width: 100%;">
                                <?php echo $data['llamada1']; ?>
                              </textarea>
                          </div>
                      </div>

                      <div class="form-group col-md-4">
                          <label>Llamada 2</label>
                          <div class="input-group">
                              <div class="input-group-addon">
                                  <i class="fa  fa-comment-o"></i>
                              </div>
                              <textarea class="form-control" rows="3" id="llamada2"

                              name="llamada2" style="width: 100%"> <?php echo $data['llamada2']; ?></textarea>
                          </div>
                      </div>

                  </div>
              </div>


              <div class="row">
                  <div class="col-md-12">

                      <div class="form-group col-md-2">
                          <label>Es Nuevo</label>
                          <div class="input-group">
                              <input type="checkbox" id="nuevo" name="nuevo"  <?php if($data['nuevo']==1) { echo "checked"; } ?> >
                          </div>
                      </div>
                      <div class="form-group col-md-2">
                          <label>New People</label>
                          <div class="input-group">
                              <input type="checkbox" id="newpeople" name="newpeople" <?php if($data['newpeople']==1) { echo "checked"; } ?>>
                          </div>
                      </div>
                      <div class="form-group col-md-2">
                          <label>Recibir Correos</label>
                          <div class="input-group">
                              <input type="checkbox" id="recibecorreo" name="recibecorreo" <?php if($data['recibecorreo']==1) { echo "checked"; } ?>>
                          </div>
                      </div>

                      <div class="form-group col-md-4">
                          <label>Recibir Whatsapp</label>
                          <div class="input-group">
                              <input type="checkbox" id="recibewhatsapp" name="recibewhatsapp" <?php if($data['escuelaformacion']==1) { echo "checked"; } ?> >
                          </div>
                      </div>
                  </div>
              </div>
            </div>

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                  <a href="?module=miembros" class="btn btn-danger btn-reset">Regresar</a>
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
