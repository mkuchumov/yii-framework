<?php

use yii\db\Migration;

class m170328_083625_add_profile_fileds extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'description', $this->text());
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'description');
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
