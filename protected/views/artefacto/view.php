<?php
/* @var $this ArtefactoController */
/* @var $model Artefacto */

$this->breadcrumbs=array(
	'Artefactos'=>array('index'),
	$model->nombre,
);

if (Yii::app()->user->rol_id == 1):

	$this->menu=array(
		array('label'=>'List Artefacto', 'url'=>array('index')),
		array('label'=>'Create Artefacto', 'url'=>array('create')),
		array('label'=>'Update Artefacto', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Delete Artefacto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Manage Artefacto', 'url'=>array('admin')),
	);
	
endif;
?>

<h1>View Artefacto: <?php echo $model->nombre; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'nombre',
		'uri',
		'rol',
		'descripcion',
		'version',
		array(
			'label' => 'Proyecto',
			'value' => CHtml::link(CHtml::encode(
				$model->proyecto->nombre),
				array('proyecto/view','id'=>$model->proyecto_id)), 'type' => 'raw'
		),
		array(
			'label' => 'Depende del artefacto',
			'visible' => isset($model->dependeDe->nombre),
			'value' => isset($model->dependeDe->nombre) ? CHtml::link(CHtml::encode(
				$model->dependeDe->nombre),
				array('artefacto/view','id'=>$model->depende_de)) : '', 'type' => 'raw'
		),
	),
)); ?>
