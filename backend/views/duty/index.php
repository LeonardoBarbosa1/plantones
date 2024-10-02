<?php

use common\models\Duty;
use common\models\User;
use kartik\datecontrol\DateControl;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\DutySearch */
/* @var $modelCount */
/* @var $model Duty */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Plantões';
$this->params['breadcrumbs'][] = $this->title;


/**
 * @var $user User
 */
$user = Yii::$app->user->identity;

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <?php if ($modelCount > 0) : ?>
                <div class="card">

                    <div class="card-body">
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                <span class="fa fa-cog"></span>
                            </a>

                            <div class="dropdown-menu">
                                <?= Html::a('Excluir todos os registros', ['duty/delete'], [
                                    'class' => 'dropdown-item',
                                    'data-method' => 'post',
                                    'data-confirm' => 'Tem certeza que deseja excluir todos os plantões?'
                                ]) ?>
                            </div>
                        </div>

                        <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'rowOptions' => function (Duty $model) {
                                return [
                                    'class' => $model->status == Duty::STATUS_SLACK ? 'bg-success' : 'bg-default',
                                ];
                            },
                            'columns' => [
                                [
                                    'attribute' => 'date',
                                    'content' => function (Duty $model) {

                                        return Yii::$app->formatter->asDate($model->date, 'php:D d/m/Y');
                                    },
                                ],
                                [
                                    'attribute' => 'status',
                                    'content' => function (Duty $model) {
                                        return Duty::statusValues($model->status);
                                    },

                                ],
                            ],
                        ]); ?>
                    </div>
                </div>
            <?php else : ?>
                <div class="container-fluid">
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Olá, <?=$user->name?>!</h4>
                        <p>Por favor, insira a próxima data do seu plantão no campo abaixo.</p>
                        <hr>
                        <p class="mb-0">Este sistema foi desenvolvido inicialmente para pessoas que trabalham em turnos de 12x36 horas.</p>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <?php $form = ActiveForm::begin(); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <?= $form->field($model, 'date')->widget(DateControl::class, [
                                        'language' => 'pt-BR',
                                        'displayFormat' => 'dd/MM/yyyy',
                                        'type' => DateControl::FORMAT_DATE,
                                        'pluginOptions' => [
                                            'autoclose' => true,
                                            'todayHighlight' => true,
                                        ],
                                    ]) ?>
                                </div>
                            </div>

                            <!--                            <div class="">-->
                            <!--                                --><?php //= Html::submitButton($model->isNewRecord ? '<i class="fa fa-plus"></i> ' . Yii::t('admin', 'Cadastrar') : '<i class="fa fa-refresh"></i> ' . Yii::t('admin', 'Atualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                            <!--                            </div>-->
                            <div class="float-right">
                                <?= Html::submitButton('Salvar', ['class' => 'btn btn-success ']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            <?php endif ?>
            <!--.card-->
        </div>
        <!--.col-md-12-->
    </div>
    <!--.row-->
</div>
