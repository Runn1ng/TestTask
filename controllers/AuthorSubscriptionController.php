<?php

namespace app\controllers;

use Yii;
use app\models\AuthorSubscription;

class AuthorSubscriptionController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSubscribe()
    {
        $data = $this->request->post();

        $subscription = new AuthorSubscription();
        $subscription->author_id = $data['authorId'];
        if (empty($data['phone'])) {
            $subscription->user_id = Yii::$app->user->identity->id;
        } else {
            $subscription->guest_phone = $data['phone'];
        }

        echo $subscription->save();
    }
}
