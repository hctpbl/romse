<?php
/* @var $this ArtefactoController */
/* @var $model Artefacto */

$this->breadcrumbs=array(
	'Artefactos'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Artefactos', 'url'=>array('index')),
	array('label'=>'Gestionar Artefactos', 'url'=>array('admin')),
);
?>

<h1>Crear Artefacto</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>