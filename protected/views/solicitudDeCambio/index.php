<?php
/* @var $this SolicitudDeCambioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Solicitud De Cambios',
);

$this->menu=array(
	array('label'=>'Create SolicitudDeCambio', 'url'=>array('create')),
	array('label'=>'Manage SolicitudDeCambio', 'url'=>array('admin')),
);

?>

<h1>Solicitud De Cambios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
