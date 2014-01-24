<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuario-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nss'); ?>
		<?php echo $form->textField($model,'nss',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'nss'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dni'); ?>
		<?php echo $form->textField($model,'dni',array('size'=>9,'maxlength'=>9)); ?>
		<?php echo $form->error($model,'dni'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'apellidos'); ?>
		<?php echo $form->textField($model,'apellidos',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'apellidos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_nacimiento'); ?>
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker',array(
						'attribute'=>'fecha_nacimiento',
						'model' => $model,
						'options'=>array(
							'dateFormat'=>'yy-mm-dd',
						)
		));
		?>
		<?php echo $form->error($model,'fecha_nacimiento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'numero_telefono'); ?>
		<?php echo $form->textField($model,'numero_telefono',array('size'=>13,'maxlength'=>13)); ?>
		<?php echo $form->error($model,'numero_telefono'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'salario'); ?>
		<?php echo $form->textField($model,'salario',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'salario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_incorporacion'); ?>
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker',array(
						'attribute'=>'fecha_incorporacion',
						'model' => $model,
						'options'=>array(
							'dateFormat'=>'yy-mm-dd',
						)
		));
		?>
		<?php echo $form->error($model,'fecha_incorporacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_baja'); ?>
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker',array(
						'attribute'=>'fecha_baja',
						'model' => $model,
						'options'=>array(
							'dateFormat'=>'yy-mm-dd',
						)
		));
		?>
		<?php echo $form->error($model,'fecha_baja'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rol_id'); ?>
		<?php 
			echo $form->dropDownList($model, 'rol_id', CHtml::listData(
		    	Rol::model()->findAll(array('select'=>'id, nombre')), 'id', 'nombre'),
				array(
					'default'=>'3',
			));
		?>
		<?php echo $form->error($model,'rol_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->