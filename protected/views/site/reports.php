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
<h3>Solicitudes de cambio</h3>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider' => new CArrayDataProvider($modelChanges),
		'columns' => array(
				/*'id',*/ 'descripcion_breve:text:Desc. Breve', 'descripcion_detallada:text:Desc. Detalle',
				/*'impacto:text:Impacto', 'prioridad:text:Prioridad', 'temporizacion:text:Temporizacion',
				'riesgos:text:Riesgos',
				'artefacto.nombre:text:artefacto', 'creador0.username:text:Creador',
				'probador0.username:text:Probador',
				'desarrollador0.username:text:Desarrollador',*/ 'nombre_estado:text:Estado',
				array
				(
						'class'=>'CButtonColumn',
						'template'=>'{view}',
						'buttons'=>array
						(
								'view' => array
								(
										'url' =>'Yii::app()->createUrl("solicitudDeCambio/view",array("id"=>$data->id))',
								),

						),
				)
		),
)); 
?>

<h3>Proyectos</h3>

<?php 

$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider' => new CArrayDataProvider($modelProjects),
		'columns' => array(
				'nombre', 'fecha_inicio', 
				array
				(
						'class'=>'CButtonColumn',
						'template'=>'{view}',
						'buttons'=>array
						(
								'view' => array
								(
										'url' =>'Yii::app()->createUrl("proyecto/viewReport",array("id"=>$data->id))',
								),

						),
				)
		),
));

?>

<h3>Artefactos</h3>

<?php 

$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider' => new CArrayDataProvider($modelArtifacts),
		'columns' => array(
				'nombre', 'descripcion', 'version', 
				array
				(
						'class'=>'CButtonColumn',
						'template'=>'{view}',
						'buttons'=>array
						(
								'view' => array
								(
										'url' =>'Yii::app()->createUrl("artefacto/viewReport",array("id"=>$data->id))',
								),

						),
				)
		),
));

?>


