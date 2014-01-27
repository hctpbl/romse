<?php
class AjaxController extends Controller {
	
	public function actionGetProjects() {
		$q = 'SELECT id, nombre AS value FROM proyecto
        WHERE nombre LIKE ?';
		$cmd = Yii::app()->db->createCommand($q);
		$result = $cmd->query(array('%' . $_GET['term'] . '%'));
		$data = array();
		foreach ($result as $row) {
			$data[] = $row;
		}
		echo CJSON::encode($data);
		Yii::app()->end();
	}
	
	public function actionGetArtifacts() {
		$q = 'SELECT id, nombre AS value FROM artefacto
        WHERE nombre LIKE ?';
		$cmd = Yii::app()->db->createCommand($q);
		$result = $cmd->query(array('%' . $_GET['term'] . '%'));
		$data = array();
		foreach ($result as $row) {
			$data[] = $row;
		}
		echo CJSON::encode($data);
		Yii::app()->end();
	}
	
	public function actionGetUsers() {
		$q = 'SELECT id, CONCAT(nombre, " ", apellidos, " (", username, ")") AS value FROM usuario
        WHERE CONCAT(nombre, " ", apellidos, " (", username, ")") LIKE ?';
		$cmd = Yii::app()->db->createCommand($q);
		$result = $cmd->query(array('%' . $_GET['term'] . '%'));
		$data = array();
		foreach ($result as $row) {
			$data[] = $row;
		}
		echo CJSON::encode($data);
		Yii::app()->end();
	}
	
	public function actionGetDevUsers() {
		$q = 'SELECT id, CONCAT(nombre, " ", apellidos, " (", username, ")") AS value FROM usuario
        	WHERE CONCAT(nombre, " ", apellidos, " (", username, ")") LIKE ? AND rol_id = 3';
		$cmd = Yii::app()->db->createCommand($q);
		$result = $cmd->query(array('%' . $_GET['term'] . '%'));
		$data = array();
		foreach ($result as $row) {
			$data[] = $row;
		}
		echo CJSON::encode($data);
		Yii::app()->end();
	}
	
	public function actionGetTesUsers() {
		$q = 'SELECT id, CONCAT(nombre, " ", apellidos, " (", username, ")") AS value FROM usuario
        	WHERE CONCAT(nombre, " ", apellidos, " (", username, ")") LIKE ? AND (rol_id = 3 OR rol_id = 4)';
		$cmd = Yii::app()->db->createCommand($q);
		$result = $cmd->query(array('%' . $_GET['term'] . '%'));
		$data = array();
		foreach ($result as $row) {
			$data[] = $row;
		}
		echo CJSON::encode($data);
		Yii::app()->end();
	}
	
}
?>