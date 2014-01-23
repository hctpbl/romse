<?php
/* @var $this SiteController */
/* @var $modelChangesClosed SolicitudDeCambio */

$this->pageTitle=Yii::app()->name. ' - Lista de cambios cerrados';
$this->breadcrumbs=array(
	'Lista de cambios cerrados',
);
?>

<h3>Lista de cambios cerrados</h3>

<?php
//$solicitudes = SolicitudDeCambio::model()->with(array('cambioDeEstados'=>array('condition'=>'cambioDeEstados.estado_id=10'),))->findAll();
//$dataProvider = SolicitudDeCambio::model()->with(array('cambioDeEstados'=>array('alias'=>'cambioEstados', 'with'=>array('estado'=>array('condition'=>'estado.nombre=\'Cerrado\''))),))->findAll();
$this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => new CArrayDataProvider($modelChangesClosed),
        'columns' => array(
        'id', 'descripcion_breve', 'descripcion_detallada',
		'impacto', 'prioridad', 'temporizacion', 'riesgos',
		'artefacto_id', 'creador', 'probador', 'desarrollador',
		array
		(
			'class'=>'CButtonColumn',
			'template'=>'{delete}',
			'buttons'=>array
			(
				'delete' => array
				(
					'url' =>'Yii::app()->createUrl("/solicitudDeCambio/delete/".$data->id)',
				),
			),
		)
        ),
    ));
?>