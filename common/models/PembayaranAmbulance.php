<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "pembayaran_ambulance".
 *
 * @property int $id
 * @property int|null $id_pemesanan_ambulance
 * @property float|null $tarif_jarak_tambahan
 * @property float|null $total_tarif
 * @property string|null $nomor_bukti_pembayaran
 * @property int|null $tanggal_bukti_pembayaran
 *
 * @property PemesananAmbulance $pemesananAmbulance
 */
class PembayaranAmbulance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pembayaran_ambulance';
    }

    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['tanggal_bukti_pembayaran'],
                    // ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                // 'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function rules()
    {
        return [
            [['id_pemesanan_ambulance', 'tanggal_bukti_pembayaran'], 'integer'],
            [['tarif_jarak_tambahan', 'total_tarif'], 'number'],
            [['nomor_bukti_pembayaran'], 'string', 'max' => 20],
            [['id_pemesanan_ambulance'], 'exist', 'skipOnError' => true, 'targetClass' => PemesananAmbulance::className(), 'targetAttribute' => ['id_pemesanan_ambulance' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_pemesanan_ambulance' => 'Id Pemesanan Ambulance',
            'tarif_jarak_tambahan' => 'Tarif Jarak Tambahan',
            'total_tarif' => 'Total Tarif',
            'nomor_bukti_pembayaran' => 'Nomor Bukti Pembayaran',
            'tanggal_bukti_pembayaran' => 'Tanggal Bukti Pembayaran',
        ];
    }

    /**
     * Gets query for [[PemesananAmbulance]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPemesananAmbulance()
    {
        return $this->hasOne(PemesananAmbulance::className(), ['id' => 'id_pemesanan_ambulance']);
    }
}
