<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%author_book}}`.
 */
class m241017_070238_create_author_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%author_book}}', [
            'author_id' => $this->integer()->notNull(),
            'book_id' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%author_book}}');
    }
}
