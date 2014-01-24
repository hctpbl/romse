<?php
/* @var $this ArtefactoController */
/* @var $model Artefacto */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php /* echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); */?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uri'); ?>
		<?php echo $form->textField($model,'uri',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rol'); ?>
		<?php echo $form->textField($model,'rol',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php /*echo $form->label($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>60,'maxlength'=>200));*/ ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'version'); ?>
		<?php echo $form->textField($model,'version',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
			<?php echo $form->labelEx($model,'proyecto_id'); ?>
			<?php //echo $form->textField($model,'depende_de'); ?>
			<?php $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
				    'name'=>'proyecto_name',
					'value'=> '',
				    'sourceUrl'=>Yii::app()->createUrl('ajax/getProjects'),
				    'options'=>array(
				        'minLength'=>'2',
				        'type'=>'get',
				        'select'=>'js:function(event, ui) {
				            $("#selectedProyecto").text(ui.item.value);
				            $("#Artefacto_proyecto_id").val(ui.item.id);}'
					),
				));
			?>
			<span> Proyecto seleccionado: </span>
			<span id="selectedProyecto">Ninguno</span>
			<?php echo $form->hiddenField($model,'proyecto_id'); ?>
			<?php echo $form->error($model,'proyecto_id'); ?>
	</div>

	<div class="row">
		<?php /*echo $form->label($model,'depende_de'); ?>
		<?php echo $form->textField($model,'depende_de');*/ ?>
	</div>
	<!-- <div class="row">
			<?php /*echo $form->labelEx($model,'depende_de'); ?>
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
			<?php echo $form->hiddenField($model,'depende_de'); ?>
			<?php echo $form->error($model,'depende_de'); */?>
	</div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->