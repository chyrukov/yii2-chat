<?php
/**
 * @var yii\web\View $this
 * @var app\models\Message $message
 * @var yii\db\ActiveQuery $messagesQuery
 */
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<?php Pjax::begin([
    'id' => 'list-messages',
    'enablePushState' => false,
    'formSelector' => false,
    'linkSelector' => false
]) ?>
<?= $this->render('_list', compact('messagesQuery')) ?>
<?php Pjax::end() ?>
<?php ActiveForm::begin(['options' => ['class' => 'pjax-form']]) ?>
<?= \yii\bootstrap\Html::activeTextarea($message, 'text') ?>
<br>
<?= Html::submitButton('Отправить') ?>
<?php ActiveForm::end() ?>
