<?php
/* @var $this SiteController */
/* @var $modelChanges SolicitudDeCambio */
/* @var $historyChanges CambioDeEstadoController */

$this->pageTitle=Yii::app()->name. ' - Informes';
$this->breadcrumbs=array(
	'Informes',
);
?>

<h1>Lista de informes disponibles</h1>
<h3>Historial de solicitudes de cambio</h3>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider' => new CArrayDataProvider($modelChanges),
		'columns' => array(
				'id', 'descripcion_breve:text:Desc. Breve', 'descripcion_detallada:text:Desc. Detalle',
				'impacto:text:Impacto', 'prioridad:text:Prioridad', 'temporizacion:text:Temporizacion',
				'riesgos:text:Riesgos',
				'artefacto.nombre:text:artefacto', 'creador0.username:text:Creador',
				'probador0.username:text:Probador',
				'desarrollador0.username:text:Desarrollador', 'nombre_estado:text:Estado',
				array
				(
						'class'=>'CButtonColumn',
						'template'=>'{view}',
						'buttons'=>array
						(
								'view' => array
								(
										'url' =>'Yii::app()->createUrl("/solicitudDeCambio/".$data->id)',
								),

						),
				)
		),
)); 
?>



