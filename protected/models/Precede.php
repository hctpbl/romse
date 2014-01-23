<?php

/**
 * This is the model class for table "precede".
 *
 * The followings are the available columns in table 'precede':
 * @property integer $estado_padre_id
 * @property integer $estado_hijo_id
 *
 * The followings are the available model relations:
 * @property Estado $estadoPadre
 * @property Estado $estadoHijo
 */
class Precede extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'precede';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('estado_padre_id, estado_hijo_id', 'required'),
			array('estado_padre_id, estado_hijo_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('estado_padre_id, estado_hijo_id', 'safe', 'on'=>'search'),
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
			'estadoPadre' => array(self::BELONGS_TO, 'Estado', 'estado_padre_id'),
			'estadoHijo' => array(self::BELONGS_TO, 'Estado', 'estado_hijo_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'estado_padre_id' => 'Estado Padre',
			'estado_hijo_id' => 'Estado Hijo',
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

		$criteria->compare('estado_padre_id',$this->estado_padre_id);
		$criteria->compare('estado_hijo_id',$this->estado_hijo_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Precede the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
