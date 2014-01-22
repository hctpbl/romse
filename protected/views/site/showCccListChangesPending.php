<?php
/* @var $this SiteController */
/* @var $modelChangesPending SolicitudDeCambio */

$this->pageTitle=Yii::app()->name. ' - Lista de cambios pendientes';
$this->breadcrumbs=array(
	'Lista de cambios pendientes',
);
?>

<h3>Lista de cambios pendientes</h3>

<?php
/*$dataProvider=new CActiveDataProvider('SolicitudDeCambio');

$dataProvider = SolicitudDeCambio::model()->findAll(array(
				'select'=>'*',
				'condition'=>'id NOT IN (SELECT solicitud_de_cambio_id 
										FROM cambio_de_estado, estado 
										WHERE estado_id = id
										AND nombre = \'Cerrado\')'));*/

$this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => new CArrayDataProvider($modelChangesPending),
        'columns' => array(
        'id', 'descripcion_breve', 'descripcion_detallada',
		'impacto', 'prioridad', 'temporizacion', 'riesgos',
		'artefacto_id', 'creador', 'probador', 'desarrollador',
		array
		(
			'class'=>'CButtonColumn',
			'template'=>'{update}',
			'buttons'=>array
			(
				'update' => array
				(
					'url' =>'Yii::app()->createUrl("/solicitudDeCambio/update/".$data->id)',
				),

			),
		)
        ),
    ));

?>