<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Author $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Авторы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="author-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php 
            if (!Yii::$app->user->isGuest) {
                echo Html::a(Yii::t('app', 'Изменить'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);

                echo Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить?'),
                        'method' => 'post',
                    ],
                ]);
            }
        ?>

        <button id='subscribe' class='btn btn-primary' data-author_id=<?=$model->id?> data-isguest="<?= Yii::$app->user->isGuest ?>">Подписаться</button>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'firstname',
            'lastname',
            'patronymic',
        ],
    ]) ?>

</div>
<script>
document.addEventListener("DOMContentLoaded", (event) => {
  
    $('#subscribe').click(function(el){
        const isGuest = $(this).data('isguest');
        const authorId =  $(this).data('author_id');
        let phone;
        if (isGuest) {
            phone = prompt('Введите свой телефон')
        }
        console.log(phone)

        $.ajax({
            url: '/author-subscription/subscribe',
            method: 'post',
            data: {authorId: authorId, phone: phone},
            success: function() {
                alert('Вы подписались')
            }
        })
    })
});
  
</script>