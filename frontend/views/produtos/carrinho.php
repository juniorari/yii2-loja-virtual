<?php

use frontend\models\Produtos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Carrinho de Compras ';
?>
<div class="row">
    <div class="col-sm-12">
        <table class="table table-hover table-bordered">
            <thead>
            <tr class="info">
                <th>Item</th>
                <th>Título</th>
                <th>Preço unitário</th>
                <th>Qtd</th>
                <th>Total</th>
                <th>
                    <span class="fa fa-gear"></span>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php
            $row = 1;
            $total = 0;
            $sum = 0;
            ?>
            <?php

            $carrinho = Yii::$app->session->get('carrinho') ?: [];

            foreach ($carrinho as $id => $qtd): ?>
                <?php
                if (!$prod = Produtos::findOne(['id' => $id])) {
                    throw new \yii\web\HttpException(404, 'Produto não encontrado.');
                }
                $sum = $prod->preco * $qtd;
                $total += $sum;
                ?>
                <tr>
                    <td class="text-center"><?= $row++ ?></td>
                    <td><?= Html::encode($prod->nome) ?></td>
                    <td class="text-right"><?= Html::encode(number_format($prod->preco, 2, ',', '.')) ?></td>
                    <td class="text-center"><?= Html::encode($qtd) ?></td>
                    <td class="text-right"><?= number_format($sum, 2, ',', '.') ?></td>
                    <td class="col-sm-1" nowrap="nowrap">
                        <a class="btn btn-warning btn-xs" href="<?= Url::to(['produtos/remover', 'id' => $id]) ?>">
                            <?= \yii\bootstrap\Html::icon('minus') ?>
                        </a>
                        &nbsp;
                        <a class="btn btn-danger btn-xs" href="<?= Url::to(['produtos/limpar', 'id' => $id]) ?>">
                            <?= \yii\bootstrap\Html::icon('remove') ?>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr class="success">
                <td colspan="4" class="text-left"> TOTAL</td>
                <td colspan="2">R$ <?= number_format($total, 2, ',', '.') ?></td>
            </tr>
            </tbody>
        </table>
        <hr/>
        <?php

        if (Yii::$app->user->isGuest) { ?>

            <div class="row">
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3">
                        <?= Html::a('<span class="fa fa-money"></span>   Faça o login para completar seu pedido ', ['site/login'], ['class' => 'btn btn-lg btn-primary btn-block']) ?>
                    </div>
                </div>

            </div>

        <?php
        } else {

            $form = ActiveForm::begin([
                'options' => [],
            ])
            ?>
            <div class="row">
                <?= $form->field($model, 'nome', ['options' => ['class' => 'col-md-6']]) ?>
                <?= $form->field($model, 'email', ['options' => ['class' => 'col-md-6']]) ?>
            </div>
            <?= $form->field($model, 'endereco') ?>
            <div class="row">
                <?= $form->field($model, 'bairro', ['options' => ['class' => 'col-md-6']]) ?>
                <?= $form->field($model, 'cidade', ['options' => ['class' => 'col-md-4']]) ?>
                <?= $form->field($model, 'estado', ['options' => ['class' => 'col-md-2']]) ?>
            </div>
            <div class="row">
                <?= $form->field($model, 'telefone', ['options' => ['class' => 'col-md-4']])
                    ->widget(\yii\widgets\MaskedInput::className(), [
                        'mask' => ['(99) 9999-9999', '(99) 99999-9999'],
                    ]) ?>
            </div>
            <?= $form->field($model, 'comentario')->textarea(['rows' => 5, 'style' => 'resize:none;']) ?>
            <div class="row">
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3">
                        <?= Html::submitButton('<span class="fa fa-money"></span>   Confirmar Pedido ', ['class' => 'btn btn-lg btn-primary btn-block', 'data-confirm'=>'Confirma o pedido?']) ?>
                    </div>
                </div>

            </div>
            <?php
            ActiveForm::end();
        }
        ?>
    </div>
</div>