<?php
/* @var $this SiteController */
/* @var $modelChangesClosed SolicitudDeCambio */
/* @var $modelChangesPending SolicitudDeCambio */

$this->pageTitle=Yii::app()->name. ' - Lista de cambios';
$this->breadcrumbs=array(
	'Lista de cambios',
);
?>

<h3>Solicitudes de cambio en trámite</h3>
<?php 
/*$dataProvider=new CActiveDataProvider('SolicitudDeCambio');

$dataProvider = SolicitudDeCambio::model()->findAll(array(
				'select'=>'*',
				'alias'=>'sc',
				'with'=>'creador0',
				'condition'=>'sc.id NOT IN (SELECT solicitud_de_cambio_id 
										FROM cambio_de_estado, estado 
										WHERE estado_id = id
										AND nombre = \'Cerrado\') 				
										AND sc.creador='.Yii::app()->user->id));*/

$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider' => new CArrayDataProvider($modelChangesPending),
		'columns' => array(
				'id', 'descripcion_breve', 'descripcion_detallada',
				'impacto', 'prioridad', 'temporizacion', 'riesgos',
				'artefacto_id', 'creador', 'probador', 'desarrollador',
				array
				(
						'class'=>'CButtonColumn',
						'template'=>'{update}',
						'buttons'=>array
						(
								'update' => array
								(
										'url' =>'Yii::app()->createUrl("/solicitudDeCambio/update/".$data->id)',
								),

						),
				)
		),
));
?>
<h3>Solicitudes de cambio cerradas</h3>
<?php 
/*$dataProvider=new CActiveDataProvider('SolicitudDeCambio');

$dataProvider = SolicitudDeCambio::model()->findAll(array(
				'select'=>'*',
				'alias'=>'sc',
				'with'=>'creador0',
				'condition'=>'sc.id IN (SELECT solicitud_de_cambio_id 
										FROM cambio_de_estado, estado 
										WHERE estado_id = id
										AND nombre = \'Cerrado\') 				
										AND sc.creador='.Yii::app()->user->id));*/
//$dataProvider=$this->actionGetUserChangesClosed();

$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider' => new CArrayDataProvider($modelChangesClosed),
		'columns' => array(
				'id', 'descripcion_breve', 'descripcion_detallada',
				'impacto', 'prioridad', 'temporizacion', 'riesgos',
				'artefacto_id', 'creador', 'probador', 'desarrollador',
				array
				(
						'class'=>'CButtonColumn',
						'template'=>'{update}',
						'buttons'=>array
						(
								'update' => array
								(
										'url' =>'Yii::app()->createUrl("/solicitudDeCambio/update/".$data->id)',
								),

						),
				)
		),
));
?>
<p><?php echo CHtml::button('Crear nueva solicitud de cambio', array('submit' => '?r=solicitudDeCambio/create')); ?></p>