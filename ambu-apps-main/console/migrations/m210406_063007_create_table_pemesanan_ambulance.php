<?php

use yii\db\Migration;

/**
 * Class m210406_063007_create_table_pemesanan_ambulance
 */
class m210406_063007_create_table_pemesanan_ambulance extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pemesanan_ambulance', [
            'id' => $this->primaryKey(),
            'nomor_pesanan' => $this->string(15),
            'tanggal_pesanan' => $this->integer(),
            'nama_pemesan' => $this->string(255),
            'nik_pemesan' => $this->string(20),
            'alamat_pemesan' => $this->text(),
            'nomor_hp_pemesan' => $this->string(20),
            'id_daerah_tujuan' => $this->integer(),
            'jarak_tambahan' => $this->decimal(4,2),
            'id_nomor_polisi_mobil_ambulance' => $this->integer(),
            'id_sopir_ambulance' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk_nomor_polisi_mobil_ambulance_pemesanan_ambulance',
             'pemesanan_ambulance',
             'id_nomor_polisi_mobil_ambulance',
             'master_nomor_polisi_mobil_ambulance',
             'id',
             'cascade'
        );

        $this->addForeignKey(
            'fk_supir_ambulance_pemesanan_ambulance',
             'pemesanan_ambulance',
             'id_sopir_ambulance',
             'master_sopir_ambulance',
             'id',
             'cascade'
        );

        $this->addForeignKey(
            'fk_daerah_tujuan_ambulance_pemesanan_ambulance',
             'pemesanan_ambulance',
             'id_daerah_tujuan',
             'master_tarif_ambulance',
             'id',
             'cascade'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210406_063007_create_table_pemesanan_ambulance cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210406_063007_create_table_pemesanan_ambulance cannot be reverted.\n";

        return false;
    }
    */
}
