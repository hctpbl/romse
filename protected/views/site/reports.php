<?php
/* @var $this SiteController */
/* @var $modelChanges SolicitudDeCambio */
/* @var $modelProjects Proyecto */
/* @var $modelArtifacts Artefacto */
/* @var $historyChanges CambioDeEstadoController */

$this->pageTitle=Yii::app()->name. ' - Informes';
$this->breadcrumbs=array(
	'Informes',
);
?>

<h1>Lista de informes disponibles</h1>
<!-- <h2><a href='../solicitudDeCambio/adminCCC' >Solicitudes de cambio</a></h2>-->
<!-- <h3><a href='../solicitudDeCambio/adminCCC' >Solicitudes de cambio</a></h3>

<h2><a href='../proyecto/adminCCC' >Proyectos</a></h2>

<h2><a href='../artefacto/adminCCC' >Artefactos</a></h2>
<h3><a href='../artefacto/adminCCC' >Artefactos</a></h3> -->

<h2>Gráficas</h2>
<h3>Número de solicitudes este mes hasta el momento: <?php echo SolicitudDeCambioController::getChangesRequestByMonth()?></h3>


<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    <?php
    $changesRequestEnviado = SolicitudDeCambioController::getChangesRequestEnviado();
    $changesRequestAbierto = SolicitudDeCambioController::getChangesRequestAbierto();
    $changesRequestVerificado = SolicitudDeCambioController::getChangesRequestVerificado();
    $changesRequestDupRech = SolicitudDeCambioController::getChangesRequestDupRech();
    $changesRequestActualizada = SolicitudDeCambioController::getChangesRequestActualizada();
    $changesRequestCerrado = SolicitudDeCambioController::getChangesRequestCerrado();
    ?>
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Enviado', <?php echo $changesRequestEnviado?>],
          ['Abierto', <?php echo $changesRequestAbierto?>],
          ['Verificado', <?php echo $changesRequestVerificado?>],
          ['Duplicado/Rechazado', <?php echo $changesRequestDupRech?>],
          ['Actualizada', <?php echo $changesRequestActualizada?>],
          ['Cerrado', <?php echo $changesRequestCerrado?>],
        ]);

        // Set chart options
        var options = {'title':'Estados de las solicitudes que afectan al CCC',
                       'width':400,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    <?php SolicitudDeCambioController::getChangesRequestEnviadoFourMonthsAgo();?>
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          ['2004',  1000,      400],
          ['2005',  1170,      460],
          ['2006',  660,       1120],
          ['2007',  1030,      540]
        ]);

        var options = {
          title: 'Company Performance',
          hAxis: {title: 'Year', titleTextStyle: {color: 'red'}}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('bar_chart'));
        chart.draw(data, options);
      }
    </script>
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <div id="pie_chart"></div>
    <br/>
    <div id="bar_chart"></div>
  </body>
</html>



