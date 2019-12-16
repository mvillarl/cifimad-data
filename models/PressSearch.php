<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Press;

/**
 * PressSearch represents the model behind the search form about `app\models\Press`.
 */
class PressSearch extends Press
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'idSource'], 'integer'],
            [['name', 'email', 'keyCheck'], 'safe'],
            [['consent', 'status'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
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
	    $query = Press::find()->select ('cif_press.*, cif_sources.name sourceName')->joinWith('idSource0');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'idSource' => $this->idSource,
            'consent' => $this->consent,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'cif_press.email', $this->email])
            ->andFilterWhere(['like', 'cif_press.name', $this->name]);

        return $dataProvider;
    }
}
