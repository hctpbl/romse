<?php
/* @var $this CambioDeEstadoController */
/* @var $model SolicitudDeCambio */
/* @var $cambio CambioDeEstado */

$this->breadcrumbs=array(
	'Lista de solicitud de cambio'=>Yii::app()->request->urlReferrer,
	$model->id,
);
?>
<h1>Cambiar el estado de la Solicitud de cambio <?php /*echo $model->id; */?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'descripcion_breve',
		'descripcion_detallada',
		//'fecha_creacion',
		'impacto',
		'prioridad',
		'temporizacion',
		'riesgos',
		array(
			'label' => 'Artefacto',
			'value' => CHtml::link(CHtml::encode(
				$model->artefacto->nombre),
				array('artefacto/view','id'=>$model->artefacto_id)), 'type' => 'raw'
		),
		array(
			'label' => 'Creador',
			'value' => CHtml::link(CHtml::encode(
				$model->creador0->username),
				array('usuario/viewResumen','id'=>$model->creador)), 'type' => 'raw'
		),
		array(
			'label' => 'Probador',
			'value' => CHtml::link(CHtml::encode(
				$model->probador0->username),
				array('usuario/viewResumen','id'=>$model->probador)), 'type' => 'raw'
		),
		array(
			'label' => 'Desarrollador',
			'value' => CHtml::link(CHtml::encode(
				$model->desarrollador0->username),
				array('usuario/viewResumen','id'=>$model->desarrollador)), 'type' => 'raw'
		),
	),
)); ?>
<br />
<br />
<br />
<?php $estado_act=0; ?>
<?php if (isset($cambio->estado)) :?>
<h1>Estado actual: <?php echo $cambio->estado->nombre; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$cambio,
	'attributes'=>array(
		array(
			'label' => 'Cambio hecho por',
			'value' => CHtml::link(CHtml::encode(
				$model->creador0->username),
				array('usuario/viewResumen','id'=>$model->creador)), 'type' => 'raw'
		),
		'fecha',
	),
)); ?>
<?php $estado_act=$cambio->estado->id; ?>
<?php else: ?>
<h1>Estado actual: Creado</h1>
<?php endif; ?>
<br />
<br />
<br />

<?php 

?>

<?php if ($this->checkUser($cambio->estado->nombre, $model->id)) :?>
<h2>Seleccione nuevo estado:</h2>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'solicitud-de-cambio-form',
	/*'enableClientValidation'=>true,
	'clientOptions' => array('validateOnSubmit'=>true),*/
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<?php 
	echo CHtml::dropDownList('nuevo_estado', '', CHtml::listData(
    	$this->loadEstadosSiguientes($estado_act),
		'estado_hijo_id', 'estadoHijo.nombre'),
		array(
			'empty'=>'',
			'onChange'=>'js:$(".additional_forms").hide();$("#additional_form_"+this.value).show();
						if(this.value=="") $("#btnCambioEstado").hide();
							else  $("#btnCambioEstado").show();',
			'options'=>array($estadoACambiar=>array('selected'=>true)),
			/*'ajax' => array(
					'type'=>'GET',
					'url'=>Yii::app()->createUrl('cambiodeestado/setScenario'),
					'data'=>array('estado_id'=>'js:this.value'),
	)*/));
?>
	<?php echo $form->errorSummary($model); ?>
	<div id="additional_form_2" class="additional_forms" <?php if ($estadoACambiar != 2) : ?>hidden<?php endif;?>>
	
		<div class="row">
			<?php echo $form->labelEx($model,'prioridad'); ?>
			<?php echo $form->textField($model,'prioridad',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'prioridad'); ?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'temporizacion'); ?>
			<?php echo $form->textField($model,'temporizacion',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'temporizacion'); ?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'riesgos'); ?>
			<?php echo $form->textField($model,'riesgos',array('size'=>50,'maxlength'=>50)); ?>
			<?php echo $form->error($model,'riesgos'); ?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'impacto'); ?>
			<?php echo $form->textField($model,'impacto',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'impacto'); ?>
		</div>
	
	</div>

	<div id="additional_form_3" class="additional_forms" <?php if ($estadoACambiar != 3) : ?>hidden<?php endif; ?>>

		<div class="row">
			<?php echo $form->labelEx($model,'probador'); ?>
			<?php //echo $form->textField($model,'depende_de'); ?>
			<?php $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
				    'name'=>'probador_name',
					'value'=> '',
				    'sourceUrl'=>Yii::app()->createUrl('ajax/getDevUsers'),
				    'options'=>array(
				        'minLength'=>'2',
				        'type'=>'get',
				        'select'=>'js:function(event, ui) {
				            $("#selectedProbador").text(ui.item.value);
				            $("#SolicitudDeCambio_probador").val(ui.item.id);}'
					),
				));
			?>
			<span> Probador seleccionado: </span>
			<span id="selectedProbador">Ninguno</span>
			<?php echo $form->hiddenField($model,'probador'); ?>
			<?php echo $form->error($model,'probador'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'desarrollador'); ?>
			<?php //echo $form->textField($model,'depende_de'); ?>
			<?php $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
				    'name'=>'desarrollador_name',
					'value'=> '',
				    'sourceUrl'=>Yii::app()->createUrl('ajax/getDevUsers'),
				    'options'=>array(
				        'minLength'=>'2',
				        'type'=>'get',
				        'select'=>'js:function(event, ui) {
				            $("#selectedDesarrollador").text(ui.item.value);
				            $("#SolicitudDeCambio_desarrollador").val(ui.item.id);}'
					),
				));
			?>
			<span> Desarrollador seleccionado: </span>
			<span id="selectedDesarrollador">Ninguno</span>
			<?php echo $form->hiddenField($model,'desarrollador'); ?>
			<?php echo $form->error($model,'desarrollador'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'artefacto_id'); ?>
			<?php //echo $form->textField($model,'depende_de'); ?>
			<?php $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
				    'name'=>'artefacto_name',
					'value'=> '',
				    'sourceUrl'=>Yii::app()->createUrl('ajax/getArtifacts'),
				    'options'=>array(
				        'minLength'=>'2',
				        'type'=>'get',
				        'select'=>'js:function(event, ui) {
				            $("#selectedArtifact").text(ui.item.value);
				            $("#SolicitudDeCambio_artefacto_id").val(ui.item.id);}'
					),
				));
			?>
			<span> Artefacto seleccionado: </span>
			<span id="selectedArtifact">Ninguno</span>
			<?php echo $form->hiddenField($model,'artefacto_id'); ?>
			<?php echo $form->error($model,'artefacto_id'); ?>
		</div>
	
	</div>

	<div id="additional_form_9" class="additional_forms" <?php if ($estadoACambiar != 9) : ?>hidden<?php endif; ?>>

		<div class="row">
			<?php echo $form->labelEx($model,'descripcion_breve'); ?>
			<?php echo $form->textField($model,'descripcion_breve',array('size'=>60,'maxlength'=>100)); ?>
			<?php echo $form->error($model,'descripcion_breve'); ?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'descripcion_detallada'); ?>
			<?php echo $form->textField($model,'descripcion_detallada',array('size'=>60,'maxlength'=>1000)); ?>
			<?php echo $form->error($model,'descripcion_detallada'); ?>
		</div>
	
	</div>
	
	<?php if(isset($model->artefacto)) :?>

	<div id="additional_form_10" class="additional_forms" hidden>

		<div class="row">
			<span>Va cerrar un cambio sobre el artefacto: <?php echo $model->artefacto->nombre?></span>
			<br/>
			<span>Cuya versión actual es:  <?php echo $model->artefacto->version?></span>
			<br />
			<?php echo CHtml::label('Nueva versión del artefacto', 'version'); ?>
			<?php echo CHtml::activeTextField($model->artefacto, 'version'); ?>
		</div>
	
	</div>
	
	<?php endif; ?>
	
	<div class="row buttons" id="btnCambioEstado" <?php if (!isset($estadoACambiar)) : ?>hidden<?php endif; ?>>
		<?php echo CHtml::submitButton('Cambiar estado'); ?>
	</div>

<?php $this->endWidget(); ?>
<?php endif; ?>

</div><!-- form -->