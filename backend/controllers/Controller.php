<?php

namespace backend\controllers;

use Yii;

class Controller extends \yii\web\Controller
{

    /**
     * @return bool
     */
    public function isAdmin()
    {
        $user = Yii::$app->user->identity;
        if ($user->isAdmin) {
            return true;
        }
        return false;
    }
}