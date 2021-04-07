<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

use Yii;

/**
 * This is the model class for table "pemesanan_ambulance".
 *
 * @property int $id
 * @property string|null $nomor_pesanan
 * @property int|null $tanggal_pesanan
 * @property string|null $nama_pemesan
 * @property string|null $nik_pemesan
 * @property string|null $alamat_pemesan
 * @property string|null $nomor_hp_pemesan
 * @property int|null $id_daerah_tujuan
 * @property float|null $jarak_tambahan
 * @property int|null $id_nomor_polisi_mobil_ambulance
 * @property int|null $id_sopir_ambulance
 *
 * @property PembayaranAmbulance[] $pembayaranAmbulances
 * @property MasterTarifAmbulance $daerahTujuan
 * @property MasterNomorPolisiMobilAmbulance $nomorPolisiMobilAmbulance
 * @property MasterSopirAmbulance $sopirAmbulance
 */
class PemesananAmbulance extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['tanggal_pesanan'],
                    // ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                // 'value' => new Expression('NOW()'),
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pemesanan_ambulance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_daerah_tujuan', 'id_nomor_polisi_mobil_ambulance', 'id_sopir_ambulance'], 'integer'],
            [['alamat_pemesan'], 'string'],
            [['jarak_tambahan'], 'number'],
            [['tanggal_pesanan', 'nomor_pesanan'], 'safe'],
            [['nama_pemesan'], 'string', 'max' => 255],
            [['nik_pemesan', 'nomor_hp_pemesan'], 'string', 'max' => 20],
            [['id_daerah_tujuan'], 'exist', 'skipOnError' => true, 'targetClass' => MasterTarifAmbulance::className(), 'targetAttribute' => ['id_daerah_tujuan' => 'id']],
            [['id_nomor_polisi_mobil_ambulance'], 'exist', 'skipOnError' => true, 'targetClass' => MasterNomorPolisiMobilAmbulance::className(), 'targetAttribute' => ['id_nomor_polisi_mobil_ambulance' => 'id']],
            [['id_sopir_ambulance'], 'exist', 'skipOnError' => true, 'targetClass' => MasterSopirAmbulance::className(), 'targetAttribute' => ['id_sopir_ambulance' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nomor_pesanan' => 'Nomor Pesanan',
            'tanggal_pesanan' => 'Tanggal Pesanan',
            'nama_pemesan' => 'Nama Pemesan',
            'nik_pemesan' => 'Nik Pemesan',
            'alamat_pemesan' => 'Alamat Pemesan',
            'nomor_hp_pemesan' => 'Nomor Hp Pemesan',
            'id_daerah_tujuan' => 'Daerah Tujuan',
            'jarak_tambahan' => 'Jarak Tambahan',
            'id_nomor_polisi_mobil_ambulance' => 'Nomor Polisi Mobil Ambulance',
            'id_sopir_ambulance' => 'Sopir Ambulance',
        ];
    }

    /**
     * Gets query for [[PembayaranAmbulances]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPembayaranAmbulances()
    {
        return $this->hasMany(PembayaranAmbulance::className(), ['id_pemesanan_ambulance' => 'id']);
    }

    /**
     * Gets query for [[DaerahTujuan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDaerahTujuan()
    {
        return $this->hasOne(MasterTarifAmbulance::className(), ['id' => 'id_daerah_tujuan']);
    }

    /**
     * Gets query for [[NomorPolisiMobilAmbulance]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNomorPolisiMobilAmbulance()
    {
        return $this->hasOne(MasterNomorPolisiMobilAmbulance::className(), ['id' => 'id_nomor_polisi_mobil_ambulance']);
    }

    /**
     * Gets query for [[SopirAmbulance]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSopirAmbulance()
    {
        return $this->hasOne(MasterSopirAmbulance::className(), ['id' => 'id_sopir_ambulance']);
    }
}