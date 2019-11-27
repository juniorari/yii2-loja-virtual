<?php

use yii\db\Migration;
use frontend\models\Produtos;

/**
 * Class m191126_185015_create_produtos
 */
class m191126_185015_create_produtos extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $model = new Produtos();
        $model->categoria_id = 3;
        $model->nome = 'iPhone 7 Plus 128GB Vermelho';
        $model->descricao = 'Celular iPhone 7 Plus com 128GB de mémoria interna, Cor Vermelho Tela Retina HD 5,5" 3D Touch Câmera Dupla de 12MP - Apple';
        $model->preco = 4049.55;
        $model->quantidade = 100;
        $model->foto1 = 'foto1_1574779789.jpg';
        $model->save(false);

        $model = new Produtos();
        $model->categoria_id = 2;
        $model->nome = 'Microsoft Office 365 Home';
        $model->descricao = 'Software Microsoft Office 365 Home: 5 Licenças (PC, Mac, Android e IOS) e ainda mais 1 TB de HD virtual para cada licença adiquirida';
        $model->preco = 119.99;
        $model->quantidade = 110;
        $model->foto1 = 'foto1_1574779834.png';
        $model->save(false);

        $model = new Produtos();
        $model->categoria_id = 1;
        $model->nome = 'Toca Discos Ctx Sonata';
        $model->descricao = 'Um belo Toca Discos Ctx Sonata Com Cd, Rádio Fm, Usb, Cartão De Memória, Entrada E Saída Auxiliar com estrutura externa feita em madeira.';
        $model->preco = 761;
        $model->quantidade = 150;
        $model->foto1 = 'foto1_1574779872.jpg';
        $model->foto2 = 'foto2_1574815664.jpg';
        $model->foto3 = 'foto3_1574815664.jpg';
        $model->save(false);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Produtos::findOne(1)->delete();
        Produtos::findOne(2)->delete();
        Produtos::findOne(3)->delete();

        return true;
    }

}
