<?php
/* @var $this ArtefactoController */
/* @var $model Artefacto */

$this->breadcrumbs=array(
	'Artefactos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Artefacto', 'url'=>array('index')),
	array('label'=>'Manage Artefacto', 'url'=>array('admin')),
);
?>

<h1>Create Artefacto</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>