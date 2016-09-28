<?php
namespace app\controllers;

use app\models\Message;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class ChatController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ]
        ];
    }

    public function actionIndex($id)
    {
        $currentUserId = Yii::$app->user->identity->username;
        $messagesQuery = Message::findMessages($currentUserId, $id);
        $message = new Message([
            'from' => $currentUserId,
            'to' => $id
        ]);
        if ($message->load(Yii::$app->request->post()) && $message->validate()) {
            $message->save();
            $message = new Message([
                'from' => $currentUserId
            ]);
            if (Yii::$app->request->isPjax) {
                return $this->renderAjax('_chat', ['messagesQuery' => $messagesQuery, 'message' => $message]);
            }
        }
        if (Yii::$app->request->isPjax) {
            return $this->renderAjax('_list', ['messagesQuery' => $messagesQuery, 'message' => $message]);
        }

        return $this->render('chat', ['messagesQuery' => $messagesQuery, 'message' => $message]);
    }
}
