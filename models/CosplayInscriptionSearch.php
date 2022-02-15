<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CosplayInscription;

/**
 * CosplayInscriptionSearch represents the model behind the search form of `app\models\CosplayInscription`.
 */
class CosplayInscriptionSearch extends CosplayInscription
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idEvent'], 'integer'],
            [['name', 'surname', 'email', 'category', 'characterName', 'remarks'], 'safe'],
	        [['status'], 'boolean'],
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
        $query = CosplayInscription::find()->select ('cif_cosplay_inscriptions.*, cif_events.name eventName')->joinWith('idEvent0');

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
            'idEvent' => $this->idEvent,
            'category' => $this->category,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'cif_cosplay_inscriptions.name', $this->name])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'characterName', $this->characterName])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
}
