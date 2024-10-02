<?php

use common\models\Duty;
use common\models\User;
use kartik\select2\Select2;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * @var $searchModel \backend\models\DutySearch
 */

$this->title = 'Troca de plantão';
$this->params['breadcrumbs'][] = ['label' => 'Plantões', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

/**
 * @var $user User
 */
$user = Yii::$app->user->identity;

// Busca os plantões do usuário
$duties = Duty::find()->whereUser($user->id)->all();

// Cria um array formatado com 'id' => 'data - status'
$dutyOptions = ArrayHelper::map($duties, 'id', function(Duty $model) {
    return Yii::$app->formatter->asDate($model->date, 'php:d/m/Y') . ' - ' .  Duty::statusValues($model->status);
});

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <?php $form = ActiveForm::begin(); ?>

                        <div class="row">
                            <div class="col-md">
                                <?= $form->field($searchModel, 'duty_to_swap')->widget(Select2::class, [
                                    'data' => $dutyOptions,
                                    'options' => [
                                        'placeholder' => 'Selecione o plantão a ser trocado...',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ],
                                ])->label('Data do plantão atual') ?>
                            </div>
                            <div class="col-md">
                                <?= $form->field($searchModel, 'duty_to_receive')->widget(Select2::class, [
                                    'data' => $dutyOptions, // Array formatado
                                    'options' => [
                                        'placeholder' => 'Selecione o plantão para a troca...',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ],
                                ])->label('Data do plantão para troca') ?>
                            </div>
                        </div>

                        <!-- Botão de salvar -->
                        <div class="float-right">
                            <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
