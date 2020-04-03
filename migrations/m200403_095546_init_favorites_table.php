<?php

use yii\db\Migration;

/**
 * Class m200403_095546_init_favorites_table
 */
class m200403_095546_init_favorites_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200403_095546_init_favorites_table cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
		$this->createTable(
			'favorites',
			[
				'id'          => 'pk',
				'user_id'     => 'int',
				'customer_id' => 'int',
			],
			'ENGINE=InnoDB'
		);
    }

    public function down()
    {
		$this->dropTable('favotites');
    }
}
