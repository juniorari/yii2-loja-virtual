<?php

/* @var $this yii\web\View */
/* @var $model \frontend\models\Produtos */

/* @var $models \frontend\models\Produtos */

use frontend\models\Pedidos;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = Yii::$app->name;
?>
<div class="row">
    <?php if (!$models): ?>
        <div class="col-sm-12">
            <div class="alert alert-warning">
                <p>Nenhum produto encontrado.</p>
            </div>
        </div>
    <?php else: ?>
        <?php foreach ($models as $model): ?>
            <div class="col-md-3">
                <div class="well well-sm">
                    <div class="img-thumbnail"
                         style="background: url('<?= $model->urlImagens() . $model->foto1 ?>'); background-size: cover; background-repeat: no-repeat; width: 100%; height: 120px"></div>
                    <div class="text-center nomeproduto" style="height: 60px;">
                        <h4>
                            <strong><a href="<?= Url::to(['produtos/exibir', 'id' => $model->id]) ?>"
                                       style="text-decoration: none"><?= Html::encode($model->nome) ?></a></strong>
                        </h4>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 text-center"><h3 class="">
                                R$ <?= number_format($model->preco, 2, ',', '.') ?></h3></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 text-sm-center text-<?= ($model->quantidade > 0 ? 'success' : 'danger') ?>">
                            <p class="pull-right">Estoque: <?= $model->quantidade ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php Pjax::begin(); ?>
                            <a class="btn btn-primary btn-xs btn-block shopping"
                               href="<?= Url::to(['produtos/adicionar-carrinho', 'id' => $model->id]) ?>">
                                <?= yii\bootstrap\Html::icon('shopping-cart') ?> Adicionar ao carrinho
                            </a>
                            <?php Pjax::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="row">
            <div class="col-sm-12">
                <p>
                    <?=
                    yii\widgets\LinkPager::widget([
                        'pagination' => $pagination,
                    ])
                    ?>
                </p>

            </div>
        </div>
    <?php endif; ?>
</div>

