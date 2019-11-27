<?php

namespace frontend\controllers;

use frontend\models\Categorias;
use frontend\models\Pedidos;
use frontend\models\PedidosProdutos;
use frontend\models\Produtos;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class CategoriasController extends \yii\web\Controller
{


    /**
     * @param $id
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionExibir($id){

        $categ = $this->loadModel($id);
        $query = Produtos::find()->where(['categoria_id' => $categ->id]);
        $pagination = new \yii\data\Pagination([
            'totalCount' => $query->count(),
            'defaultPageSize' => 20,
        ]);
        $models = $query->offset($pagination->offset)->limit($pagination->limit)->orderBy('id DESC')->all();
        return $this->render('/site/index',[
            'models' => $models,
            'pagination' => $pagination,
        ]);
    }


    /**
     * @param $id
     * @return ProdutosController|Produtos|null
     * @throws \yii\web\HttpException
     */
    private function loadModel($id) {
        if (!$model = Categorias::findOne(['id' => $id])) {
            throw new \yii\web\HttpException(404, 'Categoria não encontrada.');
        }
        return $model;
    }
}
