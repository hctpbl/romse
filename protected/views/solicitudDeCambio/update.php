<?php
/* @var $this SolicitudDeCambioController */
/* @var $model SolicitudDeCambio */

$this->breadcrumbs=array(
	'Solicitud De Cambios'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);


$ccc = (!Yii::app()->user->isGuest and Yii::app()->user->rol_id == '2') ? true : false;
if (!$ccc){
	$this->menu=array(
		array('label'=>'List SolicitudDeCambio', 'url'=>array('index')),
		array('label'=>'Create SolicitudDeCambio', 'url'=>array('create')),
		array('label'=>'View SolicitudDeCambio', 'url'=>array('view', 'id'=>$model->id)),
		array('label'=>'Manage SolicitudDeCambio', 'url'=>array('admin')),
	);
}
?>

<h1>Update SolicitudDeCambio <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>