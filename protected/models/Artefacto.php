<?php

/**
 * This is the model class for table "artefacto".
 *
 * The followings are the available columns in table 'artefacto':
 * @property integer $id
 * @property string $nombre
 * @property string $uri
 * @property string $rol
 * @property string $descripcion
 * @property string $version
 * @property integer $proyecto_id
 * @property integer $depende_de
 *
 * The followings are the available model relations:
 * @property Proyecto $proyecto
 * @property Artefacto $dependeDe
 * @property Artefacto[] $artefactos
 * @property SolicitudDeCambio[] $solicitudDeCambios
 */
class Artefacto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'artefacto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, uri, rol, descripcion, version, proyecto_id', 'required'),
			array('proyecto_id, depende_de', 'numerical', 'integerOnly'=>true),
			array('nombre, rol', 'length', 'max'=>45),
			array('uri', 'length', 'max'=>30),
			array('descripcion', 'length', 'max'=>200),
			array('version', 'length', 'max'=>3),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, uri, rol, descripcion, version, proyecto_id, depende_de', 'safe', 'on'=>'search'),
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
			'proyecto' => array(self::BELONGS_TO, 'Proyecto', 'proyecto_id'),
			'dependeDe' => array(self::BELONGS_TO, 'Artefacto', 'depende_de'),
			'artefactos' => array(self::HAS_MANY, 'Artefacto', 'depende_de'),
			'solicitudDeCambios' => array(self::HAS_MANY, 'SolicitudDeCambio', 'artefacto_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre',
			'uri' => 'Uri',
			'rol' => 'Rol',
			'descripcion' => 'Descripcion',
			'version' => 'Version',
			'proyecto_id' => 'Proyecto',
			'depende_de' => 'Depende De',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('uri',$this->uri,true);
		$criteria->compare('rol',$this->rol,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('version',$this->version,true);
		$criteria->compare('proyecto_id',$this->proyecto_id);
		$criteria->compare('depende_de',$this->depende_de);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Artefacto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
