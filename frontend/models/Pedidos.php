<?php

namespace frontend\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "pedidos".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $nome
 * @property string|null $endereco
 * @property string|null $bairro
 * @property string|null $cidade
 * @property string|null $estado
 * @property string|null $telefone
 * @property string|null $email
 * @property string|null $comentario
 * @property float|null $valor_total
 * @property int $pago
 * @property int $confirmado
 * @property string|null $data_pedido
 *
 * @property User $user
 * @property PedidosProdutos[] $pedidosProdutos
 */
class Pedidos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedidos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data_pedido'], 'safe'],
            [['user_id', 'pago', 'confirmado'], 'integer'],
            [['valor_total'], 'number'],
            [['comentario'], 'string'],
            [['nome', 'endereco', 'bairro', 'cidade', 'telefone', 'email'], 'string', 'max' => 255],
            [['estado'], 'string', 'max' => 2],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'nome' => 'Nome',
            'endereco' => 'Endereço',
            'bairro' => 'Bairro',
            'cidade' => 'Cidade',
            'estado' => 'Estado',
            'telefone' => 'Telefone',
            'email' => 'Email',
            'valor_total' => 'Valor Total',
            'pago' => 'Pago',
            'confirmado' => 'Confirmado',
            'comentario' => 'Comentário',
            'data_pedido' => 'Data Pedido',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidosProdutos()
    {
        return $this->hasMany(PedidosProdutos::className(), ['pedido_id' => 'id']);
    }
}
