<?php
/* @var $this ArtefactoController */
/* @var $model Artefacto */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'artefacto-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uri'); ?>
		<?php echo $form->textField($model,'uri',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'uri'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rol'); ?>
		<?php echo $form->textField($model,'rol',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'rol'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'version'); ?>
		<?php echo $form->textField($model,'version',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'version'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'proyecto_id'); ?>
		<?php echo $form->textField($model,'proyecto_id'); ?>
		<?php echo $form->error($model,'proyecto_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'depende_de'); ?>
		<?php echo $form->textField($model,'depende_de'); ?>
		<?php echo $form->error($model,'depende_de'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->