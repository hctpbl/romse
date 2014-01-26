<?php
/* @var $this ArtefactoController */
/* @var $model Artefacto */

$this->breadcrumbs=array(
	'Artefactos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Artefactos', 'url'=>array('index')),
	array('label'=>'Crear Artefacto', 'url'=>array('create')),
	array('label'=>'Ver Artefacto', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar Artefactos', 'url'=>array('admin')),
);
?>

<h1>Actualizar Artefacto <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>