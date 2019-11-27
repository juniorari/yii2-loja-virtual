<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Html as Bootstrap;

use backend\models\PedidosProdutos;

/* @var $this yii\web\View */
/* @var $model backend\models\Pedidos */
/* @var $pedido backend\models\PedidosProdutos */

$this->title = 'Exibir Pedido ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pedidos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Excluir', ['excluir', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Confirma exclusão?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <h3>Produtos</h3>

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
        $pedidos = PedidosProdutos::find()->where(['pedido_id' => $model->id, 'confirmado' => 1])->all();
        ?>
        <?php foreach ($pedidos as $row => $pedido): ?>
            <tr>
                <td><?= ($row + 1) ?></td>
                <td><?= Html::encode($pedido->produto->nome) ?></td>
                <td>R$ <?= Html::encode(number_format($pedido->produto->preco, 2, ',', '.')) ?></td>
                <td><?= Html::encode($pedido->quantidade) ?></td>
                <td>R$ <?= number_format(($pedido->produto->preco * $pedido->quantidade), 2, ',', '.') ?></td>
            </tr>
        <?php
        endforeach; ?>
        </tbody>
    </table>

    <h3>Detalhes do Pedido</h3>
    <?php
    try {
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'nome',
                'endereco',
                'bairro',
                'cidade',
                'estado',
                'telefone',
                'email:email',
                'comentario:ntext',
                'valor_total:currency',
                [
                    'attribute' => 'pago',
                    'format' => 'html',
                    'value' => function ($data) {
                        return ($data->pago ? Bootstrap::icon('ok', ['class' => 'text-success']) : Bootstrap::icon('remove', ['class' => 'text-danger']));
                    }
                ],
                [
                    'attribute' => 'confirmado',
                    'format' => 'html',
                    'value' => function ($data) {
                        return ($data->confirmado ? Bootstrap::icon('ok', ['class' => 'text-success']) : Bootstrap::icon('remove', ['class' => 'text-danger']));
                    }
                ],
                'data_pedido:dateTime',
            ],
        ]);
    } catch (Exception $e) {
    } ?>

</div>
