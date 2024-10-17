<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "author_subscription".
 *
 * @property int $user_id
 * @property int $author_id
 * @property string $subscribed_at
 */
class AuthorSubscription extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author_subscription';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id'], 'required'],
            [['user_id', 'author_id'], 'integer'],
            [['subscribed_at', 'guest_phone'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'Пользователь',
            'author_id' => 'Автор',
            'subscribed_at' => 'Дата подписки',
            'guest_phone' => 'Телефон гостя'
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\queries\AuthorSubscriptionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\AuthorSubscriptionQuery(get_called_class());
    }
}
