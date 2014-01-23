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
										'url' =>'Yii::app()->createUrl("/cambiodeestado/".$data->id)',
								),

						),
				)
        ),
    ));

?>