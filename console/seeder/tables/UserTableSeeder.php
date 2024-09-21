<?php

namespace console\seeder\tables;

use antonyz89\seeder\helpers\CreatedAtUpdatedAt;
use common\models\User;
use console\seeder\DatabaseSeeder;
use console\seeder\TableSeeder;
use Yii;

class UserTableSeeder extends TableSeeder
{


    function run()
    {
        loop(function($i) {
            $this->insert(User::tableName(), [
                'auth_key' => Yii::$app->security->generateRandomString(),
                'password_hash' => Yii::$app->security->generatePasswordHash('user'),
                'email' => "user{$i}@gmail.com",
            ]);
        }, DatabaseSeeder::USER_COUNT);
    }
}