<?php
/* @var $this ProyectoController */
/* @var $model Proyecto */

$this->breadcrumbs=array(
	'Proyectos'=>array('index'),
	$model->nombre,
);

if (Yii::app()->user->rol_id == 1):

	$this->menu=array(
		array('label'=>'List Proyecto', 'url'=>array('index')),
		array('label'=>'Create Proyecto', 'url'=>array('create')),
		array('label'=>'Update Proyecto', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Delete Proyecto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Manage Proyecto', 'url'=>array('admin')),
	);
	
endif;
?>

<h1>View Proyecto: <?php echo $model->nombre; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'nombre',
		'fecha_inicio',
		'fecha_fin',
		'costes',
		'descripcion',
	),
)); ?>
