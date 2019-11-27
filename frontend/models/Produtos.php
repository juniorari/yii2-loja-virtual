<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "produtos".
 *
 * @property int $id
 * @property int $categoria_id
 * @property string $nome
 * @property string|null $descricao
 * @property float $preco
 * @property int $quantidade
 * @property string|null $foto1
 * @property string|null $foto2
 * @property string|null $foto3
 * @property string|null $foto4
 * @property string|null $foto5
 *
 * @property Categorias $categoria
 */
class Produtos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produtos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['categoria_id', 'nome', 'preco'], 'required'],
            [['categoria_id', 'quantidade'], 'integer'],
            [['descricao'], 'string'],
            [['preco'], 'number'],
            [['nome', 'foto1', 'foto2', 'foto3', 'foto4', 'foto5'], 'string', 'max' => 255],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorias::className(), 'targetAttribute' => ['categoria_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'categoria_id' => 'Categoria ID',
            'nome' => 'Nome',
            'descricao' => 'Descricao',
            'preco' => 'Preco',
            'quantidade' => 'Quantidade',
            'foto1' => 'Foto1',
            'foto2' => 'Foto2',
            'foto3' => 'Foto3',
            'foto4' => 'Foto4',
            'foto5' => 'Foto5',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categorias::className(), ['id' => 'categoria_id']);
    }


    public function urlImagens() {
        return Yii::$app->homeUrl . 'uploads/produtos/' . $this->id . '/';
    }

}
