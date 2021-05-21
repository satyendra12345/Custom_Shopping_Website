<?php

namespace app\commands;

use app\models\EmailQueue;
use app\modules\backup\helpers\MysqlBackup;
use app\components\TConsoleController;

class TimerController extends TConsoleController
{

    const MAX_ATTEMPTS = 5;

    public function actionEmail()
    {
        $query = EmailQueue::find()->where([
            'state_id' => EmailQueue::STATE_PENDING
        ])->orderBy('id asc');

        foreach ($query->batch() as $mails) {
            foreach ($mails as $mail) {
                $mail->sendNow();
            }
        }

        return true;
    }


}


