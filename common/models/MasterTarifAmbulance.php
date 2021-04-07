<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "master_tarif_ambulance".
 *
 * @property int $id
 * @property string|null $daerah_tujuan
 * @property float|null $perkiraan_jarak_tempuh
 * @property float|null $tarif
 *
 * @property PemesananAmbulance[] $pemesananAmbulances
 */
class MasterTarifAmbulance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_tarif_ambulance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['perkiraan_jarak_tempuh', 'tarif'], 'number'],
            [['daerah_tujuan'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'daerah_tujuan' => 'Daerah Tujuan',
            'perkiraan_jarak_tempuh' => 'Perkiraan Jarak Tempuh',
            'tarif' => 'Tarif',
        ];
    }

    /**
     * Gets query for [[PemesananAmbulances]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPemesananAmbulances()
    {
        return $this->hasMany(PemesananAmbulance::className(), ['id_daerah_tujuan' => 'id']);
    }
}
