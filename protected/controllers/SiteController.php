<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		// $this->render('index');
		// La página inicial debe ser el login si no está registrado
		if (!Yii::app()->user->isGuest)
			$this->render('index');
		else
			$this->redirect(array('/site/login'));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
	
	/**
	 * Muestra la lista de cambios del usuario
	 */
	public function actionShowUserListChanges()
	{
		$modelChangesClosed = SolicitudDeCambio::model()->findAll(array(
				'select'=>'*',
				'alias'=>'sc',
				'with'=>'creador0',
				'condition'=>'sc.id IN (SELECT solicitud_de_cambio_id
										FROM cambio_de_estado, estado
										WHERE estado_id = id
										AND nombre = \'Cerrado\')
										AND sc.creador='.Yii::app()->user->id));
		
		$modelChangesPending = SolicitudDeCambio::model()->findAll(array(
				'select'=>'*',
				'alias'=>'sc',
				'with'=>'creador0',
				'condition'=>'sc.id NOT IN (SELECT solicitud_de_cambio_id
										FROM cambio_de_estado, estado
										WHERE estado_id = id
										AND nombre = \'Cerrado\')
										AND sc.creador='.Yii::app()->user->id));
		
		$this->render('showUserListChanges', array('modelChangesClosed'=>$modelChangesClosed, 'modelChangesPending'=>$modelChangesPending));
	}
	
	/**
	 * Muestra la lista de proyectos del usuario
	 */
	public function actionShowUserListProjects()
	{
		$this->render('showUserListProjects');
	}
	
	/**
	 * Muestra la lista de solicitudes de cambio pendientes al ccc
	 */
	public function actionShowCccListChangesPending()
	{
		$modelChangesPending = SolicitudDeCambio::model()->findAll(array(
				'select'=>'*',
				'condition'=>'id NOT IN (SELECT solicitud_de_cambio_id
										FROM cambio_de_estado, estado
										WHERE estado_id = id
										AND nombre = \'Cerrado\')'));
		$this->render('showCccListChangesPending', array('modelChangesPending'=>$modelChangesPending));
	}
	
	/**
	 * Muestra la lista de solicitudes de cambio cerradas al ccc
	 */
	public function actionShowCccListChangesClosed()
	{
		$modelChangesClosed = SolicitudDeCambio::model()->with(array('cambioDeEstados'=>array('alias'=>'cambioEstados', 'with'=>array('estado'=>array('condition'=>'estado.nombre=\'Cerrado\''))),))->findAll();
		$this->render('showCccListChangesClosed', array('modelChangesClosed'=>$modelChangesClosed));
	}
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
