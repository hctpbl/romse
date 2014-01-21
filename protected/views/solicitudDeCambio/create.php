<?php
/* @var $this SolicitudDeCambioController */
/* @var $model SolicitudDeCambio */

$this->breadcrumbs=array(
	'Solicitud De Cambios'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SolicitudDeCambio', 'url'=>array('index')),
	array('label'=>'Manage SolicitudDeCambio', 'url'=>array('admin')),
);
?>

<h1>Create SolicitudDeCambio</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>