<?php

/**
 * This is the model class for table "solicitud_estado".
 *
 * The followings are the available columns in table 'solicitud_estado':
 * @property integer $id
 * @property string $descripcion_breve
 * @property string $descripcion_detallada
 * @property string $fecha_creacion
 * @property string $impacto
 * @property string $prioridad
 * @property string $temporizacion
 * @property string $riesgos
 * @property string $artefacto
 * @property integer $id_artefacto
 * @property string $creador
 * @property integer $id_creador
 * @property string $probador
 * @property integer $id_probador
 * @property string $desarrollador
 * @property integer $id_desarrollador
 * @property string $nombre_estado
 * @property integer $id_estado
 * @property string $fecha_estado
 * @property string $usuario_estado
 * @property integer $id_usuario_estado
 */
class SolicitudEstado extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'solicitud_estado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('descripcion_breve, descripcion_detallada, creador, nombre_estado, usuario_estado', 'required'),
			array('id, id_artefacto, id_creador, id_probador, id_desarrollador, id_estado, id_usuario_estado', 'numerical', 'integerOnly'=>true),
			array('descripcion_breve', 'length', 'max'=>100),
			array('descripcion_detallada', 'length', 'max'=>1000),
			array('impacto, prioridad, temporizacion', 'length', 'max'=>10),
			array('riesgos', 'length', 'max'=>50),
			array('artefacto, nombre_estado', 'length', 'max'=>45),
			array('creador, probador, desarrollador, usuario_estado', 'length', 'max'=>15),
			array('fecha_creacion, fecha_estado', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, descripcion_breve, descripcion_detallada, fecha_creacion, impacto, prioridad, temporizacion, riesgos, artefacto, id_artefacto, creador, id_creador, probador, id_probador, desarrollador, id_desarrollador, nombre_estado, id_estado, fecha_estado, usuario_estado, id_usuario_estado', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'descripcion_breve' => 'Descripcion Breve',
			'descripcion_detallada' => 'Descripcion Detallada',
			'fecha_creacion' => 'Fecha Creacion',
			'impacto' => 'Impacto',
			'prioridad' => 'Prioridad',
			'temporizacion' => 'Temporizacion',
			'riesgos' => 'Riesgos',
			'artefacto' => 'Artefacto',
			'id_artefacto' => 'Id Artefacto',
			'creador' => 'Creador',
			'id_creador' => 'Id Creador',
			'probador' => 'Probador',
			'id_probador' => 'Id Probador',
			'desarrollador' => 'Desarrollador',
			'id_desarrollador' => 'Id Desarrollador',
			'nombre_estado' => 'Nombre Estado',
			'id_estado' => 'Id Estado',
			'fecha_estado' => 'Fecha Estado',
			'usuario_estado' => 'Usuario Estado',
			'id_usuario_estado' => 'Id Usuario Estado',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('descripcion_breve',$this->descripcion_breve,true);
		$criteria->compare('descripcion_detallada',$this->descripcion_detallada,true);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('impacto',$this->impacto,true);
		$criteria->compare('prioridad',$this->prioridad,true);
		$criteria->compare('temporizacion',$this->temporizacion,true);
		$criteria->compare('riesgos',$this->riesgos,true);
		$criteria->compare('artefacto',$this->artefacto,true);
		$criteria->compare('id_artefacto',$this->id_artefacto);
		$criteria->compare('creador',$this->creador,true);
		$criteria->compare('id_creador',$this->id_creador);
		$criteria->compare('probador',$this->probador,true);
		$criteria->compare('id_probador',$this->id_probador);
		$criteria->compare('desarrollador',$this->desarrollador,true);
		$criteria->compare('id_desarrollador',$this->id_desarrollador);
		$criteria->compare('nombre_estado',$this->nombre_estado,true);
		$criteria->compare('id_estado',$this->id_estado);
		$criteria->compare('fecha_estado',$this->fecha_estado,true);
		$criteria->compare('usuario_estado',$this->usuario_estado,true);
		$criteria->compare('id_usuario_estado',$this->id_usuario_estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SolicitudEstado the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
