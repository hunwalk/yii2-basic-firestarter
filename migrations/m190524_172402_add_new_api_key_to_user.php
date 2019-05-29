<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m190524_172402_add_new_api_key_to_user
 */
class m190524_172402_add_new_api_key_to_user extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'api_key', Schema::TYPE_STRING);
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'api_key');
    }
}
