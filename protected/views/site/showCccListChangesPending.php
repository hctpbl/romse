<?php
/* @var $this SiteController */
/* @var $modelChangesPending SolicitudDeCambio */

$this->pageTitle=Yii::app()->name. ' - Solicitudes de cambio pendientes';
$this->breadcrumbs=array(
	'Solicitudes de cambio pendientes',
);
?>

<h3>Lista de cambios pendientes</h3>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => new CArrayDataProvider($modelChangesPending),
        'columns' => array(
				'descripcion_breve:text:Desc. Breve', 
        		//'descripcion_detallada:text:Desc. Detalle',
				'nombre_estado:text:Estado',
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
        								'url' =>'Yii::app()->createUrl("cambioDeEstado/view",array("id"=>$data->id))',
        						),
        		
        				),
        		)
        ),
    ));

?>