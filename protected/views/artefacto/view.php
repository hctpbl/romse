<?php
/* @var $this ArtefactoController */
/* @var $model Artefacto */

$this->breadcrumbs=array(
	'Artefactos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Artefacto', 'url'=>array('index')),
	array('label'=>'Create Artefacto', 'url'=>array('create')),
	array('label'=>'Update Artefacto', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Artefacto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Artefacto', 'url'=>array('admin')),
);
?>

<h1>View Artefacto #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'uri',
		'rol',
		'descripcion',
		'version',
		'proyecto_id',
		'depende_de',
	),
)); ?>
