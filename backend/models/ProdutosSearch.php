<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Produtos;

/**
 * ProdutosSearch represents the model behind the search form of `backend\models\Produtos`.
 */
class ProdutosSearch extends Produtos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'categoria_id', 'quantidade'], 'integer'],
            [['nome', 'descricao', 'foto1', 'foto2', 'foto3', 'foto4', 'foto5'], 'safe'],
            [['preco'], 'number'],
            [['categoria'], 'string']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Produtos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => [
                'categoria' => [
                    'asc' => [Categorias::tableName() . '.nome' => SORT_ASC],
                    'desc' => [Categorias::tableName() . '.nome' => SORT_DESC],
                    'default' => SORT_ASC
                ],
                'id', 'categoria_id', 'quantidade', 'nome', 'descricao', 'preco'
            ],]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        $query->join('INNER JOIN', Categorias::tableName(), 'categorias.id = produtos.categoria_id');


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'categoria_id' => $this->categoria_id,
            'preco' => $this->preco,
            'quantidade' => $this->quantidade,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'foto1', $this->foto1])
            ->andFilterWhere(['like', 'foto2', $this->foto2])
            ->andFilterWhere(['like', 'foto3', $this->foto3])
            ->andFilterWhere(['like', 'foto4', $this->foto4])
            ->andFilterWhere(['like', 'foto5', $this->foto5])
            ->andFilterWhere(['like', 'categorias.nome', $this->categoria])
        ;

        return $dataProvider;
    }
}
