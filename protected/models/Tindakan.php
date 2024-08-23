<?php
class Tindakan extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'tindakan';  // Sesuaikan dengan nama tabel Anda
    }

    public function rules()
    {
        return array(
            array('nama_tindakan, obat_id', 'required'),
            array('obat_id', 'numerical', 'integerOnly'=>true),
            array('nama_tindakan', 'length', 'max'=>255),
            // Tambahkan aturan validasi sesuai kebutuhan
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'nama_tindakan' => 'Nama Tindakan',
            'obat_id' => 'Obat',
        );
    }

    public function relations()
    {
        return array(
            'obat' => array(self::BELONGS_TO, 'Obat', 'obat_id'),
        );
    }
}
