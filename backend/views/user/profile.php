<?php

use common\models\User;
use kartik\detail\DetailView;
use kartik\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
<!--                    <p>-->
<!--                        --><?php //= Html::a('Atualizar', ['update-profile', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
<!--                    </p>-->

                    <?= DetailView::widget([
                        'model' => $model,
                        'mode' => DetailView::MODE_VIEW,
                        'panel' => [
                            'heading' => 'Perfil',
                            'type' => DetailView::TYPE_DARK,
                        ],
                        'buttons1' => '{update}',
                        'viewAttributeContainer' => [
                            'email' => false,
                        ],
                        'attributes' => [
                            'email:email',
                            'username',
                             'name',
                            [
                                'attribute' => 'type',
                                'displayOnly' => true,
                                'value' => User::typeValues($model->type),

                            ],
                            [
                                'attribute' => 'created_at',
                                'displayOnly' => true,
                                'format' => 'date',
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>