<?php

use yii\db\Migration;

/**
 * Class m210407_041211_view_laporan_pembayaran
 */
class m210407_041211_view_laporan_pembayaran extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(
            "CREATE VIEW cetak_pembayaran
             AS 
             SELECT pembayaran_ambulance.id_pemesanan_ambulance, pemesanan_ambulance.nomor_pesanan,pemesanan_ambulance.tanggal_pesanan,pemesanan_ambulance.nama_pemesan,pemesanan_ambulance.nik_pemesan,
            pemesanan_ambulance.alamat_pemesan,pemesanan_ambulance.nomor_hp_pemesan,
            master_tarif_ambulance.daerah_tujuan,master_tarif_ambulance.perkiraan_jarak_tempuh,master_tarif_ambulance.tarif,
            master_nomor_polisi_mobil_ambulance.nomor_polisi_mobil_ambulance,
            master_sopir_ambulance.nama_supir FROM pembayaran_ambulance
            JOIN pemesanan_ambulance ON pembayaran_ambulance.id_pemesanan_ambulance =  pemesanan_ambulance.id
            JOIN master_tarif_ambulance ON pemesanan_ambulance.id_daerah_tujuan = master_tarif_ambulance.id
            JOIN master_nomor_polisi_mobil_ambulance ON pemesanan_ambulance.id_nomor_polisi_mobil_ambulance = master_nomor_polisi_mobil_ambulance.id
            JOIN master_sopir_ambulance ON pemesanan_ambulance.id_sopir_ambulance = master_sopir_ambulance.id
        "
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210407_041211_view_laporan_pembayaran cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210407_041211_view_laporan_pembayaran cannot be reverted.\n";

        return false;
    }
    */
}
