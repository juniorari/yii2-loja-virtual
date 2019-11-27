<?php

use yii\helpers\Html;
use frontend\models\PedidosProdutos;


/** @var $pedidos \frontend\models\PedidosProdutos */
/** @var $pedido \frontend\models\Pedidos */
/** @var $usuario \common\models\User */
/** @var $model \frontend\models\PedidosProdutos */

$this->title = 'Detalhes do Pedido';

?>
<div class="row">
    <div class="col-sm-12">

        <h1><?=$this->title?></h1>


        <table class="table table-hover table-bordered">
            <thead>
            <tr class="info">
                <th> N.</th>
                <th> Título</th>
                <th> Preço unitário</th>
                <th> Qtd</th>
                <th> Sub-Total</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $row = 1;
            $sum = 0;
            $total = 0;
            ?>
            <?php
            $pedidos = PedidosProdutos::find()->where(['pedido_id' => $model->id, 'confirmado' => 1])->all();
            $usuario = $pedidos[0]->pedido->user;
            $pedido = $pedidos[0]->pedido;
            ?>
            <?php foreach ($pedidos as $model): ?>
                <?php
                $sum = $model->produto->preco * $model->quantidade;
                $total += $sum;
                ?>
                <tr>
                    <td><?= $row++ ?></td>
                    <td><?= Html::encode($model->produto->nome) ?></td>
                    <td>R$ <?= Html::encode(number_format($model->produto->preco, 2, ',', '.')) ?></td>
                    <td><?= Html::encode($model->quantidade) ?></td>
                    <td>R$ <?= number_format($sum, 2, ',', '.') ?></td>
                </tr>
            <?php
            endforeach; ?>
            </tbody>
            <tfoot>
            <tr class="success">
                <td colspan="3" class="text-left">Total</td>
                <td colspan="2"> R$ <?= number_format($total, 2, ',', '.') ?></td>
            </tr>
            </tfoot>
        </table>



        <p><label>Data do Pedido: </label> <?=date('d/m/Y \à\s H:i:s', strtotime($pedido->data_pedido))?></p>
        <h3>Dados do Cliente</h3>

        <?=$pedido->nome?>
        <br>
        <?=$pedido->email?>

        <h3>Endereço de Entrega e Cobrança</h3>
        <p><label>Endereço: </label> <?= Html::encode($pedido->endereco) ?></p>
        <p><label>Bairro: </label> <?= Html::encode($pedido->bairro) ?> </p>
        <p><label>Cidade: </label> <?= Html::encode($pedido->cidade) ?> </p>
        <p><label>Estado: </label> <?= Html::encode($pedido->estado) ?> </p>
        <p><label>Telefone: </label> <?= Html::encode($pedido->telefone) ?></p>
        <p><label>Comentário: </label> <?= Html::encode($pedido->comentario) ?></p>
        <br>
        <hr />
        <br>
    </div>
</div>