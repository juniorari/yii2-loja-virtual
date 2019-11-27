<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\models\Categorias;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategoriasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorias-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Cadastrar Categorias', ['incluir'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    try {
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
//                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'id',
                    'headerOptions' => ['style' => 'width:100px'],
                ],
                [
                    'attribute' => 'parent_id',
                    'value' => function ($data) {
                        if (!$data->parent_id) return null;
                        return Categorias::findOne($data->parent_id)->nome;
                    }
                ],
                'nome',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                    'template' => '{exibir}&nbsp;{alterar}&nbsp;{excluir}',
                    'buttons' => [
                        'exibir' => function ($url) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open" style="margin:-5px;"></span>', $url, [
                                'class' => 'btn btn-primary btn-sm',
                                'title' => 'Exibir',
                                'data-toggle' => 'tooltip',
                                'data-pjax' => '0',
                            ]);
                        },
                        'alterar' => function ($url) {
                            return Html::a('<span class="glyphicon glyphicon-pencil" style="margin:-5px;"></span>', $url, [
                                'class' => 'btn btn-primary btn-sm',
                                'title' => 'Alterar',
                                'data-toggle' => 'tooltip',
                                'data-pjax' => '0',
                            ]);
                        },
                        'excluir' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash" style="margin:-5px;"></span>', $url, [
                                'class' => 'btn btn-danger btn-sm',
                                'title' => 'Excluir',
                                'data-toggle' => 'tooltip',
                                'data-confirm' => Yii::t('yii', 'Tem certeza que deseja apagar este item?'),
                                'data-method' => 'post',
                                'data-pjax' => '0',
                            ]);
                        },
                    ],
                    'urlCreator' =>
                        function ($action, $model, $key, $index) {
                            /** @var $model \frontend\models\Categorias */
                            if ($action === 'exibir') {
                                return Url::to(['exibir', 'id' => $model->id]);
                            }
                            if ($action === 'alterar') {
                                return Url::to(['atualizar', 'id' => $model->id]);
                            }
                            if ($action === 'excluir') {
                                return Url::to(['excluir', 'id' => $model->id]);
                            }
                        }
                ]
            ],
        ]);
    } catch (Exception $e) {
        debug($e->getMessage());
    } ?>


</div>
