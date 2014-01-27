<?php 

/* @var $this Controller */ 
define("ROL_ADMINISTRADOR", 1); 
define("ROL_CCC", 2);
define("ROL_DESARROLLADOR", 3); 
define("ROL_USUARIO_FINAL", 4);
?>
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
<?php
$this->widget('ext.google-analytics.EGoogleAnalytics', array(
	'account' => 'UA-47499522-1',
	'clientInfo' => true,
	'detectFlash' => true,
	'detectTitle' => true,
));
?>
<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<!-- <div id="mainmenu"> -->
		<?php
			$admin = (!Yii::app()->user->isGuest and Yii::app()->user->rol_id == ROL_ADMINISTRADOR) ? true : false;
			$developer = (!Yii::app()->user->isGuest and Yii::app()->user->rol_id == ROL_DESARROLLADOR) ? true : false;
			$ccc = (!Yii::app()->user->isGuest and Yii::app()->user->rol_id == ROL_CCC) ? true : false;
			$finalUser = (!Yii::app()->user->isGuest and Yii::app()->user->rol_id == ROL_USUARIO_FINAL) ? true : false;
			
			/*$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				// Opciones para administrador
				array('label'=>'Inicio', 'url'=>array('/site/profileAdmin'), 'visible'=>$admin),
				array('label'=>'Usuarios', 'url'=>array('/usuario'), 'visible'=>$admin),
				array('label'=>'Artefactos', 'url'=>array('/artefacto'), 'visible'=>$admin),
				array('label'=>'Proyectos', 'url'=>array('/proyecto'), 'visible'=>$admin),
				// Opciones para usuarios desarrolladores y finales
				array('label'=>'Mis solicitudes de cambio', 'url'=>array('/site/showUserListChanges'), 'visible'=>($developer || $finalUser)),
				//array('label'=>'Mi perfil', 'url'=>array('/site/index'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Mi perfil', 'url'=>array('/site/profile'), 'visible'=>($developer || $finalUser)),
				// Opciones para ccc
				array('label'=>'Solicitudes pendientes', 'url'=>array('/site/showCccListChangesPending'), 'visible'=>$ccc),
				array('label'=>'Solicitudes cerradas', 'url'=>array('/site/showCccListChangesClosed'), 'visible'=>$ccc),
				array('label'=>'Informes', 'url'=>array('/site/reports'), 'visible'=>$ccc, 'items'=>array(
					array('label'=>'Solicitudes de cambio', 'url'=>array('solicitudDeCambio/adminCCC'), 'visible'=>$ccc),
					array('label'=>'Proyectos', 'url'=>array('proyecto/adminCCC'), 'visible'=>$ccc),
					array('label'=>'Artefactos', 'url'=>array('artefacto/adminCCC'), 'visible'=>$ccc),
				)),
				// Opciones comunes
				array('label'=>'Inicio', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Sobre nosotros', 'url'=>array('/site/page', 'view'=>'about'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Contacto', 'url'=>array('/site/contact'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); */?>
	<!-- </div> --><!-- mainmenu -->
	<div id="eflatmenu">
	<?php 
	$this->widget('application.extensions.eflatmenu.EFlatMenu', array(
			'items' => array(
				// Opciones para administrador
				array('label'=>'Inicio', 'url'=>array('site/profileAdmin'), 'visible'=>$admin),
				array('label'=>'Usuarios', 'url'=>array('usuario/index'), 'visible'=>$admin),
				array('label'=>'Artefactos', 'url'=>array('artefacto/index'), 'visible'=>$admin),
				array('label'=>'Proyectos', 'url'=>array('proyecto/index'), 'visible'=>$admin),
				// Opciones para usuarios desarrolladores y finales
				array('label'=>'Mis solicitudes de cambio', 'url'=>array('site/showUserListChanges'), 'visible'=>($developer || $finalUser)),
				//array('label'=>'Mi perfil', 'url'=>array('/site/index'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Mi perfil', 'url'=>array('site/profile'), 'visible'=>($developer || $finalUser)),
				// Opciones para ccc
				array('label'=>'Solicitudes pendientes', 'url'=>array('site/showCccListChangesPending'), 'visible'=>$ccc),
				array('label'=>'Solicitudes cerradas', 'url'=>array('site/showCccListChangesClosed'), 'visible'=>$ccc),
				array('label'=>'Informes', 'url'=>array('site/reports'), 'visible'=>$ccc, 'items'=>array(
					array('label'=>'Información estadística', 'url'=>array('site/reports'), 'visible'=>$ccc),
					array('label'=>'Solicitudes de cambio', 'url'=>array('solicitudDeCambio/adminCCC'), 'visible'=>$ccc),
					array('label'=>'Proyectos', 'url'=>array('proyecto/adminCCC'), 'visible'=>$ccc),
					array('label'=>'Artefactos', 'url'=>array('artefacto/adminCCC'), 'visible'=>$ccc),
				)),
				// Opciones comunes
				array('label'=>'Inicio', 'url'=>array('site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Sobre nosotros', 'url'=>array('site/page', 'view'=>'about'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Contacto', 'url'=>array('site/contact'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			)
	));
	?>
	</div>
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'homeLink' =>CHtml::link('ROMSE', array('/site/index')),
			'links'=>$this->breadcrumbs,
			'links'=>false,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> José Martín Gago, Hector Pablos López, David Polvorosa Hoyos y Natalia Román Seneque.<br/>
		Grupo 01.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
