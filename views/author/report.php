<?php

use yii\helpers\Html;

$this->title = 'Отчёт';
\yii\web\YiiAsset::register($this);
?>

<div class="author-view">
    
    <h1><?= Html::encode($this->title) ?></h1>

    <table>
        <tr><th>Автор</th><th>Количество</th></tr>
        <?php foreach ($authors as $author): ?>
            <tr>
                <td><?= $author->name ?></td>
                <td><?= $author->bookCount ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>