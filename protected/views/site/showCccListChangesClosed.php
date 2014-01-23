<?php
/* @var $this SiteController */
/* @var $modelChangesClosed SolicitudDeCambio */

$this->pageTitle=Yii::app()->name. ' - Lista de solicitudes de cambio cerradas';
$this->breadcrumbs=array(
	'Lista de solicitudes de cambio cerradas',
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
				'artefacto:text:artefacto', 'creador:text:Creador',
				'probador:text:Probador', 'desarrollador:text:Desarrollador', 'nombre_estado:text:Estado',
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