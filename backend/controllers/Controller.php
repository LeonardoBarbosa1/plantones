<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller as ControllerBase;

class Controller extends ControllerBase
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