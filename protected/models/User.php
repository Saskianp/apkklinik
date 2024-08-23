<?php

class User extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'user'; // Nama tabel di database
    }

    public function rules()
    {
        return array(
            // Validator untuk atribut yang harus diisi
            array('username, password, email, role', 'required'),

            // Validator panjang maksimal untuk atribut
            array('username', 'length', 'max'=>255),
            array('password, email', 'length', 'max'=>125),

            // Validator untuk memastikan email memiliki format yang valid
            array('email', 'email'),

            // Validator untuk memastikan role hanya berisi nilai yang valid
            array('role', 'in', 'range'=>array('master','pegawai', 'user')),

            // Validator untuk atribut yang dapat dicari
            array('id, username, email, role', 'safe', 'on'=>'search'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'role' => 'Role',
        );
    }

    public function relations()
    {
        return array(
            // Relasi lainnya
        );
    }

    protected function beforeSave()
    {
        if(parent::beforeSave())
        {
            if(!empty($this->password))
                $this->password = md5($this->password);
            return true;
        }
        else
            return false;
    }

    public function authenticate($password)
    {
        return $this->password === md5($password);
    }
}
