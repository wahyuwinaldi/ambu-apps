<?php

use yii\db\Migration;

/**
 * Class m210406_062945_create_table_master_tarif_ambulance
 */
class m210406_062945_create_table_master_tarif_ambulance extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('master_tarif_ambulance', [
            'id' => $this->primaryKey(),
            'daerah_tujuan' => $this->string(255),
            'perkiraan_jarak_tempuh' => $this->decimal(4,2),
            'tarif' => $this->decimal(16, 2)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210406_062945_create_table_master_tarif_ambulance cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210406_062945_create_table_master_tarif_ambulance cannot be reverted.\n";

        return false;
    }
    */
}
