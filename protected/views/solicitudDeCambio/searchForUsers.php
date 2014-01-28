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

<h1>Búsqueda de Solicitudes de cambio</h1>

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
	'dataProvider'=>$model->searchUser(),
	'filter'=>$model,
	'columns'=>array(
		'descripcion_breve',
		'nombre_estado',
		array
		(
				'class'=>'CButtonColumn',
				'template'=>'{view}',
				'buttons'=>array
				(
						'view' => array
						(
								'url' =>'Yii::app()->createUrl("/solicitudDeCambio/view",array("id"=>$data->id))',
						),
				),
		),
		array
		(
				'class'=>'CButtonColumn',
				'template'=>'{update}',
				'buttons'=>array
				(
						'update' => array
						(
								'visible'=>'CambioDeEstadoController::checkUser($data->nombre_estado, $data->id)',
								'url' =>'Yii::app()->createUrl("/cambioDeEstado/view",array("id"=>$data->id))',
						),
				),
		),
		array
		(
				'class'=>'CButtonColumn',
				'template'=>'{delete}',
				'buttons'=>array
				(
						'delete' => array
						(
								'visible'=>'SolicitudDeCambioController::checkUserCreater($data->id) && $data->nombre_estado==\'Creado\'',
								'url' =>'Yii::app()->createUrl("solicitudDeCambio/delete", array("id"=>$data->id))',
						),
				),
		)
	),
)); ?>
