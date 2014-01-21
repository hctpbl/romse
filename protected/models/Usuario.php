<?php

/**
 * This is the model class for table "Usuario".
 *
 * The followings are the available columns in table 'Usuario':
 * @property integer $id
 * @property string $nss
 * @property string $dni
 * @property string $nombre
 * @property string $apellidos
 * @property string $fecha_nacimiento
 * @property string $numero_telefono
 * @property string $salario
 * @property string $fecha_incorporacion
 * @property string $fecha_baja
 * @property string $username
 * @property string $password
 * @property integer $rol_id
 *
 * The followings are the available model relations:
 * @property SolicitudDeCambio[] $solicitudDeCambios
 * @property SolicitudDeCambio[] $solicitudDeCambios1
 * @property SolicitudDeCambio[] $solicitudDeCambios2
 * @property SolicitudDeCambio[] $solicitudDeCambios3
 * @property Rol $rol
 */
class Usuario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nss, dni, nombre, apellidos, fecha_nacimiento, numero_telefono, salario, fecha_incorporacion, username, password, rol_id', 'required'),
			array('rol_id', 'numerical', 'integerOnly'=>true),
			array('nss', 'length', 'max'=>10),
			array('dni', 'length', 'max'=>9),
			array('nombre', 'length', 'max'=>30),
			array('apellidos', 'length', 'max'=>60),
			array('numero_telefono', 'length', 'max'=>13),
			array('salario', 'length', 'max'=>8),
			array('username', 'length', 'max'=>15),
			array('password', 'length', 'max'=>100),
			array('fecha_baja', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nss, dni, nombre, apellidos, fecha_nacimiento, numero_telefono, salario, fecha_incorporacion, fecha_baja, username, password, rol_id', 'safe', 'on'=>'search'),
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
			'solicitudDeCambios' => array(self::MANY_MANY, 'SolicitudDeCambio', 'cambio_de_estado(solicitante_id, solicitud_de_cambio_id)'),
			'solicitudDeCambios1' => array(self::HAS_MANY, 'SolicitudDeCambio', 'creador'),
			'solicitudDeCambios2' => array(self::HAS_MANY, 'SolicitudDeCambio', 'probador'),
			'solicitudDeCambios3' => array(self::HAS_MANY, 'SolicitudDeCambio', 'desarrollador'),
			'rol' => array(self::BELONGS_TO, 'Rol', 'rol_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nss' => 'Nss',
			'dni' => 'Dni',
			'nombre' => 'Nombre',
			'apellidos' => 'Apellidos',
			'fecha_nacimiento' => 'Fecha Nacimiento',
			'numero_telefono' => 'Numero Telefono',
			'salario' => 'Salario',
			'fecha_incorporacion' => 'Fecha Incorporacion',
			'fecha_baja' => 'Fecha Baja',
			'username' => 'Username',
			'password' => 'Password',
			'rol_id' => 'Rol',
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
		$criteria->compare('nss',$this->nss,true);
		$criteria->compare('dni',$this->dni,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellidos',$this->apellidos,true);
		$criteria->compare('fecha_nacimiento',$this->fecha_nacimiento,true);
		$criteria->compare('numero_telefono',$this->numero_telefono,true);
		$criteria->compare('salario',$this->salario,true);
		$criteria->compare('fecha_incorporacion',$this->fecha_incorporacion,true);
		$criteria->compare('fecha_baja',$this->fecha_baja,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('rol_id',$this->rol_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	* Se encripta el password antes de almacenarle en la base de datos
	* @return true
	*/
	public function beforeSave()
	{
		if (!empty($this->password))
			$this->password=CPasswordHelper::hashPassword($this->password);
		return true;
	}
	
	/*
	* Se valida el password del Login
	* @return Verificación del password
	*/
	public function validatePassword($password)
    {
        return CPasswordHelper::verifyPassword($password,$this->password);
    }
 
    /*public function hashPassword($password)
    {
        return CPasswordHelper::hashPassword($password);
    }*/
}
