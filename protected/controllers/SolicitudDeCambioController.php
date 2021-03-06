<?php

class SolicitudDeCambioController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(

			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create'),
				'users'=>array(Yii::app()->user->name),
				'expression' => '(Yii::app()->user->rol_id!=\'ROL_ADMINISTRADOR\' || Yii::app()->user->rol_id!=\'ROL_CCC\')'
			),
			array('deny', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update'),
				'users'=>array(Yii::app()->user->name),
				'expression' => '(Yii::app()->user->rol_id!=\'ROL_ADMINISTRADOR\')'
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('adminCCC'),
				'users'=>array('ccc'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('searchForUsers'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$historyChanges = CambioDeEstadoController::getAllChangesFromIdSol($id);
				
		$this->render('view',array(
			'model'=>$this->loadModel($id),'historyChanges'=>$historyChanges,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new SolicitudDeCambio;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SolicitudDeCambio']))
		{
			$model->attributes=$_POST['SolicitudDeCambio'];
			if($model->save()) {
				$creacion = new CambioDeEstado();
				$creacion->solicitud_de_cambio_id = $model->id;
				$creacion->usuario_id = $model->creador;
				$creacion->fecha = new CDbExpression('NOW()');
				$creacion->estado_id = 0;
				$creacion->save();
				// Comprobamos si también hay que realizar el envío
				if($_POST['enviar'] == 1) {
					$envio = new CambioDeEstado();
					$envio->solicitud_de_cambio_id = $model->id;
					$envio->usuario_id = $model->creador;
					// Si creamos y enviamos a la vez, y como MySQL no tiene precisión
					// de milisegundos en jair, se crearán los dos cambios de estado
					// con la misma fecha y eso nos dará problemas. Como solución, añadimos
					// un segundo al cambio de estado de envío
					$envio->fecha = new CDbExpression('NOW()+1');
					$envio->estado_id = 1;
					$envio->save();
				}
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SolicitudDeCambio']))
		{
			$model->attributes=$_POST['SolicitudDeCambio'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{	
		// Primer se eliminan todos los cambios de estado de la solicitud
		CambioDeEstadoController::actionDeleteAllCambiosFromIdSol($id);
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('SolicitudDeCambio');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SolicitudDeCambio('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SolicitudDeCambio']))
			$model->attributes=$_GET['SolicitudDeCambio'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Manages all models for the CCC
	 */
	public function actionAdminCCC()
	{
		$model=new SolicitudDeCambio('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SolicitudDeCambio']))
			$model->attributes=$_GET['SolicitudDeCambio'];
	
		$this->render('adminCCC',array(
				'model'=>$model,
		));
	}
	
	/**
	 * Permite la búsqueda de sus solicitudes a los usuarios normales
	 */
	public function actionSearchForUsers()
	{
		$model=new SolicitudEstado('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SolicitudEstado']))
			$model->attributes=$_GET['SolicitudEstado'];
	
		$this->layout="column1";
		$this->render('searchForUsers',array(
				'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return SolicitudDeCambio the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=SolicitudDeCambio::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	/**
	 * Comprueba si un usuario es desarrollador en una solicitud
	 * @param int $solicitudId
	 * @return boolean
	 */
	public static function checkUserDeveloper($solicitudId){
		
		$model=SolicitudDeCambio::model()->find(array('condition'=>'id='.$solicitudId.' 
														AND desarrollador='.Yii::app()->user->id));
		if (!isset($model))
			return false;
		else 
			return true;
	}
	
	/**
	 * Comprueba si un usuario es creador en una solicitud
	 * @param int $solicitudId
	 * @return boolean
	 */
	public static function checkUserCreater($solicitudId){
	
		$model=SolicitudDeCambio::model()->find(array('condition'=>'id='.$solicitudId.'
														AND creador='.Yii::app()->user->id));
		if (!isset($model))
			return false;
		else
			return true;
	}
	
	/**
	 * Comprueba si un usuario es probador en una solicitud
	 * @param int $solicitudId
	 * @return boolean
	 */
	public static function checkUserTester($solicitudId){
	
		$model=SolicitudDeCambio::model()->find(array('condition'=>'id='.$solicitudId.'
														AND probador='.Yii::app()->user->id));
		if (!isset($model))
			return false;
		else
			return true;
	}
	
	/**
	 * Devuelve todas las solicitudes de cambio asociadas a un artefacto
	 * @param int $id
	 */
	public static function getAllChangesRequestFromArtifact($id)
	{
		$model = SolicitudDeCambio::model()->findAll(array('condition'=>'artefacto_id='.$id));
		return $model;
	}
	
	/**
	 * Devuelve el número de solicitudes de cambio enviadas
	 * @return int
	 */
	public static function getChangesRequestEnviado(){
		$enviado = SolicitudEstado::model()->findAll(array('condition'=>'nombre_estado=\'Enviado\' AND (MONTH(fecha_estado)=(MONTH(NOW())))'));
		$countEnviado = count($enviado);
		return $countEnviado;
	}
	
	/**
	 * Devuelve el número de solicitudes de cambio abiertas
	 * @return int
	 */
	public static function getChangesRequestAbierto(){
		$abierto = SolicitudEstado::model()->findAll(array('condition'=>'nombre_estado=\'Abierto\' AND (MONTH(fecha_estado)=(MONTH(NOW())))'));
		$countAbierto = count($abierto);
		return $countAbierto;
	}
	
	/**
	 * Devuelve el número de solicitudes de cambio verificadas
	 * @return int
	 */
	public static function getChangesRequestVerificado(){
		$verificado = SolicitudEstado::model()->findAll(array('condition'=>'nombre_estado=\'Verificado\' AND (MONTH(fecha_estado)=(MONTH(NOW())))'));
		$countVerificado = count($verificado);
		return $countVerificado;
	}
	
	/**
	 * Devuelve el número de solicitudes de cambio duplicadas/rechazadas
	 * @return int
	 */
	public static function getChangesRequestDupRech(){
		$dup_rech = SolicitudEstado::model()->findAll(array('condition'=>'nombre_estado=\'Duplicado/Rechazado\' AND (MONTH(fecha_estado)=(MONTH(NOW())))'));
		$countDup_rech = count($dup_rech);
		return $countDup_rech;
	}
	
	/**
	 * Devuelve el número de solicitudes de cambio actualizadas
 	 * @return int
	 */
	public static function getChangesRequestActualizada(){
		$actualizada = SolicitudEstado::model()->findAll(array('condition'=>'nombre_estado=\'Envío actualizado\' AND (MONTH(fecha_estado)=(MONTH(NOW())))'));
		$countActualizada = count($actualizada);
		return $countActualizada;
	}
	
	/**
	 * Devuelve el número de solicitudes de cambio cerradas
	 * @return int
	 */
	public static function getChangesRequestCerrado(){
		$cerrado = SolicitudEstado::model()->findAll(array('condition'=>'nombre_estado=\'Cerrado\' AND (MONTH(fecha_estado)=(MONTH(NOW())))'));
		$countCerrado = count($cerrado);
		return $countCerrado;
	}
	
	/**
	 * Se obtiene el número de solicitudes de cambio del mes hasta la fecha
	 * @return number
	 */
	public static function getChangesRequestThisMonth(){
		// Se establece la zona horaria
		//$timezone = date_default_timezone_get();
		//date_default_timezone_set($timezone);
		// Se obtiene la hora actual y los dias hasta el día 1
		//$actualDate = date('Y-m-d h:i:s', time());
		
		$changesByMonth = SolicitudEstado::model()->findAll(array('condition'=>'nombre_estado!=\'Creado\' 
																				AND (MONTH(fecha_estado)=(MONTH(NOW())) 
																				AND YEAR(fecha_estado) = YEAR (NOW()))'));
		$countChangesByMonth = count($changesByMonth);
		return $countChangesByMonth;
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param SolicitudDeCambio $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='solicitud-de-cambio-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
}
