<?php
/* @var $historyChanges SolicitudDeCambioController */
/* @var $model SolicitudDeCambio */

$this->breadcrumbs=array(
	'Solicitud De Cambios'=>Yii::app()->request->urlReferrer,
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
		'impacto',
		'prioridad',
		'temporizacion',
		'riesgos',
		'artefacto.nombre:text:Artefacto',
		'creador0.username:text:Creador',
		'probador0.username:text:Probador',
		'desarrollador0.username:text:Desarrollador',
	),
)); 

if (Yii::app()->user->rol_id == 2){
?>
<br/>
<br/>

<h1>Historial de cambios en la solicitud</h1>


<?php
$dataProvider=new CArrayDataProvider($historyChanges, array('keyField'=>'usuario_id'));
$this->widget('zii.widgets.grid.CGridView', array(
		//'dataProvider' => new CArrayDataProvider($historyChanges, array('keyField'=>'usuario_id')),
		'dataProvider' => $dataProvider,
		/*'columns' => array(
				'usuario_id:text:Cambio realizado por', 
				'fecha:text:Fecha del cambio',
				'estado_id:text:Estado'
		),*/
		'columns' => array(
				'usuario.username:text:Cambio realizado por', 
				'fecha:text:Fecha del cambio',
				'estado.nombre:text:Estado',
				/*array(
					'header'=>'prueba',
					'type'=>'raw',
					'value'=>EstadoController::getNameFromId('1')),*/
		),
));
}
?>
