<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "master_sopir_ambulance".
 *
 * @property int $id
 * @property string|null $nama_supir
 * @property string|null $nik
 *
 * @property PemesananAmbulance[] $pemesananAmbulances
 */
class MasterSopirAmbulance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_sopir_ambulance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_supir'], 'string', 'max' => 100],
            [['nik'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_supir' => 'Nama Supir',
            'nik' => 'Nik',
        ];
    }

    /**
     * Gets query for [[PemesananAmbulances]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPemesananAmbulances()
    {
        return $this->hasMany(PemesananAmbulance::className(), ['id_sopir_ambulance' => 'id']);
    }
}
