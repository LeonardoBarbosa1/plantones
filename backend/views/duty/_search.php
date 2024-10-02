<?php

use common\models\Duty;
use common\models\User;
use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DutySearch */
/* @var $form yii\widgets\ActiveForm */

?>

<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
]); ?>
<div class="row">
    <div class="col-md">
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
    <div class="col-md">
        <?= $form->field($model, 'status')->widget(Select2::class, [
            'data' => Duty::statusValues(),
            'options' => [
                'placeholder' => 'Selecione...',
            ],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]) ?>
    </div>
</div>


<div class="form-group">
    <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Cancelar', ['duty/index'], ['class' => 'btn btn-outline-secondary']) ?>
    <?= Html::a('Trocar Plantão', ['duty/swap'], ['class' => 'btn btn-dark']) ?>
</div>

<?php ActiveForm::end(); ?>

