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
		$estadoACambiar = "";

		if(isset($_POST['SolicitudDeCambio']))
		{
			// Establecemos como escenario el apropiado para el estado, así
			// se aplicarán las reglas de validación pertinentes
			// (ver rules en la clase SolicitudDeCambio)
			$solicitud->scenario = 'cambioAEstado'.$_POST['nuevo_estado'];
			$solicitud->attributes=$_POST['SolicitudDeCambio'];
			if($solicitud->save()) {
				$cambio = new CambioDeEstado();
				$cambio->solicitud_de_cambio_id = $solicitud->id;
				$cambio->usuario_id = Yii::app()->user->id;
				$cambio->estado_id = $_POST['nuevo_estado'];
				$cambio->save();
				if (isset($_POST['version'])) {
					$artefacto = $solicitud->artefacto;
					$artefacto->version = $_POST['version'];
					$artefacto->save();
				}
				$this->redirect(array('view','id'=>$solicitud->id));
			} else {
				// Si no se ha podido guardar la solicitud es que no ha pasado
				// la validación. En ese caso, volveremos a la página de cambio
				// de estado pero estará seleccionado el estado que hemos elegido
				// y serán visibles los campos del formulario, es la única forma de
				// informar al usuari de qué errores ha cometido y dónde.
				$estadoACambiar = $_POST['nuevo_estado'];
			}
		}
		
		$this->render('index',array(
			'model'=>$solicitud,
			'cambio'=>$cambioDeEstado,
			'estadoACambiar'=>$estadoACambiar
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
	public static function checkUser($estadoId, $solicitudId){
		switch ($estadoId){
		case 'Creado':
			if ((Yii::app()->user->rol_id == 3 || Yii::app()->user->rol_id == 4) && SolicitudDeCambioController::checkUserCreater($solicitudId)){
				return true;
			}
			break; 
		case 'Enviado':
			if (Yii::app()->user->rol_id == 2){
				return true;
			}
			break;
		case 'Abierto':
			if (Yii::app()->user->rol_id == 2){
				return true;
			}
			break;
		case 'Asignado':
			if (Yii::app()->user->rol_id == 3 && SolicitudDeCambioController::checkUserDeveloper($solicitudId)){
				return true;
			}
			break;
		case 'Resuelto':
			if ((Yii::app()->user->rol_id == 3 || Yii::app()->user->rol_id == 4) && SolicitudDeCambioController::checkUserTester($solicitudId)){
				return true;
			}
			break;
		case 'Verificado':
			if (Yii::app()->user->rol_id == 2){
				return true;
			}
			break;
		case 'Pruebas falladas':
			if (Yii::app()->user->rol_id == 3 && SolicitudDeCambioController::checkUserDeveloper($solicitudId)){
				return true;
			}
			break;
		case 'Duplicado/Rechazado':
			if (Yii::app()->user->rol_id == 2){
				return true;
			}
			break;
		case 'Más información':
			if ((Yii::app()->user->rol_id == 3 || Yii::app()->user->rol_id == 4) && SolicitudDeCambioController::checkUserCreater($solicitudId)){
				return true;
			}
			break;
		case 'Envío actualizado':
			if (Yii::app()->user->rol_id == 2){
				return true;
			}
			break;
		default:
				return false;
		}
		
	}
	
	/**
	 * Borra todos los cambios de estado que tienen que ver
	 * con una solicitud de cambio
	 * @param int $id Identificador de la solicitud de cambio
	 */
	public static function actionDeleteAllCambiosFromIdSol($id){
		
		CambioDeEstado::model()->deleteAll(array('condition'=>'solicitud_de_cambio_id='.$id));
	}
	
	/**
	 * Se obtienen todos los cambios de una solicitud
	 * @param int $id
	 */
	public static function getAllChangesFromIdSol($id){
		return CambioDeEstado::model()->findAll(array('condition'=>'solicitud_de_cambio_id='.$id, 'order'=>'fecha'));
	}
	
	/**
	 * Devuelve el número de solicitudes que han sido abiertas en el mes y año dado
	 * @return int
	 */
	public static function getChangesRequestAbiertoMonth($date){
		$month = date('m', strtotime($date));
		$year = date('Y', strtotime($date));
	
		$changesAbiertoMonth = CambioDeEstado::model()->findAll(array('condition'=>'estado_id = 2 AND
																MONTH(fecha)='.$month.' AND YEAR(fecha)='.$year));
		return count($changesAbiertoMonth);
	}
	
	/**
	 * Devuelve el número de solicitudes que han sido cerradas en el mes y año dado
	 * @return int
	 */
	public static function getChangesRequestCerradoMonth($date){
		$month = date('m', strtotime($date));
		$year = date('Y', strtotime($date));
	
		$changesCerradoMonth = CambioDeEstado::model()->findAll(array('condition'=>'estado_id = 10 AND
																MONTH(fecha)='.$month.' AND YEAR(fecha)='.$year));
		return count($changesCerradoMonth);
	}
	
	/**
	 * Devuelve el número de solicitudes cerradas en un día concreto
	 * @return int
	 */
	public static function getChangesRequestAbiertoByDay($date){
		$day = date('d', strtotime($date));
		$month = date('m', strtotime($date));
		$year = date('Y', strtotime($date));
		$changesAbiertoByDay = CambioDeEstado::model()->findAll(array('condition'=>'estado_id = 2 AND
																YEAR(fecha)='.$year.' AND MONTH(fecha)='.$month.'
																AND DAY(fecha)='.$day));
		return count($changesAbiertoByDay);
	}
	
	/**
	 * Devuelve el número de solicitudes cerradas en un día concreto
	 * @return int
	 */
	public static function getChangesRequestCerradoByDay($date){
		$day = date('d', strtotime($date));
		$month = date('m', strtotime($date));
		$year = date('Y', strtotime($date));
		$changesCerradoByDay = CambioDeEstado::model()->findAll(array('condition'=>'estado_id = 10 AND
																YEAR(fecha)='.$year.' AND MONTH(fecha)='.$month.'
																AND DAY(fecha)='.$day));
		return count($changesCerradoByDay);
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
