<?php

use app\migrations\Migration;
use yii\db\Schema;

class m151106_175443_create_kjh_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%kjh}}', [
            'qh' => Schema::TYPE_INTEGER . ' PRIMARY KEY',
            'n1' => Schema::TYPE_INTEGER . ' NOT NULL',
            'n2' => Schema::TYPE_INTEGER . ' NOT NULL',
            'n3' => Schema::TYPE_INTEGER . ' NOT NULL',
            'n4' => Schema::TYPE_INTEGER . ' NOT NULL',
            'n5' => Schema::TYPE_INTEGER . ' NOT NULL',
            'n6' => Schema::TYPE_INTEGER . ' NOT NULL',
            'n7' => Schema::TYPE_INTEGER . ' NOT NULL',
            'n8' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $this->tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%kjh}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
