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

<h1>Información estadística</h1>

<h3>Número de solicitudes este mes hasta el momento: <?php echo SolicitudDeCambioController::getChangesRequestThisMonth() ?></h3>

<?php
$changesRequestEnviado = SolicitudDeCambioController::getChangesRequestEnviado();
$changesRequestAbierto = SolicitudDeCambioController::getChangesRequestAbierto();
$changesRequestVerificado = SolicitudDeCambioController::getChangesRequestVerificado();
$changesRequestDupRech = SolicitudDeCambioController::getChangesRequestDupRech();
$changesRequestActualizada = SolicitudDeCambioController::getChangesRequestActualizada();
$changesRequestCerrado = SolicitudDeCambioController::getChangesRequestCerrado();

?>
<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

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
        var options = {'title':'Estados de las solicitudes que afectan al CCC (mes atual)',
                       'width':400,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
        chart.draw(data, options);
      }
    </script>
    
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    <?php
    $actualDate = date('Y-m-d', time());
	$month = date('M', strtotime($actualDate));
    $thisMonthAbierto = CambioDeEstadoController::getChangesRequestAbiertoMonth($actualDate);
    $thisMonthCerrado = CambioDeEstadoController::getChangesRequestCerradoMonth($actualDate);
    
    // Last Month
    $lastMonth = strtotime('-1 months', strtotime($actualDate));
    $lastMonth = date('Y-m-d h:i:s', $lastMonth);
    $monthLast = date('M', strtotime($lastMonth));
    $lastMonthAbierto = CambioDeEstadoController::getChangesRequestAbiertoMonth($lastMonth);
    $lastMonthCerrado = CambioDeEstadoController::getChangesRequestCerradoMonth($lastMonth);

    // Two months ago
    $twoMonthsAgo = strtotime('-2 months', strtotime($actualDate));
    $twoMonthsAgo = date('Y-m-d h:i:s', $twoMonthsAgo);
    $twoMonthLast = date('M', strtotime($twoMonthsAgo));
    $twoMonthAbierto = CambioDeEstadoController::getChangesRequestAbiertoMonth($twoMonthsAgo);
    $twoMonthCerrado = CambioDeEstadoController::getChangesRequestCerradoMonth($twoMonthsAgo);
    
    ?>
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Mes', 'Abierto', 'Cerrado'],
          ['<?php echo $twoMonthLast ?>' ,  <?php echo $twoMonthAbierto ?> ,  <?php echo $twoMonthCerrado ?>],
          ['<?php echo $monthLast ?>' ,  <?php echo $lastMonthAbierto ?> ,  <?php echo $lastMonthCerrado ?>],
          ['<?php echo $month?>' ,  <?php echo $thisMonthAbierto ?> ,  <?php echo $thisMonthCerrado ?>],
        ]);

        var options = {
          title: 'Solicitudes abiertas y cerradas últimos tres meses',
          hAxis: {title: 'Month', titleTextStyle: {color: 'red'}}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('bar_chart'));
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    <?php
    for ($i=0; $i < 30;$i++){
		$arrayCerrado[$i] = CambioDeEstadoController::getChangesRequestCerradoByDay($actualDate);
		$arrayAbierto[$i] = CambioDeEstadoController::getChangesRequestAbiertoByDay($actualDate);
		$actualDate = strtotime('-1 day', strtotime($actualDate));
		$actualDate = date('Y-m-d h:i:s', $actualDate);
	}  
    ?>
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
    	  var data = google.visualization.arrayToDataTable([
    	  ['Day', 'Abiertas' , 'Cerradas' ],
    	  <?php 
			for($i=0; $i <30; $i++){
				if ($i!=0)
					echo ("['".$i."',".$arrayAbierto[$i].",".$arrayCerrado[$i]."],");
				else
					echo ("['Today',".$arrayAbierto[$i].",".$arrayCerrado[$i]."],");
			}
		  ?>
    	  
    	  ]);
        var options = {
          title: 'Solicitudes abiertas y cerradas en los últimos 30 días',
        };

        var chart = new google.visualization.LineChart(document.getElementById('line_chart'));
        chart.draw(data, options);
      }
    </script>
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <div id="pie_chart"></div>
    <br/>
    <div id="bar_chart"></div>
    <br/>
    <div id="line_chart"></div>
  </body>
</html>