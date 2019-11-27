<?php
use yii\helpers\Html;
use yii\helpers\Url;

/** @var $models \frontend\models\Pedidos  */
/** @var $model \frontend\models\Pedidos  */

$this->title = 'Minhas Compras';

?>
<div class="row">

    <div class="col-sm-12">

        <h1><?=$this->title?></h1>

        <table class="table table-hover table-bordered">
            <thead>
                <tr class="info">
                    <th> ID da compra </th>
                     <th> Data </th>
                     <th> Hora </th>
                     <th> Valor </th>
                     <th> Comentário </th>
                    <th><span class="fa fa-money fa-lg"></span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($models as $model): ?>
                <tr>
                    <td>
                        <a href="<?= Url::to(['minhas-compras', 'pedido' =>$model->id.'-'.strtotime($model->data_pedido)]) ?>"><?= $model->id . '-' . strtotime($model->data_pedido)?></a>
                    </td>
                    <td><?= date('d/m/Y', strtotime($model->data_pedido)) ?></td>
                    <td><?= date('H:i:s', strtotime($model->data_pedido)) ?></td>
                    <td>R$ <?= number_format($model->valor_total, 2 , ',', '.') ?></td>
                    <td><?= Html::encode($model->comentario) ?></td>
                    <td><span class="text-<?= ($model->pago ? 'success glyphicon glyphicon-ok' : 'danger glyphicon glyphicon-remove') ?>"></span></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>