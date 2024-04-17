<?php

/** @var yii\web\View $this */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Photogram';
?>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'file_name:text:Имя файла',
            'upload_time:text:Дата загрузки',
            [
                'value' => function($model) {
                    $url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/gallery/{$model->file_name}";
                    return "<a href=\"$url\"><img class=\"img__preview\" src=\"$url\" alt=\"{$model->file_name}\"></a>";
                    // return Html::img($url, ['class' => 'img__preview', 'onclick' => 'openPopup(this.src)']);
                },
                'label' => 'Превью (кликабельно)',
                'format' => 'raw',
            ],
            [
                'label' => 'Сохранить в виде zip-архива',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a('Скачать', ['download-images', 'id' => $model->id]);
                },
            ],

        ],
    ]); ?>