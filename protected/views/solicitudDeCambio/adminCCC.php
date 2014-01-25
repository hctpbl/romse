<?php
/* @var $this SolicitudDeCambioController */
/* @var $model SolicitudDeCambio */

$this->breadcrumbs=array(
	'Solicitud De Cambios'=>array('index'),
	'Gestión de solicitudes de cambio',
);
/*
$this->menu=array(
	array('label'=>'List SolicitudDeCambio', 'url'=>array('index')),
	array('label'=>'Create SolicitudDeCambio', 'url'=>array('create')),
);
*/
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#solicitud-de-cambio-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gestión de Solicitudes De Cambios</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'solicitud-de-cambio-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'descripcion_breve',
		'impacto',
		'prioridad',
		
		//'riesgos',
		/*'artefacto.nombre:text:Artefacto',
		'creador0.username:text:Creador',
		'probador0.username:text:Probador',
		'desarrollador0.username:text:Desarrollador',*/
		array
				(
						'class'=>'CButtonColumn',
						'template'=>'{view}',
						'buttons'=>array
						(
								'view' => array
								(
										'url' =>'Yii::app()->createUrl("solicitudDeCambio/view",array("id"=>$data->id))',
								),

						),
				)
	),
)); ?>
