<?php

class Obat extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'obat';  // Sesuaikan dengan nama tabel Anda
    }

    public function rules()
    {
        return array(
            array('nama_obat', 'required'),
            array('nama_obat', 'length', 'max'=>255),
            // Tambahkan aturan validasi sesuai kebutuhan
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'nama_obat' => 'Nama Obat',
        );
    }
}
