<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Загрузка изображений';

$form = ActiveForm::begin([
    'id' => 'upload-form',
    'options' => [
        'enctype' => 'multipart/form-data'
    ],
]);

?>

<?= $form->field($model, 'files[]', [
    'inputOptions' => ['multiple' => true, 'accept' => 'image/*'],
])->fileInput()->label('Выберите изображения'); ?>

<div class="form-group">
    <?= Html::submitButton('Загрузить', ['class' => 'btn btn-primary']); ?>
</div>

<?php 

ActiveForm::end(); 

?>
