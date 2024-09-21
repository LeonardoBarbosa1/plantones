<?php

namespace console\seeder;

use console\seeder\tables\UserTableSeeder;

class DatabaseSeeder extends TableSeeder
{

    const USER_COUNT = 10;

    function run()
    {
        UserTableSeeder::create()->run();
    }
}