<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PedidosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuários';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedidos-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php Pjax::begin(); ?>
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
                'username',
                'email:email',
                [
                    'attribute' => 'status',
                    'value' => function ($data) {
                        if ($data->status === User::STATUS_ACTIVE) return 'Ativo';
                        if ($data->status === User::STATUS_INACTIVE) return 'Inativo';
                    }
                ],
                [
                    'attribute' => 'level',
                    'value' => function ($data) {
                        if ($data->level === User::LEVEL_ADMIN) return 'Admin';
                        if ($data->level === User::LEVEL_NORMAL) return 'Usuário';
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                    'template' => '{exibir}&nbsp;{excluir}',
                    'buttons' => [
                        'exibir' => function ($url) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open" style="margin:-5px;"></span>', $url, [
                                'class' => 'btn btn-primary btn-sm',
                                'title' => 'Exibir',
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
                            if ($action === 'excluir') {
                                return Url::to(['excluir', 'id' => $model->id]);
                            }
                        }
                ]
            ],
        ]);
    } catch (Exception $e) {
    } ?>

    <?php Pjax::end(); ?>

</div>
