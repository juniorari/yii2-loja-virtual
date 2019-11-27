<?php

namespace frontend\controllers;

use frontend\models\Pedidos;
use frontend\models\PedidosProdutos;
use frontend\models\Produtos;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class ProdutosController extends \yii\web\Controller
{


    public function actionExibir($id)
    {

        $model = $this->loadModel($id);

        return $this->render('exibir', compact('model'));

    }

    /**
     * @param $id
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionAdicionarCarrinho($id)
    {
        $model = $this->loadModel($id);
        $carrinho = Yii::$app->session->get('carrinho') ?: [];

        if (!isset($carrinho[$model->id])) {
            $carrinho[$model->id] = 1;
        } else {
            $carrinho[$model->id]++;
        }
        Yii::$app->session->set('carrinho', $carrinho);
        return json_encode(['color' => 'text-success', 'count' => count($carrinho)]);
    }


    /**
     * @return string|\yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     * @throws \yii\web\HttpException
     */
    public function actionCarrinho()
    {

        $carrinho = Yii::$app->session->get('carrinho') ?: [];

        if (count($carrinho) == 0) {
            Yii::$app->session->setFlash('warning', 'Seu carrinho está vazio. Adicione um produto para acessar');
            return $this->redirect(['site/index']);
        }
        $model = new Pedidos();
        if (!Yii::$app->user->isGuest) {
            $model->nome = Yii::$app->user->identity->username;
            $model->email = Yii::$app->user->identity->email;
            $model->user_id = Yii::$app->user->id;
        }


        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $total = 0;
            foreach ($carrinho as $id => $quantidade) {
                $prod = $this->loadModel($id);

                if ($prod->quantidade < $quantidade) {
                    Yii::$app->session->setFlash('error', "<strong>Oops</strong>. Só temos <strong>{$prod->quantidade}</strong> unidades de <strong>{$prod->nome}</strong>.<br>Diminua a quantidade ou remova o produtto do seu carrinho!");
                    return $this->render('carrinho', compact('model'));
                }
                $total += $prod->preco * $quantidade;
            }
            $model->valor_total = $total;
            $model->data_pedido = date('Y-m-d H:i:s');
            $model->confirmado = 1;

            /**
             * Todo: IMPLEMENTAÇÃO DO MEIO DE PAGAMENTO
             */
            $model->pago = 1;
            /** ***************************************/


            if ($model->save()) {
                foreach ($carrinho as $id => $quantidade) {
                    $pedido = new PedidosProdutos();
                    $pedido->pedido_id = $model->id;
                    $pedido->produto_id = $id;
                    $pedido->quantidade = $quantidade;
                    $pedido->confirmado = 1;
                    $pedido->save();

                    //atualizando o estoque
                    $prod = $this->loadModel($id);
                    $prod->quantidade = (int)$prod->quantidade - (int)$pedido->quantidade;
                    $prod->update(false);
                }
            }

            Yii::$app->session->set('carrinho', []);

            Yii::$app->session->setFlash('success', 'Pedido concluído com sucesso! Obrigado por comprar na <strong>' . Yii::$app->name . '</strong>');
            return $this->redirect(['site/index']);
        }


        return $this->render('carrinho', compact('model'));
    }


    /**
     * @param $id
     * @return \yii\web\Response
     * @throws \yii\web\HttpException
     */
    public function actionRemover($id)
    {
        $this->loadModel($id);
        $carrinho = Yii::$app->session->get('carrinho') ?: [];
        if (isset($carrinho[$id])) {
            $carrinho[$id]--;
            if ($carrinho[$id] <= 0) {
                unset($carrinho[$id]);
            }
        }
        Yii::$app->session->set('carrinho', $carrinho);
        return $this->redirect(['carrinho']);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws \yii\web\HttpException
     */
    public function actionLimpar($id)
    {
        $this->loadModel($id);
        $carrinho = Yii::$app->session->get('carrinho') ?: [];
        if (isset($carrinho[$id])) {
            unset($carrinho[$id]);
        }
        Yii::$app->session->set('carrinho', $carrinho);
        if (empty(Yii::$app->session->get('carrinho'))) {
            return $this->redirect(['site/index']);
        }
        return $this->redirect(['carrinho']);
    }

    /**
     * @param $id
     * @return ProdutosController|Produtos|null
     * @throws \yii\web\HttpException
     */
    public function loadModel($id)
    {
        if (!$model = Produtos::findOne(['id' => $id])) {
            throw new \yii\web\HttpException(404, 'Produto não encontrado.');
        }
        return $model;
    }
}
