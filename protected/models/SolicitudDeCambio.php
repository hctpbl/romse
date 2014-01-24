<?php

/**
 * This is the model class for table "solicitud_de_cambio".
 *
 * The followings are the available columns in table 'solicitud_de_cambio':
 * @property integer $id
 * @property string $descripcion_breve
 * @property string $descripcion_detallada
 * @property string $impacto
 * @property string $prioridad
 * @property string $temporizacion
 * @property string $riesgos
 * @property integer $artefacto_id
 * @property integer $creador
 * @property integer $probador
 * @property integer $desarrollador
 *
 * The followings are the available model relations:
 * @property CambioDeEstado[] $cambioDeEstados
 * @property Artefacto $artefacto
 * @property Usuario $creador0
 * @property Usuario $desarrollador0
 * @property Usuario $probador0
 */
class SolicitudDeCambio extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'solicitud_de_cambio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('descripcion_breve, descripcion_detallada, creador', 'required'),
			array('artefacto_id, creador, probador, desarrollador', 'numerical', 'integerOnly'=>true),
			array('descripcion_breve', 'length', 'max'=>100),
			array('descripcion_detallada', 'length', 'max'=>1000),
			array('impacto, prioridad, temporizacion', 'length', 'max'=>10),
			array('riesgos', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, descripcion_breve, descripcion_detallada, impacto, prioridad, temporizacion, riesgos, artefacto_id, creador, probador, desarrollador', 'safe', 'on'=>'search'),
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
			'cambioDeEstados' => array(self::HAS_MANY, 'CambioDeEstado', 'solicitud_de_cambio_id'),
			'artefacto' => array(self::BELONGS_TO, 'Artefacto', 'artefacto_id'),
			'creador0' => array(self::BELONGS_TO, 'Usuario', 'creador'),
			'desarrollador0' => array(self::BELONGS_TO, 'Usuario', 'desarrollador'),
			'probador0' => array(self::BELONGS_TO, 'Usuario', 'probador'),
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
			'impacto' => 'Impacto',
			'prioridad' => 'Prioridad',
			'temporizacion' => 'Temporizacion',
			'riesgos' => 'Riesgos',
			'artefacto_id' => 'Artefacto',
			'creador' => 'Creador',
			'probador' => 'Probador',
			'desarrollador' => 'Desarrollador',
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
		$criteria->compare('impacto',$this->impacto,true);
		$criteria->compare('prioridad',$this->prioridad,true);
		$criteria->compare('temporizacion',$this->temporizacion,true);
		$criteria->compare('riesgos',$this->riesgos,true);
		$criteria->compare('artefacto_id',$this->artefacto_id);
		$criteria->compare('creador',$this->creador);
		$criteria->compare('probador',$this->probador);
		$criteria->compare('desarrollador',$this->desarrollador);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SolicitudDeCambio the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * Se guarda el id del creador antes de guardar la solicitud
	 */
	public function beforeSave() {
		if ($this->isNewRecord) {
			$this->creador = Yii::app()->user->id;
		}
		return parent::beforeSave();
	}
	
}
