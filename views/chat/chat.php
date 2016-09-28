<?php
/**
 * @var yii\web\View $this
 * @var app\models\Message $message
 * @var yii\db\ActiveQuery $messagesQuery
 */
use yii\widgets\Pjax;
?>
<?php Pjax::begin([
    'timeout' => 3000,
    'enablePushState' => false,
    'linkSelector' => false,
    'formSelector' => '.pjax-form'
]) ?>
<?= $this->render('_chat', compact('messagesQuery', 'message')) ?>
<?php \yii\widgets\Pjax::end() ?>
<?php $this->registerJs(<<<JS
function updateList() {
  $.pjax.reload({container: '#list-messages'});
}
setInterval(updateList, 1000);
JS
) ?>
