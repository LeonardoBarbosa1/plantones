<?php

use common\models\Duty;
use common\models\DutyActivities;
use common\models\User;
use kartik\datecontrol\DateControl;
use kartik\detail\DetailView;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\DutyActivitiesSearch */
/* @var $model Duty */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Atividades do Plantão';
//$this->params['breadcrumbs'][] = ['label' => 'Plantões', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
/**
 * @var $user User
 */
$user = Yii::$app->user->identity;

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="border-radius: 20px">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <?= Html::a('Cadastrar', ['duty-activities/create'], [
                                'class' => 'btn btn-success btn-sm show-modal',
                                'data-target' => '#modal',
                                'data-header' => Yii::t('app', 'Cadastrar'),]) ?>

                        </div>
                    </div>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            'name',
                            [
                                'attribute' => 'status',
                                'content' => function (DutyActivities $model) {
                                    return DutyActivities::statusValues($model->status);
                                },

                            ],
                            [
                                'class' => ActionColumn::class,
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
            <!--.card-->
        </div>
        <!--.col-md-12-->
    </div>
    <!--.row-->
</div>
