<?php
/* @var $this SiteController */
/* @var $modelChangesClosed SolicitudDeCambio */
/* @var $modelChangesCreator SolicitudDeCambio */
/* @var $modelChangesTester SolicitudDeCambio */
/* @var $modelChangesDeveloper SolicitudDeCambio */

$this->pageTitle=Yii::app()->name. ' - Lista de cambios';
$this->breadcrumbs=array(
	'Lista de cambios',
);
?>

<h3>Solicitudes creadas por mi en trámite</h3>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider' => new CArrayDataProvider($modelChangesCreator),
		'columns' => array(
				'id', 'descripcion_breve:text:Desc. Breve', 'descripcion_detallada:text:Desc. Detalle',
				'impacto:text:Impacto', 'prioridad:text:Prioridad', 'temporizacion:text:Temporizacion',
				'riesgos:text:Riesgos',
				'artefacto:text:artefacto', 'creador:text:Creador',
				'probador:text:Probador', 'desarrollador:text:Desarrollador', 'nombre_estado:text:Estado',
				array
				(
						'class'=>'CButtonColumn',
						'template'=>'{view}',
						'buttons'=>array
						(
								'view' => array
								(
										'url' =>'Yii::app()->createUrl("/cambiodeestado/".$data->id)',
								),

						),
				)
		),
));
?>

<h3>Solicitudes en las que soy probador</h3>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider' => new CArrayDataProvider($modelChangesTester),
		'columns' => array(
				'id', 'descripcion_breve:text:Desc. Breve', 'descripcion_detallada:text:Desc. Detalle',
				'impacto:text:Impacto', 'prioridad:text:Prioridad', 'temporizacion:text:Temporizacion',
				'riesgos:text:Riesgos',
				'artefacto.nombre:text:Artefacto', 'creador0.username:text:Creador',
				'probador0.username:text:Probador', 'desarrollador0.username:text:Desarrollador',
				array
				(
						'class'=>'CButtonColumn',
						'template'=>'{view}',
						'buttons'=>array
						(
								'view' => array
								(
										'url' =>'Yii::app()->createUrl("/cambiodeestado/".$data->id)',
								),

						),
				)
		),
));
?>
<h3>Solicitudes en las que soy desarrollador</h3>
<?php 

$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider' => new CArrayDataProvider($modelChangesDeveloper),
		'columns' => array(
				'id', 'descripcion_breve:text:Desc. Breve', 'descripcion_detallada:text:Desc. Detalle',
				'impacto:text:Impacto', 'prioridad:text:Prioridad', 'temporizacion:text:Temporizacion',
				'riesgos:text:Riesgos',
				'artefacto.nombre:text:Artefacto', 'creador0.username:text:Creador',
				'probador0.username:text:Probador', 'desarrollador0.username:text:Desarrollador',
				array
				(
						'class'=>'CButtonColumn',
						'template'=>'{view}',
						'buttons'=>array
						(
								'view' => array
								(
										'url' =>'Yii::app()->createUrl("/cambiodeestado/".$data->id)',
								),

						),
				)
		),
));
?>

<h3>Solicitudes de cambio cerradas</h3>
<?php 

$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider' => new CArrayDataProvider($modelChangesClosed),
		'columns' => array(
				'id', 'descripcion_breve:text:Desc. Breve', 'descripcion_detallada:text:Desc. Detalle',
				'impacto:text:Impacto', 'prioridad:text:Prioridad', 'temporizacion:text:Temporizacion',
				'riesgos:text:Riesgos',
				'artefacto:text:artefacto', 'creador:text:Creador',
				'probador:text:Probador', 'desarrollador:text:Desarrollador', 'nombre_estado:text:Estado',
				array
				(
						'class'=>'CButtonColumn',
						'template'=>'{view}',
						'buttons'=>array
						(
								'view' => array
								(
										'url' =>'Yii::app()->createUrl("/cambiodeestado/".$data->id)',
								),

						),
				)
		),
));
?>
<p><?php echo CHtml::button('Crear nueva solicitud de cambio', array('submit' => '?r=solicitudDeCambio/create')); ?></p>
