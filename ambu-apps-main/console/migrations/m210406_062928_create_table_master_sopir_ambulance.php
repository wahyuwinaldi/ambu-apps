<?php

use yii\db\Migration;

/**
 * Class m210406_062928_create_table_master_sopir_ambulance
 */
class m210406_062928_create_table_master_sopir_ambulance extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('master_sopir_ambulance', [
            'id' => $this->primaryKey(),
            'nama_supir' => $this->string(100),
            'nik' => $this->string(20)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210406_062928_create_table_master_sopir_ambulance cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210406_062928_create_table_master_sopir_ambulance cannot be reverted.\n";

        return false;
    }
    */
}
