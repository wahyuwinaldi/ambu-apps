<?php

use yii\db\Migration;

/**
 * Class m210406_062907_create_table_master_nomor_mobil_ambulance
 */
class m210406_062907_create_table_master_nomor_mobil_ambulance extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('master_nomor_polisi_mobil_ambulance', [
            'id' => $this->primaryKey(),
            'nomor_polisi_mobil_ambulance' => $this->string(10),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210406_062907_create_table_master_nomor_mobil_ambulance cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210406_062907_create_table_master_nomor_mobil_ambulance cannot be reverted.\n";

        return false;
    }
    */
}
