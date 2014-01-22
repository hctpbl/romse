<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php
			//$admin = (isset(Yii::app()->user->name) and Yii::app()->user->name == 'Administrador') ? true : false ;
			$admin = (!Yii::app()->user->isGuest and Yii::app()->user->name == 'admin') ? true : false;
			$userCanCreateChange = (!Yii::app()->user->isGuest and Yii::app()->user->name != 'admin' and Yii::app()->user->name != 'ccc') ? true : false;
			$ccc = (!Yii::app()->user->isGuest and Yii::app()->user->name == 'ccc') ? true : false;
			$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				//array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'Inicio', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Mi perfil', 'url'=>array('/site/index'), 'visible'=>!Yii::app()->user->isGuest),
				// Opciones para administrador
				array('label'=>'Usuario', 'url'=>array('/usuario'), 'visible'=>$admin),
				array('label'=>'Proyectos', 'url'=>array('/proyecto'), 'visible'=>$admin),
				// Opciones para usuarios que pueden crear solicitudes
				array('label'=>'Mis solicitudes de cambio', 'url'=>array('/site/showListChanges'), 'visible'=>$userCanCreateChange),
				array('label'=>'Mis proyectos', 'url'=>array('/site/showListProjects'), 'visible'=>$userCanCreateChange),
				// Opciones para ccc
				array('label'=>'Solicitudes pendientes', 'url'=>array(''), 'visible'=>$ccc),
				array('label'=>'Solicitudes cerradas', 'url'=>array(''), 'visible'=>$ccc),

				array('label'=>'Sobre nosotros', 'url'=>array('/site/page', 'view'=>'about'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Contacto', 'url'=>array('/site/contact'), 'visible'=>Yii::app()->user->isGuest),
				//array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'homeLink' =>CHtml::link('ROMSE', array('/site/index')),
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
