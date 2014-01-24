<?php
/* @var $this SiteController */
/* @var $modelChangesClosed SolicitudDeCambio */
/* @var $modelChangesCreator SolicitudDeCambio */
/* @var $modelChangesTester SolicitudDeCambio */
/* @var $modelChangesDeveloper SolicitudDeCambio */
/* @var $modelCheckChange CambioDeEstadoController */


$this->pageTitle=Yii::app()->name. ' - Lista de solicitudes de cambio';
$this->breadcrumbs=array(
	'Lista de solicitudes de cambio',
);
?>

<h3>Solicitudes creadas por mi en trámite</h3>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider' => new CArrayDataProvider($modelChangesCreator),
		'columns' => array(
				/*'id',*/ 'descripcion_breve:text:Desc. Breve', 'descripcion_detallada:text:Desc. Detalle',
				/*'impacto:text:Impacto', 'prioridad:text:Prioridad', 'temporizacion:text:Temporizacion',
				'riesgos:text:Riesgos',
				'artefacto:text:artefacto', 'creador:text:Creador',
				'probador:text:Probador', 'desarrollador:text:Desarrollador',*/ 'nombre_estado:text:Estado',
				array
				(
						'class'=>'CButtonColumn',
						'template'=>'{view}',
						'buttons'=>array
						(
								'view' => array
								(
										'url' =>'Yii::app()->createUrl("/solicitudDeCambio/view",array("id"=>$data->id))',
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
										'url' =>'Yii::app()->createUrl("/cambioDeEstado/view",array("id"=>$data->id))',
								),
				
						),
				),
				array
				(
						'class'=>'CButtonColumn',
						'template'=>'{delete}',
						'buttons'=>array
						(
								'delete' => array
								(
										'visible'=>'SolicitudDeCambioController::checkUserCreater($data->id) && $data->nombre_estado==\'Creado\'',
										//'visible'=>'($data->nombre_estado=="Creado")',
										'url' =>'Yii::app()->createUrl("solicitudDeCambio/delete", array("id"=>$data->id))',
								),
				
						),
				)
		),
));
?>

<h3>Solicitudes en las que soy probador</h3>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider' => new CArrayDataProvider($modelChangesTester),
		'columns' => array(
				/*'id',*/ 'descripcion_breve:text:Desc. Breve', 'descripcion_detallada:text:Desc. Detalle',
				/*'impacto:text:Impacto', 'prioridad:text:Prioridad', 'temporizacion:text:Temporizacion',
				'riesgos:text:Riesgos',
				'artefacto:text:artefacto', 'creador:text:Creador',
				'probador:text:Probador', 'desarrollador:text:Desarrollador',*/ 'nombre_estado:text:Estado',
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
									'url' =>'Yii::app()->createUrl("/cambioDeEstado/view/",array("id"=>$data->id))',
							),

						),
				)

		),
));
?>
<h3>Solicitudes en las que soy desarrollador</h3>
<?php 

$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider' => new CArrayDataProvider($modelChangesDeveloper),
		'columns' => array(
				/*'id',*/ 'descripcion_breve:text:Desc. Breve', 'descripcion_detallada:text:Desc. Detalle',
				/*'impacto:text:Impacto', 'prioridad:text:Prioridad', 'temporizacion:text:Temporizacion',
				'riesgos:text:Riesgos',
				'artefacto:text:artefacto', 'creador:text:Creador',
				'probador:text:Probador', 'desarrollador:text:Desarrollador',*/ 'nombre_estado:text:Estado',
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

<h3>Solicitudes de cambio cerradas (SE QUITARÁ EN PRINCIPIO)</h3>
<?php 

$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider' => new CArrayDataProvider($modelChangesClosed),
		'columns' => array(
				/*'id',*/ 'descripcion_breve:text:Desc. Breve', 'descripcion_detallada:text:Desc. Detalle',
				/*'impacto:text:Impacto', 'prioridad:text:Prioridad', 'temporizacion:text:Temporizacion',
				'riesgos:text:Riesgos',
				'artefacto:text:artefacto', 'creador:text:Creador',
				'probador:text:Probador', 'desarrollador:text:Desarrollador', 'nombre_estado:text:Estado',*/
				array
				(
						'class'=>'CButtonColumn',
						'template'=>'{view}',
						'buttons'=>array
						(
								'view' => array
								(
										'url' =>'Yii::app()->createUrl("cambioDeEstado/",array("id"=>$data->id))',
								),

						),
				)
		),
));
?>
<p><?php echo CHtml::button('Crear nueva solicitud de cambio', array('submit' => '?r=solicitudDeCambio/create')); ?></p>
