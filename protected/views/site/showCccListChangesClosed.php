<?php
/* @var $this UsuarioController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle=Yii::app()->name. ' - Lista de cambios cerrados';
$this->breadcrumbs=array(
	'Lista de cambios cerrados',
);
?>

<h3>Lista de cambios cerrados</h3>

<?php


//$solicitudes = SolicitudDeCambio::model()->with(array('cambioDeEstados'=>array('condition'=>'cambioDeEstados.estado_id=10'),))->findAll();
$solicitudes = SolicitudDeCambio::model()->with(array('cambioDeEstados'=>array('alias'=>'cambioEstados', 'with'=>array('estado'=>array('condition'=>'estado.nombre=\'Cerrado\''))),))->findAll();
$list = CHtml::listData($solicitudes, 'id', 'descripcion_breve');
print_r($list);



?>