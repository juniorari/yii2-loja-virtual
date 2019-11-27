<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%pedidos_produtos}}".
 *
 * @property int $id
 * @property int $pedido_id
 * @property int $produto_id
 * @property int|null $quantidade
 * @property int|null $confirmado
 *
 * @property Pedidos $pedido
 * @property Produtos $produto
 */
class PedidosProdutos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%pedidos_produtos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pedido_id', 'produto_id'], 'required'],
            [['pedido_id', 'produto_id', 'quantidade', 'confirmado'], 'integer'],
            [['pedido_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pedidos::className(), 'targetAttribute' => ['pedido_id' => 'id']],
            [['produto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Produtos::className(), 'targetAttribute' => ['produto_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pedido_id' => 'Pedido ID',
            'produto_id' => 'Produto ID',
            'quantidade' => 'Quantidade',
            'confirmado' => 'Confirmado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedido()
    {
        return $this->hasOne(Pedidos::className(), ['id' => 'pedido_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduto()
    {
        return $this->hasOne(Produtos::className(), ['id' => 'produto_id']);
    }
}
