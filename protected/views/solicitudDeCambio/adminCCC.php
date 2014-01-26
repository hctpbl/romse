<?php
/* @var $this SolicitudDeCambioController */
/* @var $model SolicitudDeCambio */

$this->breadcrumbs=array(
	'Solicitudes de cambio'=>array('index'),
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

<h1>Gestión de Solicitudes de cambio</h1>

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
