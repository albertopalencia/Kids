<!-- Content Header (Page header) -->



<section class="content-header">
  <div class="row">
    <div class="col-md-6">
      <h3>
        <i class="fa fa-file-text-o icon-title"></i>Informes
      </h3>
    </div>
    <div class="col-md-6">
      <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active"><a href="?module=reportes"><i class="fa fa-pie-chart"></i> informes</a></li>
        <li class="active">Generar Reportes</li>
      </ol>
    </div>
  </div>
</section>


<!-- Main content -->
<section class="content">
  <div class="row">
    <!--
      <div class="col-md-4">
          <div class="box box-primary">
            <div class="box box-body">
              <label>Selecciona período</label>
          			<select id="periodo" onchange="drawVisualization();" class="form-control">
                  <option value=' ' selected> Seleccione un periodo </option>
                  <option value='<?php echo date('Y'); ?>'>Período <?php echo date('Y'); ?></option>
          				<option value='<?php echo date('Y') - 1; ?>' >Período <?php echo date('Y') - 1; ?></option>

          			</select>
            </div>
          </div>
          </div>
-->
          <div class="col-md-8">
            <div class="box box-primary">
                <form role="form" class="form-horizontal" method="POST" action="modules/reportes/informe.php" target="_blank">
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-1">Fecha</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" name="fechainicial" autocomplete="off" required>
                      </div>

                      <label class="col-sm-1">Hasta</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" name="fechafin" autocomplete="off" required>
                      </div>
                    </div>
                  </div>

                  <div class="box-footer">
                    <div class="form-group">
                      <div class="col-sm-offset-1 col-sm-11">
                        <button type="submit" class="btn btn-primary btn-social btn-submit" style="width: 120px;">
                          <i class="fa fa-file-excel-o"></i> Generar
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
        </div>
    </div>

      <!--  <div class="row">
          <div class="col-md-12">
            <div id="chart_div" style="width: 100%; height: 550px;"></div>
        </div>
      </div>-->




</section><!-- /.content -->

<!--   -->
<script type="text/javascript">
/*
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

	       function errorHandler(errorMessage) {
            //curisosity, check out the error in the console
            console.log(errorMessage);
            //simply remove the error, the user never see it
            google.visualization.errors.removeError(errorMessage.id);
        }

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
          		var periodo=$("#periodo").val();//Datos que enviaremos para generar una consulta en la base de datos
          		var jsonData= $.ajax({
                        url: 'modules/reportes/chart.php',
						            data: {'periodo':periodo,'action':'ajax'},
                        dataType: 'json',
                        async: false
                    }).responseText;

		var obj = jQuery.parseJSON(jsonData);
		var data = google.visualization.arrayToDataTable(obj);



    var options = {
      title : 'REPORTE DE INVITADOS '+ periodo,
      subtitle: 'Este reporte es anual',
      vAxis: {title: 'Consolidados'},
      hAxis: {title: 'Meses'},
      seriesType: 'bars',
      series: {5: {type: 'line'}}
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
	   google.visualization.events.addListener(chart, 'error', errorHandler);
     chart.draw(data, options);
  }

  // Haciendo los graficos responsivos
      jQuery(document).ready(function(){
        jQuery(window).resize(function(){
         drawVisualization();
        });
      });
*/
</script>
