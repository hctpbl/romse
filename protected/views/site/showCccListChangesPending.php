<?php
/* @var $this SolicitudDeCambioController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle=Yii::app()->name. ' - Lista de cambios pendientes';
$this->breadcrumbs=array(
	'Lista de cambios pendientes',
);
?>

<h3>Lista de cambios pendientes</h3>

<?php
/*$model=SolicitudDeCambio::model()->findAll();
if ($model)
	echo $model->descripcion_breve;
else
	echo 'No existe el modelo';*/
//return CHtml::listData(SolicitudDeCambio::model()->findAll(),'id','descripcion_breve');
/*$solicitudes=SolicitudDeCambio::model()->findAll();
$list = CHtml::listData($solicitudes, 'id', 'descripcion_breve');
print_r($list);*/

//$solicitudes = SolicitudDeCambio::model()->with(array('cambioDeEstados'=>array('condition'=>'cambioDeEstados.estado_id!=10'),))->findAll();
//$solicitudes = SolicitudDeCambio::model()->with(array('cambioDeEstados'=>array('alias'=>'cambioEstados', 'with'=>array('estado'=>array('condition'=>'estado.nombre!=\'Cerrado\''))),))->findAll();
$solicitudes = SolicitudDeCambio::model()->with(array('cambioDeEstados'=>array('alias'=>'cambioDeEstados', 'with'=>array('estado'=>array('condition'=>'estado.nombre!=\'Cerrado\''))),))->findAll();
$list = CHtml::listData($solicitudes, 'id', 'descripcion_breve');
print_r($list);



?>