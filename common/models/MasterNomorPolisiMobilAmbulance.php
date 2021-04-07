<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "master_nomor_polisi_mobil_ambulance".
 *
 * @property int $id
 * @property string|null $nomor_polisi_mobil_ambulance
 *
 * @property PemesananAmbulance[] $pemesananAmbulances
 */
class MasterNomorPolisiMobilAmbulance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_nomor_polisi_mobil_ambulance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nomor_polisi_mobil_ambulance'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nomor_polisi_mobil_ambulance' => 'Nomor Polisi Mobil Ambulance',
        ];
    }

    /**
     * Gets query for [[PemesananAmbulances]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPemesananAmbulances()
    {
        return $this->hasMany(PemesananAmbulance::className(), ['id_nomor_polisi_mobil_ambulance' => 'id']);
    }
}
