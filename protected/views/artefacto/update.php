<?php
/* @var $this ArtefactoController */
/* @var $model Artefacto */

$this->breadcrumbs=array(
	'Artefactos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Artefacto', 'url'=>array('index')),
	array('label'=>'Create Artefacto', 'url'=>array('create')),
	array('label'=>'View Artefacto', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Artefacto', 'url'=>array('admin')),
);
?>

<h1>Update Artefacto <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>