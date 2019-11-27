<?php

namespace backend\models;

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

    public $categoria;

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
            [['categoria_id', 'nome', 'preco',], 'required'],
            [['foto1'], 'required', 'on' => 'inclusao'],
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
            'categoria_id' => 'Categoria',
            'nome' => 'Nome',
            'descricao' => 'Descrição',
            'preco' => 'Preço',
            'quantidade' => 'Estoque',
            'foto1' => 'Foto 1',
            'foto2' => 'Foto 2',
            'foto3' => 'Foto 3',
            'foto4' => 'Foto 4',
            'foto5' => 'Foto 5',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categorias::className(), ['id' => 'categoria_id']);
    }


    public function localSalvarImagens() {
        return Yii::$app->basePath . '/../frontend/web/uploads/produtos/' . $this->id;
    }

    public function urlImagens() {
        return Yii::$app->homeUrl . '../uploads/produtos/' . $this->id . '/';
    }

}
