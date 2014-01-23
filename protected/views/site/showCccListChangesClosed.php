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
        'id', 'descripcion_breve:text:Desc. Breve', 'descripcion_detallada:text:Desc. Detalle',
				'impacto:text:Impacto', 'prioridad:text:Prioridad', 'temporizacion:text:Temporizacion',
				'riesgos:text:Riesgos',
				'artefacto.nombre:text:artefacto', 'creador0.username:text:Creador',
				'probador0.username:text:Probador',
				'desarrollador0.username:text:Desarrollador',
				array
				(
						'class'=>'CButtonColumn',
						'template'=>'{view}',
						'buttons'=>array
						(
								'view' => array
								(
										'url' =>'Yii::app()->createUrl("/cambiodeestado/".$data->id)',
								),

						),
				)
        ),
    ));
?>