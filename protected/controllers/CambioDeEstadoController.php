<?php

class CambioDeEstadoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * Permite cambiar el estado de la solicitud dada
	 * @param integer $id ID de la solicitud cuyo estado se ha de cambiar
	 */
	public function actionView($id)
	{
		$solicitud = $this->loadSolicitudDeCambio($id);
		$cambioDeEstado = $this->loadCambioDeEstadoActual($solicitud);

		if(isset($_POST['SolicitudDeCambio']))
		{
			$solicitud->attributes=$_POST['SolicitudDeCambio'];
			if($solicitud->save()) {
				$cambio = new CambioDeEstado();
				$cambio->solicitud_de_cambio_id = $solicitud->id;
				$cambio->usuario_id = Yii::app()->user->id;
				$cambio->estado_id = $_POST['nuevo_estado'];
				$cambio->save();
				$this->redirect(array('view','id'=>$solicitud->id));
			}
		}
		
		$this->render('index',array(
			'model'=>$solicitud,
			'cambio'=>$cambioDeEstado,
			'form'=>"",
		));
	}
	
	public function loadSolicitudDeCambio($id) {
		$model = SolicitudDeCambio::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404, 'The requested page
            does not exist.');
		}
		return $model;
	}
	
	/**
	 * Para una solicitud de cambio dada, obtiene el último cambio de estado
	 * @param SolicitudDeCambio $id
	 */
	public function loadCambioDeEstadoActual($solicitudDeCambio) {
		$criteria = new CDbCriteria();
		$criteria->select = 'usuario_id, fecha, estado_id';
		$criteria->condition = 'solicitud_de_cambio_id=:solId';
		$criteria->params = array(':solId'=>$solicitudDeCambio->id,);
		$criteria->order = 'fecha DESC';
		$criteria->limit = 1;
		$cambioEstado = CambioDeEstado::model()->find($criteria);
		return $cambioEstado;
	}
	
	/**
	 * Para una solicitud de cambio dada, obtiene el último cambio de estado
	 * @param Estado $id
	 */
	public function loadEstadosSiguientes($estadoId) {
		$crit = new CDbCriteria();
		$crit->select = 'estado_hijo_id, estado_padre_id';
		$crit->with = 'estadoHijo';
		$crit->condition = 'estado_padre_id=:estId';
		$crit->params = array(':estId'=>$estadoId,);
		$estadosHijos = Precede::model()->findAll(
				$crit,
				array(':estID'=>$estadoId)
		);
		return $estadosHijos;
	}
	
	/**
	 * Se comprueba si el usuario puede realizar algún cambio
	 * según el estado en el que está
	 */
	public function checkUser($estadoId, $solicitudId){
		switch ($estadoId){
		case 1:
			if (Yii::app()->user->rol_id == 2){
				return true;
			}
			break;
		case 2:
			if (Yii::app()->user->rol_id == 2){
				return true;
			}
			break;
		case 3:
			if (Yii::app()->user->rol_id == 3 && SolicitudDeCambioController::checkUserDeveloper($solicitudId)){
				return true;
			}
			break;
		case 4:
			if ((Yii::app()->user->rol_id == 3 || Yii::app()->user->rol_id == 4) && SolicitudDeCambioController::checkUserTester($solicitudId)){
				return true;
			}
			break;
		case 5:
			if (Yii::app()->user->rol_id == 2){
				return true;
			}
			break;
		case 6:
			if (Yii::app()->user->rol_id == 3 && SolicitudDeCambioController::checkUserDeveloper($solicitudId)){
				return true;
			}
			break;
		case 7:
			if (Yii::app()->user->rol_id == 2){
				return true;
			}
			break;
		case 8:
			if ((Yii::app()->user->rol_id == 3 || Yii::app()->user->rol_id == 4) && SolicitudDeCambioController::checkUserCreater($solicitudId)){
				return true;
			}
			break;
		case 9:
			if (Yii::app()->user->rol_id == 2){
				return true;
			}
			break;
		case 10:
			if (Yii::app()->user->rol_id == 2){
				return true;
			}
			break;
		default:
			if ((Yii::app()->user->rol_id == 3 || Yii::app()->user->rol_id == 4) && SolicitudDeCambioController::checkUserCreater($solicitudId)){
				return true;
			}
		}
		
	}
	
	/**
	 * Devuelve todos los estados hijos dado un padre
	 * @param unknown $padre
	 * @return unknown
	 */
	/*public function getChildren($padre) {
		$crit = new CDbCriteria();
		$crit->select = 'estado_hijo_id';
		$crit->condition = 'estado_padre_id=:estId';
		$crit->params = array(':estId'=>$padre->id,);
		$estadosHijo = this::model()->findAll($crit);
		return $estadosHijos;
		
	}*/
	
	/**
	 * Borra todos los cambios de estado que tienen que ver
	 * con una solicitud de cambio
	 * @param IdSolicitud $id Identificador de la solicitud de cambio
	 */
	public static function actionDeleteAllCambiosFromIdSol($id){
		
		CambioDeEstado::model()->deleteAll(array('condition'=>'solicitud_de_cambio_id='.$id));
	}
	
	/**
	 * Dado un estado, genera el formulario que pide los datos
	 * adicionales para pasar a él (si es que fueran necesarios)
	 */
	/*public function actionAdditionalStateData() {
		$estado_id = $_GET['estado_id'];
		$model = new SolicitudDeCambio();
		$campos=array();
		$form="";
		switch ($estado_id) {
			case "2":
				$campos['elements'] = array(
					'prioridad' => array(
						'type' => 'text',
						'maxlength' => '10'
					),
					'temporizacion' => array(
						'type' => 'text',
						'maxlength' => '10'
					),
					'riesgos' => array(
						'type' => 'text',
						'maxlength' => '50'
					),
					'impacto' => array(
						'type' => 'text',
						'maxlength' => '10'
					),
				);
				break;
		}
		$campos['buttons'] = array(
			'submit' => array(
				'type' => 'submit',
				'label' => 'Cambiar estado'
			),
		);
		if ($estado_id != "") {
			$form = new CForm($campos,$model);
			//$form->action = CHtml::normalizeUrl("index");
		}
		$this->renderPartial('_ajaxContent', array(
			'form'=>$form,
		), false, true);
		Yii::app()->end();
	}*/
	
}
