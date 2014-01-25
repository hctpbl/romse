<?php
/* @var $this SiteController */


$this->pageTitle=Yii::app()->name. ' - Mis solicitudes de cambio';
$this->breadcrumbs=array(
	'Mis solicitudes de cambio',
);
?>

<h3>Solicitudes creadas por mi en trámite</h3>
<p><?php echo CHtml::button('Crear nueva solicitud de cambio', array('submit' => '?r=solicitudDeCambio/create')); ?></p>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider' => new CArrayDataProvider($modelChangesCreator),
		'columns' => array(
				'descripcion_breve:text:Desc. Breve', 
				'descripcion_detallada:text:Desc. Detalle',
				'nombre_estado:text:Estado',
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
				'descripcion_breve:text:Desc. Breve', 
				'descripcion_detallada:text:Desc. Detalle',
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
									'url' =>'Yii::app()->createUrl("/cambioDeEstado/view/",array("id"=>$data->id))',
							),
						),
				)

		),
));
?>
<?php if (Yii::app()->user->rol_id != 4):?>
<h3>Solicitudes en las que soy desarrollador</h3>
<?php 

$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider' => new CArrayDataProvider($modelChangesDeveloper),
		'columns' => array(
				'descripcion_breve:text:Desc. Breve', 
				'descripcion_detallada:text:Desc. Detalle',
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
endif;
?>

<p><?php echo CHtml::button('Crear nueva solicitud de cambio', array('submit' => '?r=solicitudDeCambio/create')); ?></p>
