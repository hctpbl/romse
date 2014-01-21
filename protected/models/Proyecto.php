<?php

/**
 * This is the model class for table "proyecto".
 *
 * The followings are the available columns in table 'proyecto':
 * @property integer $id
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property string $costes
 * @property string $descripcion
 *
 * The followings are the available model relations:
 * @property Artefacto[] $artefactos
 */
class Proyecto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'proyecto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha_inicio, descripcion', 'required'),
			array('costes', 'length', 'max'=>10),
			array('descripcion', 'length', 'max'=>100),
			array('fecha_fin', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fecha_inicio, fecha_fin, costes, descripcion', 'safe', 'on'=>'search'),
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
			'artefactos' => array(self::HAS_MANY, 'Artefacto', 'proyecto_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fecha_inicio' => 'Fecha Inicio',
			'fecha_fin' => 'Fecha Fin',
			'costes' => 'Costes',
			'descripcion' => 'Descripcion',
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
		$criteria->compare('fecha_inicio',$this->fecha_inicio,true);
		$criteria->compare('fecha_fin',$this->fecha_fin,true);
		$criteria->compare('costes',$this->costes,true);
		$criteria->compare('descripcion',$this->descripcion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Proyecto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
