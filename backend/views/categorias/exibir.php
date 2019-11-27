<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Categorias;

/* @var $this yii\web\View */
/* @var $model backend\models\Categorias */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Categorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="categorias-view">

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'parent_id',
                'value' => function ($data) {
                    if (!$data->parent_id) return null;
                    return Categorias::findOne($data->parent_id)->nome;
                }
            ],
            'nome',
        ],
    ]) ?>

</div>
