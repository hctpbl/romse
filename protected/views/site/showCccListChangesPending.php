<?php
/* @var $this SiteController */
/* @var $modelChangesPending SolicitudDeCambio */

$this->pageTitle=Yii::app()->name. ' - Lista de solicitudes de cambio pendientes';
$this->breadcrumbs=array(
	'Lista de solicitudes de cambio pendientes',
);
?>

<h3>Lista de cambios pendientes</h3>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => new CArrayDataProvider($modelChangesPending),
        'columns' => array(
				'id', 'descripcion_breve:text:Desc. Breve', 'descripcion_detallada:text:Desc. Detalle',
				'impacto:text:Impacto', 'prioridad:text:Prioridad', 'temporizacion:text:Temporizacion',
				'riesgos:text:Riesgos',
				'artefacto:text:artefacto', 'creador:text:Creador',
				'probador:text:Probador', 'desarrollador:text:Desarrollador', 'nombre_estado:text:Estado',
				array
				(
						'class'=>'CButtonColumn',
						'template'=>'{view}',
						'buttons'=>array
						(
								'view' => array
								(
										'url' =>'Yii::app()->createUrl("/solicitudDeCambio/".$data->id)',
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
        								'url' =>'Yii::app()->createUrl("/cambiodeestado/".$data->id)',
        						),
        		
        				),
        		)
        ),
    ));

?>