<?php

namespace app\queries;

/**
 * This is the ActiveQuery class for [[\app\models\AuthorSubscription]].
 *
 * @see \app\models\AuthorSubscription
 */
class AuthorSubscriptionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\AuthorSubscription[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\AuthorSubscription|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
