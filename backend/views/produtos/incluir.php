<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Produtos */

$this->title = 'Cadastrar Produtos';
$this->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produtos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
