<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

if (Yii::app()->user->rol_id == 'ROL_ADMINISTRADOR'){
	$this->menu=array(
		array('label'=>'Listar Usuarios', 'url'=>array('index')),
		array('label'=>'Crear Usuario', 'url'=>array('create')),
		array('label'=>'Ver Usuario', 'url'=>array('view', 'id'=>$model->id)),
		array('label'=>'Gestionar Usuarios', 'url'=>array('admin')),
	);
}
?>

<h1>Actualizar Usuario <?php echo $model->id; ?></h1>

<?php 
$this->renderPartial('_form', array('model'=>$model));
?>