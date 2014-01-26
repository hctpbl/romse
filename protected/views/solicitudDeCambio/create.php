<?php
/* @var $this SolicitudDeCambioController */
/* @var $model SolicitudDeCambio */

$this->breadcrumbs=array(
	'Solicitudes de cambio'=>array('index'),
	'Create',
);

if (Yii::app()->user->rol_id == 'ROL_CCC'){
	$this->menu=array(
		array('label'=>'Listar Solicitudes de cambio', 'url'=>array('index')),
		array('label'=>'Gestionar Solicitudes de cambio', 'url'=>array('admin')),
	);
}
?>

<h1>Crear Solicitud de cambio</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>