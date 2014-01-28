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

	 <!-- <div class="row">
		<?php /* echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); */?>
	 </div>-->

	<div class="row">
		<?php echo $form->label($model,'descripcion_breve'); ?>
		<?php echo $form->textField($model,'descripcion_breve',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php /*echo $form->label($model,'descripcion_detallada'); ?>
		<?php echo $form->textField($model,'descripcion_detallada',array('size'=>60,'maxlength'=>1000)); */?>
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

	<!-- <div class="row">
		<?php /*echo $form->label($model,'artefacto_id'); ?>
		<?php echo $form->textField($model,'artefacto_id');*/ ?>
	</div>-->
	<?php 
		// Podemos tener modelo instancia de SolicitudDeCambio (para las búsquedas del CCC)
		// o instancia de SolicitudEstado (para las búsquedas de los usuarios).
		// Adaptamos los campos del formulario de búsqueda avanzada a esta circusntancia
		$campoArtefacto = '';
		$modeloForm = '';
		if ($model instanceof SolicitudDeCambio) {
			$campoArtefacto = 'artefacto_id';
			$campoCreador = 'creador';
			$campoDesarrollador = 'desarrollador';
			$campoProbador = 'probador';
			$modeloForm = 'SolicitudDeCambio';
		} else {
			$campoArtefacto = 'id_artefacto';
			$campoCreador = 'id_creador';
			$campoDesarrollador = 'id_desarrollador';
			$campoProbador = 'id_probador';
			$modeloForm = 'SolicitudEstado';
		}
	?>
	<div class="row">
			<?php echo $form->labelEx($model,$campoArtefacto); ?>
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
				            $("#'.$modeloForm.'_'.$campoArtefacto.'").val(ui.item.id);}'
					),
				));
			?>
			<span> Artefacto seleccionado: </span>
			<span id="selectedArtifact">Ninguno</span>
			<?php echo $form->hiddenField($model,$campoArtefacto); ?>
			<?php echo $form->error($model,$campoArtefacto); ?>
	</div>

	<!-- <div class="row">
		<?php /*echo $form->label($model,'creador'); ?>
		<?php echo $form->textField($model,'creador');*/ ?>
	</div>-->
	<div class="row">
			<?php echo $form->labelEx($model,$campoCreador); ?>
			<?php //echo $form->textField($model,'depende_de'); ?>
			<?php $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
				    'name'=>'creador_name',
					'value'=> '',
				    'sourceUrl'=>Yii::app()->createUrl('ajax/getDevUsers'),
				    'options'=>array(
				        'minLength'=>'2',
				        'type'=>'get',
				        'select'=>'js:function(event, ui) {
				            $("#selectedCreador").text(ui.item.value);
				            $("#'.$modeloForm.'_'.$campoCreador.'").val(ui.item.id);}'
					),
				));
			?>
			<span> Creador seleccionado: </span>
			<span id="selectedCreador">Ninguno</span>
			<?php echo $form->hiddenField($model,$campoCreador); ?>
			<?php echo $form->error($model,$campoCreador); ?>
		</div>

	<div class="row">
		<?php /*echo $form->label($model,'probador'); ?>
		<?php echo $form->textField($model,'probador'); */?>
	</div>
	<div class="row">
			<?php echo $form->labelEx($model,$campoProbador); ?>
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
				            $("#'.$modeloForm.'_'.$campoProbador.'").val(ui.item.id);}'
					),
				));
			?>
			<span> Probador seleccionado: </span>
			<span id="selectedProbador">Ninguno</span>
			<?php echo $form->hiddenField($model,$campoProbador); ?>
			<?php echo $form->error($model,$campoProbador); ?>
		</div>

	<!-- <div class="row">
		<?php /*echo $form->label($model,'desarrollador'); ?>
		<?php echo $form->textField($model,'desarrollador');*/ ?>
	</div>-->
	<div class="row">
			<?php echo $form->labelEx($model,$campoDesarrollador); ?>
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
				            $("#'.$modeloForm.'_'.$campoDesarrollador.'").val(ui.item.id);}'
					),
				));
			?>
			<span> Desarrollador seleccionado: </span>
			<span id="selectedDesarrollador">Ninguno</span>
			<?php echo $form->hiddenField($model,$campoDesarrollador); ?>
			<?php echo $form->error($model,$campoDesarrollador); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->