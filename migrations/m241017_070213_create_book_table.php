<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m241017_070213_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'publication_year' => $this->smallInteger()->notNull(),
            'description' => $this->text()->notNull(),
            'isbn' => $this->string(13)->notNull(),
            'preview' => $this->string()->defaultValue('book/empty.png'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book}}');
    }
}
