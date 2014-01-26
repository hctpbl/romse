<?php
/* @var $this ArtefactoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Artefactos',
);

$this->menu=array(
	array('label'=>'Crear Artefacto', 'url'=>array('create')),
	array('label'=>'Gestionar Artefactos', 'url'=>array('admin')),
);
?>

<h1>Artefactos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
