<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\Categorias;

/* @var $this yii\web\View */
/* @var $model backend\models\Categorias */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categorias-form">

    <?php $form = ActiveForm::begin(); ?>

    <p>&nbsp;</p>

    <div class="row">
        <?php
        echo $form->field($model, 'parent_id', [
            'options' => ['class' => 'col-md-5'],
        ])->widget(Select2::className(), [
            'data' => ArrayHelper::map(Categorias::find()->all(), 'id', 'nome'),
            'options' => [
                'placeholder' => 'Selecione',
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

        <?= $form->field($model, 'nome', [
            'options' => ['class' => 'col-md-7'],
        ])->textInput(['maxlength' => 255]) ?>

    </div>
    <div class="form-group">
        <?= Html::submitButton(($model->isNewRecord ? 'Cadastrar' : 'Atualizar'), ['class' => 'btn btn-' . ( $model->isNewRecord ? 'success' : 'primary')]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
