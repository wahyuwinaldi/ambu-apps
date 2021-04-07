<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cetak_pembayaran".
 *
 * @property int|null $id_pemesanan_ambulance
 * @property string|null $nomor_pesanan
 * @property int|null $tanggal_pesanan
 * @property string|null $nama_pemesan
 * @property string|null $nik_pemesan
 * @property string|null $alamat_pemesan
 * @property string|null $nomor_hp_pemesan
 * @property string|null $daerah_tujuan
 * @property float|null $perkiraan_jarak_tempuh
 * @property float|null $tarif
 * @property string|null $nomor_polisi_mobil_ambulance
 * @property string|null $nama_supir
 */
class CetakPembayaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cetak_pembayaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pemesanan_ambulance', 'tanggal_pesanan'], 'default', 'value' => null],
            [['id_pemesanan_ambulance', 'tanggal_pesanan'], 'integer'],
            [['alamat_pemesan'], 'string'],
            [['perkiraan_jarak_tempuh', 'tarif'], 'number'],
            [['nomor_pesanan'], 'string', 'max' => 15],
            [['nama_pemesan', 'daerah_tujuan'], 'string', 'max' => 255],
            [['nik_pemesan', 'nomor_hp_pemesan'], 'string', 'max' => 20],
            [['nomor_polisi_mobil_ambulance'], 'string', 'max' => 10],
            [['nama_supir'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pemesanan_ambulance' => 'Id Pemesanan Ambulance',
            'nomor_pesanan' => 'Nomor Pesanan',
            'tanggal_pesanan' => 'Tanggal Pesanan',
            'nama_pemesan' => 'Nama Pemesan',
            'nik_pemesan' => 'Nik Pemesan',
            'alamat_pemesan' => 'Alamat Pemesan',
            'nomor_hp_pemesan' => 'Nomor Hp Pemesan',
            'daerah_tujuan' => 'Daerah Tujuan',
            'perkiraan_jarak_tempuh' => 'Perkiraan Jarak Tempuh',
            'tarif' => 'Tarif',
            'nomor_polisi_mobil_ambulance' => 'Nomor Polisi Mobil Ambulance',
            'nama_supir' => 'Nama Supir',
        ];
    }
}
