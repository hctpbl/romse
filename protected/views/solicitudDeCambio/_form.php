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

	<?php if($model->isNewRecord): ?>
	<p class="note">Tenga en cuenta que crear una Solicitud de cambio no la enviará automáticamente al
	CCC para su revisión. Si además quiere enviar la solicitud de cambio puede hacerlo ahora marcando la
	casilla correspondiente o más adelante, accediendo a sus solicitudes y cambiando el estado a enviada.</p>
	
	<label for="SolicitudDeCambio_enviar">¿Enviar?</label>
	￼<input type="hidden" name="enviar" value="0" checked>
	￼<input type="checkbox" name="enviar" value="1" checked>
	<?php endif; ?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->