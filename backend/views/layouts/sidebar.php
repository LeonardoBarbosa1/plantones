<?php

use common\models\User;
use hail812\adminlte\widgets\Menu;
use yii\helpers\Html;
use yii\helpers\Url;

$usersCount = User::find()->count();

$user = Yii::$app->user->identity;

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Url::home() ?>" class="brand-link">
        <img src="/img/Plantones.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light"><?= Yii::$app->name ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
<!--            <div class="image">-->
<!--                <img src="--><?php //=$assetDir?><!--/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">-->
<!--            </div>-->
            <div class="info">
                <a><span class="fas fa-user"></span>  <?= $user->name ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>-->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo Menu::widget([
                'items' => [
                    [
                        'label' => 'Dashboard',
                        'icon' => 'tachometer-alt',
                        'url' => ['site/index'],
                        'badge' => '<span class="right badge badge-info">2</span>',
//                        'visible' => $user->isAdmin
                    ],
                    [
                        'label' => 'User',
                        'icon' => 'users',
                        'url' => ['user/index'],
                        'badge' => '<span class="right badge badge-info">' . $usersCount . '</span>',
                        'visible' => $user->isAdmin
                    ],
                    ['label' => 'Yii2 PROVIDED', 'header' => true],
                    ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
                    ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>