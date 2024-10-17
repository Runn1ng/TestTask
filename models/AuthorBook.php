<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "author_book".
 *
 * @property int $author_id
 * @property int $book_id
 */
class AuthorBook extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author_book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'book_id'], 'required'],
            [['author_id', 'book_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'author_id' => 'Автор',
            'book_id' => 'Книга'
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\queries\AuthorBookQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\AuthorBookQuery(get_called_class());
    }

    public static function createOrUpdate(int $bookId, array $authors) 
    {
        AuthorBook::deleteAll(['book_id' => $bookId]);
        foreach($authors as $authorId) {
            $authorBook = new AuthorBook();
            $authorBook->author_id = $authorId;
            $authorBook->book_id = $bookId;
            $authorBook->save(false);
        }
    }
}
