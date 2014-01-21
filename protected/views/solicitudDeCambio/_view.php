<?php
/* @var $this SolicitudDeCambioController */
/* @var $data SolicitudDeCambio */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion_breve')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion_breve); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion_detallada')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion_detallada); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('impacto')); ?>:</b>
	<?php echo CHtml::encode($data->impacto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prioridad')); ?>:</b>
	<?php echo CHtml::encode($data->prioridad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('temporizacion')); ?>:</b>
	<?php echo CHtml::encode($data->temporizacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('riesgos')); ?>:</b>
	<?php echo CHtml::encode($data->riesgos); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('artefacto_id')); ?>:</b>
	<?php echo CHtml::encode($data->artefacto_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creador')); ?>:</b>
	<?php echo CHtml::encode($data->creador); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('probador')); ?>:</b>
	<?php echo CHtml::encode($data->probador); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desarrollador')); ?>:</b>
	<?php echo CHtml::encode($data->desarrollador); ?>
	<br />

	*/ ?>

</div>