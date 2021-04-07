<?php

use yii\db\Migration;

/**
 * Class m210406_063022_create_table_pembayaran_ambulance
 */
class m210406_063022_create_table_pembayaran_ambulance extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pembayaran_ambulance', [
            'id' => $this->primaryKey(),
            'id_pemesanan_ambulance' => $this->integer(),
            'tarif_jarak_tambahan' => $this->decimal(16,2),
            'total_tarif' => $this->decimal(16,2),
            'nomor_bukti_pembayaran' => $this->string(20),
            'tanggal_bukti_pembayaran' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk_pemesanan_ambulance_pembayaran_ambulance',
             'pembayaran_ambulance',
             'id_pemesanan_ambulance',
             'pemesanan_ambulance',
             'id',
             'cascade'
        );

        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210406_063022_create_table_pembayaran_ambulance cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210406_063022_create_table_pembayaran_ambulance cannot be reverted.\n";

        return false;
    }
    */
}
