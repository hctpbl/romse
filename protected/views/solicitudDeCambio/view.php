<?php
/* @var $historyChanges SolicitudDeCambioController */
/* @var $model SolicitudDeCambio */

$this->breadcrumbs=array(
	'Solicitud De Cambios'=>array('index'),
	$model->id,
);

if (Yii::app()->user->rol_id == 'ROL_CCC'){
	$this->menu=array(
		array('label'=>'List SolicitudDeCambio', 'url'=>array('index')),
		array('label'=>'Create SolicitudDeCambio', 'url'=>array('create')),
		array('label'=>'Update SolicitudDeCambio', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Delete SolicitudDeCambio', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Manage SolicitudDeCambio', 'url'=>array('admin')),
	);
}
?>

<h1>View SolicitudDeCambio #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'descripcion_breve',
		'descripcion_detallada',
		'fecha_creacion',
		'impacto',
		'prioridad',
		'temporizacion',
		'riesgos',
		'artefacto_id',
		'creador',
		'probador',
		'desarrollador',
	),
)); 

if (Yii::app()->user->rol_id == 2){
?>
<br/>
<br/>

<h1>Historial de cambios en la solicitud</h1>


<?php

/*$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider' => new CArrayDataProvider($historyChanges),
		'columns' => array(
				'solicitud_de_cambio_id', 'usuario_id', 'fecha', 'estado_id' 
						),
));*/
//print_r($historyChanges);
$this->widget('zii.widgets.CDetailView', array(
		'data'=>$historyChanges,
		'attributes'=>array(
				'solicitud_de_cambio_id',
				'usuario_id',
				'fecha',
				'estado_id',
		),
));

}
?>
