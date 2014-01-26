<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->username,
);

if (Yii::app()->user->rol_id == 1):
$this->menu=array(
	array('label'=>'Listar Usuarios', 'url'=>array('index')),
	array('label'=>'Crear Usuario', 'url'=>array('create')),
	array('label'=>'Actualizar Usuario', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Borrar Usuario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Gestionar Usuarios', 'url'=>array('admin')),
);
endif;
?>

<h1>Ver Usuario: <?php echo $model->username; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nss',
		'dni',
		'nombre',
		'apellidos',
		'fecha_nacimiento',
		'email',
		'numero_telefono',
		'salario',
		'fecha_incorporacion',
		array(
			'label' => 'Fecha Baja',
			'visible'=> isset($model->fecha_baja),
			'value' => $model->fecha_baja, 'type' => 'raw'
		),
		'username',
		'rol.nombre:text:Rol',
	),
)); ?>
