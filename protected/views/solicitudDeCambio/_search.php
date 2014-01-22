<?php
/* @var $this SolicitudDeCambioController */
/* @var $model SolicitudDeCambio */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descripcion_breve'); ?>
		<?php echo $form->textField($model,'descripcion_breve',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descripcion_detallada'); ?>
		<?php echo $form->textField($model,'descripcion_detallada',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_creacion'); ?>
		<?php echo $form->textField($model,'fecha_creacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'impacto'); ?>
		<?php echo $form->textField($model,'impacto',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prioridad'); ?>
		<?php echo $form->textField($model,'prioridad',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'temporizacion'); ?>
		<?php echo $form->textField($model,'temporizacion',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'riesgos'); ?>
		<?php echo $form->textField($model,'riesgos',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'artefacto_id'); ?>
		<?php echo $form->textField($model,'artefacto_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'creador'); ?>
		<?php echo $form->textField($model,'creador'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'probador'); ?>
		<?php echo $form->textField($model,'probador'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desarrollador'); ?>
		<?php echo $form->textField($model,'desarrollador'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->