<?php
/* @var $this SolicitudDeCambioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Solicitudes de cambio',
);

$this->menu=array(
	array('label'=>'Crear Solicitud de cambio', 'url'=>array('create')),
	array('label'=>'Gestionar Solicitudes de cambio', 'url'=>array('admin')),
);

?>

<h1>Solicitudes de cambio</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
