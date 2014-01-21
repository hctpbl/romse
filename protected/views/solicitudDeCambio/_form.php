<?php
/* @var $this SolicitudDeCambioController */
/* @var $model SolicitudDeCambio */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'solicitud-de-cambio-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

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

	<div class="row">
		<?php echo $form->labelEx($model,'impacto'); ?>
		<?php echo $form->textField($model,'impacto',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'impacto'); ?>
	</div>

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
		<?php echo $form->labelEx($model,'fecha_creacion'); ?>
		<?php echo $form->textField($model,'fecha_creacion'); ?>
		<?php echo $form->error($model,'fecha_creacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'artefacto_id'); ?>
		<?php echo $form->textField($model,'artefacto_id'); ?>
		<?php echo $form->error($model,'artefacto_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'creador'); ?>
		<?php echo $form->textField($model,'creador'); ?>
		<?php echo $form->error($model,'creador'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'probador'); ?>
		<?php echo $form->textField($model,'probador'); ?>
		<?php echo $form->error($model,'probador'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desarrollador'); ?>
		<?php echo $form->textField($model,'desarrollador'); ?>
		<?php echo $form->error($model,'desarrollador'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->