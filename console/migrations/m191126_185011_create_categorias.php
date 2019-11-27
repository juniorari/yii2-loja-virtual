<?php

use yii\db\Migration;
use frontend\models\Categorias;

/**
 * Class m191126_185011_create_categorias
 */
class m191126_185011_create_categorias extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $model = new Categorias();
        $model->nome = "Eletrônicos";
        $model->save(false);

        $model = new Categorias();
        $model->nome = "Informática";
        $model->save(false);

        $model = new Categorias();
        $model->nome = "Telefonia";
        $model->save(false);

        $model = new Categorias();
        $model->parent_id = 3;
        $model->nome = "Móvel";
        $model->save(false);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191126_185011_create_categorias cannot be reverted.\n";

        Categorias::findOne(1)->delete();
        Categorias::findOne(2)->delete();
        Categorias::findOne(3)->delete();

        return true;
    }

}
