<?php

use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\grid\DataColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Usuários');
$this->params['breadcrumbs'][] = $this->title;
//
//$this->params['header-buttons'][] = Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Cadastrar'), ['create'], [
//    'class' => 'btn btn-success',
//    'data-header' => Yii::t('app', 'Cadastrar'),
//]);
$modulePath = Yii::$app->controller->module->id;

$controller = Yii::$app->controller->id;

$filename = basename(Yii::$app->controller->view->viewFile, '.php');

?>
<div class="<?= $modulePath ?>-<?= $controller ?>-<?= $filename ?>">
    <div class="box box-primary">
        <div class="box-body">
            <!--                    <div class="row mb-2">-->
            <!--                        <div class="col-md-12">-->
            <!--                            --><?php //= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
            <!--                        </div>-->
            <!--                    </div>-->


            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
//                'filterModel' => $searchModel,
                'columns' => [
//                    'auth_key',
//                    'password_hash',
//                    'password_reset_token',
                    'email:email',
                    //'status',
                    //'created_at',
                    //'updated_at',

                    [
                        'class' => ActionColumn::class,
                        'template' => '{update}',
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
