<?php

use yii\db\Migration;

/**
 * Class m180420_132652_add_currency_rate_table
 */
class m180420_132652_add_currency_rate_table extends Migration
{
    public function up()
    {
        $this->createTable('currency_rate', [
            'id' => $this->primaryKey(),
            'date' => $this->string(255)->notNull(),
            'code' => $this->string(255)->notNull(),
            'rate' => $this->string(255)->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('currency_rate');
    }

}
