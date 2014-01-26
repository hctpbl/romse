<?php
/* @var $this SiteController */
/* @var $modelChangesClosed SolicitudDeCambio */

$this->pageTitle=Yii::app()->name. ' - Solicitudes de cambio cerradas';
$this->breadcrumbs=array(
	'Solicitudes de cambio cerradas',
);
?>

<h3>Lista de cambios cerrados</h3>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => new CArrayDataProvider($modelChangesClosed),
        'columns' => array(
				'descripcion_breve:text:Desc. Breve', 
        		//'descripcion_detallada:text:Desc. Detalle',
				array
				(
						'class'=>'CButtonColumn',
						'template'=>'{view}',
						'buttons'=>array
						(
								'view' => array
								(
										'url' =>'Yii::app()->createUrl("solicitudDeCambio/view", array("id"=>$data->id))',
								),
						),
				)
        ),
    ));
?>