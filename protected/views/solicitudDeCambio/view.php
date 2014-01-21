<?php
/* @var $this SolicitudDeCambioController */
/* @var $model SolicitudDeCambio */

$this->breadcrumbs=array(
	'Solicitud De Cambios'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SolicitudDeCambio', 'url'=>array('index')),
	array('label'=>'Create SolicitudDeCambio', 'url'=>array('create')),
	array('label'=>'Update SolicitudDeCambio', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SolicitudDeCambio', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SolicitudDeCambio', 'url'=>array('admin')),
);
?>

<h1>View SolicitudDeCambio #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'descripcion_breve',
		'descripcion_detallada',
		'impacto',
		'prioridad',
		'temporizacion',
		'riesgos',
		'fecha_creacion',
		'artefacto_id',
		'creador',
		'probador',
		'desarrollador',
	),
)); ?>
