<?php
/* @var $this SolicitudDeCambioController */
/* @var $model SolicitudDeCambio */

$this->breadcrumbs=array(
	'Solicitudes de cambio'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);


if (Yii::app()->user->rol_id == 'ROL_CCC'){
	$this->menu=array(
		array('label'=>'List SolicitudDeCambio', 'url'=>array('index')),
		array('label'=>'Create SolicitudDeCambio', 'url'=>array('create')),
		array('label'=>'View SolicitudDeCambio', 'url'=>array('view', 'id'=>$model->id)),
		array('label'=>'Manage SolicitudDeCambio', 'url'=>array('admin')),
	);
}
?>

<h1>Actualizar Solicitud de cambio <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>