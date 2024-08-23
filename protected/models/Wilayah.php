<?php

class Wilayah extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'wilayah';
    }

    public function rules()
    {
        return array(
            array('nama_wilayah', 'required'),
            array('id, nama_wilayah', 'safe', 'on'=>'search'),
        );
    }
    
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'nama_wilayah' => 'Nama Wilayah',
        );
    }

    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('nama_wilayah',$this->nama_wilayah,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
