<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string|null $patronymic
 */
class Author extends \yii\db\ActiveRecord
{
    public $bookCount;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname'], 'required'],
            [['firstname', 'lastname', 'patronymic'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Ид',
            'firstname' => 'Имя',
            'lastname' => 'Фамилия',
            'patronymic' => 'Отчество',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\queries\AuthorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\AuthorQuery(get_called_class());
    }

    public function getName()
    {
        return $this->firstname . ' ' . $this->lastname . ' ' . $this->patronymic;
    }
}
