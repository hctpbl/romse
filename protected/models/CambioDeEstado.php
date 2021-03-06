<?php

/**
 * This is the model class for table "cambio_de_estado".
 *
 * The followings are the available columns in table 'cambio_de_estado':
 * @property integer $solicitud_de_cambio_id
 * @property integer $usuario_id
 * @property string $fecha
 * @property integer $estado_id
 *
 * The followings are the available model relations:
 * @property Estado $estado
 * @property SolicitudDeCambio $solicitudDeCambio
 * @property Usuario $usuario
 */
class CambioDeEstado extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cambio_de_estado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('solicitud_de_cambio_id, usuario_id, estado_id', 'required'),
			array('solicitud_de_cambio_id, usuario_id, estado_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('solicitud_de_cambio_id, usuario_id, fecha, estado_id', 'safe', 'on'=>'search'),
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
			'estado' => array(self::BELONGS_TO, 'Estado', 'estado_id'),
			'solicitudDeCambio' => array(self::BELONGS_TO, 'SolicitudDeCambio', 'solicitud_de_cambio_id'),
			'usuario' => array(self::BELONGS_TO, 'Usuario', 'usuario_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'solicitud_de_cambio_id' => 'Solicitud De Cambio',
			'usuario_id' => 'Usuario',
			'fecha' => 'Fecha',
			'estado_id' => 'Estado',
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

		$criteria->compare('solicitud_de_cambio_id',$this->solicitud_de_cambio_id);
		$criteria->compare('usuario_id',$this->usuario_id);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('estado_id',$this->estado_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CambioDeEstado the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
