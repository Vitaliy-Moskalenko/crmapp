<?php

use yii\db\Migration;

/**
 * Class m200403_001539_add_auth_key_to_user
 */
class m200403_001539_add_auth_key_to_user extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'auth_key', 'string UNIQUE');
    }

    public function down()
    {
        $this->dropColumn('user', 'auth_key');
    }
}
