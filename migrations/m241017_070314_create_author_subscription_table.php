<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%author_subscription}}`.
 */
class m241017_070314_create_author_subscription_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%author_subscription}}', [
            'user_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'subscribed_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%author_subscription}}');
    }
}
