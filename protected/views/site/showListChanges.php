<?php
/* @var $this UsuarioController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle=Yii::app()->name. ' - Lista de cambios';
$this->breadcrumbs=array(
	'Lista de cambios',
);
?>

<h3>Lista de cambios</h3>

<p><?php echo CHtml::button('Crear nueva solicitud de cambio'); ?></p>