<?php
/* @var $this UsuarioController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle=Yii::app()->name. ' - Mi Perfil';
$this->breadcrumbs=array(
	'Mi Perfil',
);
?>

<!--<h1>Welcome to <i></*?php echo CHtml::encode(Yii::app()->name); */?></i></h1>

<p>Congratulations! You have successfully created your Yii application.</p>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <code></*?php echo __FILE__; ?*/></code></li>
	<li>Layout file: <code></*?php echo $this->getLayoutFile('main'); ?*/></code></li>
</ul>

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>-->

<h1>Bienvenido <?php echo CHtml::encode(Yii::app()->user->name); ?> </h1>
<br />

<p><?php
$url=Yii::app()->createUrl('usuario');
echo "<a href='".$url."' >Gestión de usuarios</a>" ?></p>

<p><?php
$url=Yii::app()->createUrl('artefacto');
echo "<a href='".$url."' >Gestión de artefactos</a>" ?></p>

<p><?php
$url=Yii::app()->createUrl('proyecto');
echo "<a href='".$url."' >Gestión de proyectos</a>" ?></p>
