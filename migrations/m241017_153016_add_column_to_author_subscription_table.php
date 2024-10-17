<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%author_subscription}}`.
 */
class m241017_153016_add_column_to_author_subscription_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%author_subscription}}', 'guest_phone', $this->string());
        $this->alterColumn('{{%author_subscription}}', 'user_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%author_subscription}}', 'guest_phone');
        $this->alterColumn('{{%author_subscription}}', 'user_id', $this->integer()->notNull());
    }
}
