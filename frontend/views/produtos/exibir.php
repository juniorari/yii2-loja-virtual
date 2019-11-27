<?php

use frontend\models\Produtos;
use yii\widgets\Pjax;
use yii\helpers\Url;

/** @var $model Produtos */
/** @var $this \yii\web\View */

$this->title = $model->nome;
?>

<div class="row">
    <div class="col-sm-12">

        <label class="control-label">Produto:</label>
        <div class="jumbotron">
            <h2><?= $model->nome ?></h2>
        </div>

        <div id="imagensFotos" class="carousel slide" data-ride="carousel" data-interval="2000">
            <div class="carousel-inner">
                <?php
                for ($i = 1; $i <= 5; $i++) {
                    $campo = 'foto' . $i;
                    if ($model->$campo) {
                        ?>
                        <div class="carousel-item <?= ($i === 1 ? 'active' : '') ?>">
                            <div class="container-imagem"
                                 style="background-image: url('<?= $model->urlImagens() . $model->$campo ?>')">
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <a class="carousel-control-prev" href="#imagensFotos" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#imagensFotos" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <p>&nbsp;</p>
        <label class="control-label">Descrição:</label>
        <h3><?= $model->descricao ?></h3>
        <p>&nbsp;</p>
        <label class="control-label">Preço:</label>
        <h5>R$ <?= number_format($model->preco, 2, ',', '.') ?></h5>
        <p>&nbsp;</p>
        <label class="control-label">Estoque:</label>
        <h5><?= $model->quantidade ?></h5>

        <?php Pjax::begin(); ?>
        <a class="btn btn-primary btn-lg btn-block shopping"
           href="<?= Url::to(['produtos/adicionar-carrinho', 'id' => $model->id]) ?>">
            <?= yii\bootstrap\Html::icon('shopping-cart') ?> Adicionar ao carrinho
        </a>
        <?php Pjax::end(); ?>

    </div>
</div>
