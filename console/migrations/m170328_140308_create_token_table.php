<?php

use yii\db\Migration;

/**
 * Handles the creation of table `token`.
 */
class m170328_140308_create_token_table extends Migration
{
   public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%token}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'token' => $this->string()->notNull()->unique(),
            'expired_at' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->createIndex('idx-token-user_id', '{{%token}}', 'user_id');
        $this->addForeignKey('fk-token-user_id', '{{%token}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
    }
    public function down()
    {
        $this->dropTable('{{%token}}');
    }
}


