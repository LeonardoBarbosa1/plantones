<?php

use common\models\User;
use hail812\adminlte\widgets\Menu;
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
        <!--        <div class="user-panel mt-3 pb-3 mb-3 d-flex">-->
        <!--            <div class="image">-->
        <!--                <img src="-->
        <?php //=$assetDir?><!--/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">-->
        <!--            </div>-->
        <!--            <div class="info">-->
        <!--                <a><span class="fas fa-user"></span>  --><?php //= $user->name ?><!--</a>-->
        <!--            </div>-->
        <!--        </div>-->

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
                    ['label' => 'Perfil', 'header' => true],
                    [
                        'label' => $user->name,
                        'icon' => 'fas fa-user',
                        'url' => ['user/profile', 'id' => $user->id],
                    ],
                    ['label' => 'Atividades', 'header' => true],
                    [
                        'label' => 'Plantões',
                        'icon' => 'fa-regular fa-calendar',
                        'url' => ['duty/index'],
                    ],
                    [
                        'label' => 'Usuários',
                        'icon' => 'users',
                        'url' => ['user/index'],
                        'badge' => '<span class="right badge badge-info">' . $usersCount . '</span>',
                        'visible' => $user->isAdmin
                    ],
                    [
                        'label' => 'Yii2 PROVIDED',
                        'header' => true,
                        'visible' => YII_ENV_DEV,
                    ],
                    [
                        'label' => 'Gii',
                        'icon' => 'file-code',
                        'visible' => YII_ENV_DEV,
                        'url' => ['/gii'], 'target' => '_blank'],
                    [
                        'label' => 'Debug',
                        'icon' => 'bug',
                        'visible' => YII_ENV_DEV,
                        'url' => ['/debug'],
                        'target' => '_blank',
                    ],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>