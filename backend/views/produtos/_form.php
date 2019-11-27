<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use backend\models\Categorias;

use kartik\select2\Select2;
use kartik\money\MaskMoney;
use kartik\file\FileInput;


/* @var $this yii\web\View */
/* @var $model backend\models\Produtos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produtos-form">

    <form enctype="multipart/form-data"
    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data',
        ]
    ]); ?>


    <p>&nbsp;</p>

    <div class="row">

        <?= $form->field($model, 'nome', ['options' => ['class' => 'col-md-8']])->textInput(['maxlength' => true]) ?>

        <?php

        try {
            echo $form->field($model, 'categoria_id', ['options' => ['class' => 'col-md-4']])
                ->widget(Select2::className(), [
                    'data' => ArrayHelper::map(Categorias::find()
                        ->orderBy('parent_id')->all(), 'id', function ($data) {
                        if ($data->parent_id) {
                            return Categorias::findOne($data->parent_id)->nome . ' - ' . $data->nome;
                        }
                        return $data->nome;
                    })], [
                    'prompt' => 'Selecione a categoria',
                ]);
        } catch (Exception $e) {
        }

        ?>

        <?= $form->field($model, 'descricao', ['options' => ['class' => 'col-md-12']])->textarea(['rows' => 6]) ?>


        <?php
        try {
            echo $form->field($model, 'preco', ['options' => ['class' => 'col-md-4']])
                ->widget(MaskMoney::classname(), [
                    'options' => [
                        'maxlength' => '14',
                    ],
                    'pluginOptions' => [
                        'prefix' => 'R$ ',
                        'suffix' => '',
                        'allowNegative' => false,
                        'affixesStay' => true,
                        'thousands' => '.',
                        'decimal' => ',',
                        'precision' => 2,
                        'allowZero' => true,
                    ]
                ]);
        } catch (Exception $e) {
        }

        Yii::$app->cache->flush();

        ?>

        <?= $form->field($model, 'quantidade', ['options' => ['class' => 'col-md-4']])->textInput() ?>

    </div>

    <h3>FOTOS</h3>

    <?php


    try {

        for ($i = 1; $i <=5; $i++) {
            $campo = 'foto'.$i;
            ?>

            <div class="row">
                <?php if (!$model->isNewRecord) { ?>
                <div class="col-md-2">
                    <label><input type="checkbox" name="atualiza_foto<?=$i?>" /> Atualizar <?=$i?>?</label>
                    <?php if ($model->$campo) { ?><img src="<?=$model->urlImagens() . '/' . $model->$campo?>" width="80" /> <?php } ?>
                </div>
                <?php } ?>
                <div class="col-md-<?=($model->isNewRecord ? '12' : '10')?>">
                    <label class="control-label">Foto <?=$i?></label>
                    <?php
                    echo FileInput::widget([
                        'name' => 'foto' . $i,
                        'language' => 'pt',
                        'pluginOptions' => ['showPreview' => false,]
                    ]);
                    ?><br/>
                </div>
            </div>

            <?php
        }

        ?>


        <?php

    } catch (Exception $e) {
        dd($e->getMessage());
    }
    ?>

    <?php /* $form->field($model, 'foto1', ['options' => ['class' => 'col-md-12']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'foto2', ['options' => ['class' => 'col-md-12']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'foto3', ['options' => ['class' => 'col-md-12']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'foto4', ['options' => ['class' => 'col-md-12']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'foto5', ['options' => ['class' => 'col-md-12']])->textInput(['maxlength' => true]) */ ?>


    <p>&nbsp;</p>

    <div class="form-group">
        <?= Html::submitButton(($model->isNewRecord ? 'Cadastrar' : 'Atualizar'), ['class' => 'btn btn-' . ($model->isNewRecord ? 'success' : 'primary')]) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
