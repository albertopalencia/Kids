<section class="content-header">
  <div class="row">
    <div class="col-md-6">
      <h3>
        <i class="fa fa-users"></i> Listado
      </h3>
    </div>
      <div class="col-md-6">
        <ol class="breadcrumb">
          <li><a href="?module=start"><i class="fa fa-home"></i> Inicio </a></li>
          <li><a href="?module=alumnos"><i class="fa fa-users"></i>  Alumnos </a></li>
          <li class="active"> Listado </li>
        </ol>
      </div>
  </div>
  <div class="row">
    <div class="col-md-4 pull-left">
      <a class="btn btn-primary btn-social "
      href="?module=form_alumnos" title="agregar" >
        <i class="fa fa-plus"></i> Agregar
      </a>
    </div>
  </div>
<hr/>
<div class="row">
  <div class="col-md-12">
     <div class="box box-primary">
  <form role="form" id="frm_buscar" name="frm_buscar" action="?module=alumnos" class="form-inline" method="POST">
    <div class="box-body">
            <div class="form-group">
                <label class="col-sm-4">Fecha Ingreso</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd"
                    name="fechacreacion" autocomplete="off"
					                 value="<?php if(isset($_POST['fechacreacion'])){ echo $_POST['fechacreacion']; }?>">
                  </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4">Fecha Ingreso</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd"
                      name="fechacreacion1" autocomplete="off"
					                 value="<?php if(isset($_POST['fechacreacion1'])){ echo $_POST['fechacreacion1']; }?>">
                  </div>
            </div>
        <!--    <div class="form-group">
                <label class="col-sm-3">Nombres</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control"  name="nombres"
          					autocomplete="off" value="<?php if(isset($_POST['nombres'])){echo $_POST['nombres'];}?>">
                  </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3">Apellidos</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control"  name="apellidos"
					                   autocomplete="off" value="<?php if(isset($_POST['apellidos'])){echo $_POST['apellidos'];}?>">
                  </div>
            </div> -->

        </div>
        <div class="box-footer">
          <div class="form-group">
            <button type="submit" id="btnbuscar" name="buscar" class="btn btn-primary btn-social">
                <i class="fa fa-search"></i> Buscar
            </button>
          </div>
        </div>
         </form>
      </div>
  </div>
</div>

</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
  <?php

        if ($_GET['alert'] == 3) {
          echo "<div id='alertdismis' class='alert alert-success alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
                   Registro eliminado correctamente
                </div>";
        }elseif ($_GET['alert'] == 2) {
          echo "<div id='alertdismis' class='alert alert-success alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
                     Registro modificado correctamente.
                </div>";
        }
   ?>
      <div class="box box-primary">
        <div id="msg" class="overlay" style="display: none;">
           <i class="fa fa-refresh fa-spin fa-3x fa-fw" aria-hidden="true"></i>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table id="dataTables1" class="table table-bordered table-striped table-hover">
              <thead>
                  <tr>
                    <th class="center">Id</th>
                    <th class="center">Documento Acudiente</th>
                    <th class="center">Nombre Acudiente</th>
                    <th class="center"> Hijos</th>
                    <th class="center"> Fecha Ingreso</th>
                    <th class="center"> Registrado Por</th>
                    <th class="center"> Estado</th>
                    <th class="center"> Fecha Salida</th>
                    <th class="center"> Salida Por</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
			<?php
				$sWhere = "";

				if (isset($_POST['fechacreacion'])  || isset($_POST['fechacreacion']) || isset($_POST['nombres']) || isset($_POST['apellidos'])) {

				$fechaini = $_POST['fechacreacion'];
        $fechafin = $_POST['fechacreacion1'];
				$nombres = $_POST['nombres'];
				$apellidos = $_POST['apellidos'];

				//armamos el query
				if ($fechaini!='' && $fechafin!='') {
				      $sWhere = "Where fechacreacion between '".$fechaini."' and  '".$fechafin."' ";
				} elseif ($fechaini!='' && $fechafin==''){
           $sWhere = "Where fechacreacion between '".$fechaini."' and  '".$fechaini."' ";
        }elseif($fechaini=='' && $fechafin!=''){
          $sWhere = "Where fechacreacion between '".$fechafin."' and  '".$fechafin."' ";
        }

				if ($nombres!='') {
					if ($sWhere=='') {
						$sWhere = " Where nombres like '%".$nombres."%'";
					}else {
					  $sWhere .= " OR nombres like '%".$nombres."%'";
					}
				}

				if ($apellidos!='') {
					if ($sWhere=='') {
						$sWhere = " Where apellidos like '%".$apellidos."%'";
					}else {
					  $sWhere .= " OR apellidos like '%".$apellidos."%'";
					}
				}

				if ($sWhere=='') {
					$sWhere=='Where 1=1';
				}
			}

			 $consulta = " SELECT a.id,a.hijos,a.cedula_acudiente,a.nombrecompleto,a.fechacreacion,CONCAT(u.nombres, ' ', u.apellidos)  as  creado_por
                     ,a.status,a.fechasalida,CONCAT(us.nombres, ' ', us.apellidos) as salida_por
                    FROM alumno a join usuarios u on a.creado_por = u.id left join usuarios us
                    on a.salida_por = us.id "
                  . $sWhere."  ORDER BY a.id DESC LIMIT 100";

       $query = mysqli_query($mysqli, $consulta) or die('error: '.mysqli_error($mysqli));
			  $no=1;


              while ($data = mysqli_fetch_assoc($query)) {

                 $fila = "<tr>";
        					  $fila.="<td class='center'>$no</td>";
        					  $fila.="<td class='center'>$data[cedula_acudiente]</td>";
        					  $fila.="<td class='center'>$data[nombrecompleto]</td>";
        					  $fila.="<td  align='center'>$data[hijos]</td>";
        					  $fila.="<td  align='center'>$data[fechacreacion]</td>";
        					  $fila.="<td align='center'>$data[creado_por]</td>";
                    if($data['status']=='entrada'){
                        $fila.="<td class='center'><span class='text text-success'>Ingreso</span></td>";
                    }else {
                        $fila.="<td class='center'><span class='text text-danger'>Salida</span></td>";
                    }
                    $fila.="<td align='center'>$data[fechasalida]</td>";
                      $fila.="<td align='center'>$data[salida_por]</td>";
                    $fila.="<td class='center'>";
        					  $fila.="<a id='btneliminar'  data-toggle='tooltip' data-toggle='title' data-placement='top' title='Eliminar' class='btn btn-danger btn-sm' ";
                    $fila.=" href='modules/alumnos/proses.php?act=delete&id=$data[id]'
                    onclick='return confirm('estas seguro de eliminar $data[nombres]'); >";
        					  $fila.="<i style='color:#fff' class='glyphicon glyphicon-trash'></i></a></td>";
				         $fila.="</tr>";
				         echo $fila;

                $no++;
              }
              ?>
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  $(document).ready(function(){
    if($('#alertdismis').is(':visible')){
      $('#alertdismis').fadeOut(2000,function(){
          location.href = "main.php?module=alumnos";
      });
    }
  });
</script>
