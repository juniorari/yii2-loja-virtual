<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use backend\models\Produtos;
use backend\models\Categorias;

/* @var $this yii\web\View */
/* @var $model backend\models\Produtos */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="produtos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['atualizar', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['excluir', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Confirma apagar este item??',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
    try {
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'attribute' => 'categoria',
                    'value' => function ($data) {
                        if (!$data->categoria_id) return null;
                        return Categorias::findOne($data->categoria_id)->nome;
                    }
                ],
                'nome',
                'descricao:ntext',
                'preco:currency',
                'quantidade',
                [
                    'attribute' => 'foto1',
                    'format' => 'html',
                    'value' => function ($data) {
                        /** @var $data Produtos */
                        if ($data->foto1)
                            return Html::img($data->urlImagens() . $data->foto1, ['style' => 'width:200px']);
                        else return '';
                    },
                ],
                [
                    'attribute' => 'foto2',
                    'format' => 'html',
                    'value' => function ($data) {
                        /** @var $data Produtos */
                        if ($data->foto2)
                            return Html::img($data->urlImagens() . $data->foto2, ['style' => 'width:200px']);
                        else return '';
                    },
                ],
                [
                    'attribute' => 'foto3',
                    'format' => 'html',
                    'value' => function ($data) {
                        /** @var $data Produtos */
                        if ($data->foto3)
                            return Html::img($data->urlImagens() . $data->foto3, ['style' => 'width:200px']);
                        else return '';
                    },
                ],
                [
                    'attribute' => 'foto4',
                    'format' => 'html',
                    'value' => function ($data) {
                        /** @var $data Produtos */
                        if ($data->foto4)
                            return Html::img($data->urlImagens() . $data->foto4, ['style' => 'width:200px']);
                        else return '';
                    },
                ],
                [
                    'attribute' => 'foto5',
                    'format' => 'html',
                    'value' => function ($data) {
                        /** @var $data Produtos */
                        if ($data->foto5)
                            return Html::img($data->urlImagens() . $data->foto5, ['style' => 'width:200px']);
                        else return '';
                    },
                ],
            ],
        ]);
    } catch (Exception $e) {
    } ?>

</div>
