<?php
/* @var $this ArtefactoController */
/* @var $model Artefacto */

$this->breadcrumbs=array(
	'Artefactos'=>array('index'),
	'Gestion de artefactos',
);
/*
$this->menu=array(
	array('label'=>'List Artefacto', 'url'=>array('index')),
	array('label'=>'Create Artefacto', 'url'=>array('create')),
);
*/
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#artefacto-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gestión de Artefactos</h1>

<p>
Opcionalmente se puede introducir un operador de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
o <b>=</b>) al comienzo de cada uno de los valores de búsqueda para especificar cómo se debe realizar la comparación.
</p>

<?php echo CHtml::link('Búsqueda avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'artefacto-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'nombre',
		//'uri',
		//'rol',
		'descripcion',
		'version',
		/*
		'proyecto_id',
		'depende_de',
		*/
		array
		(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
			'buttons'=>array
			(
				'view' => array
				(
					'url' =>'Yii::app()->createUrl("artefacto/viewReport",array("id"=>$data->id))',
				),
			),
		)
	),
)); ?>
