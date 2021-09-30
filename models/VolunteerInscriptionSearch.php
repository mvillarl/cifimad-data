<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VolunteerInscription;

/**
 * VolunteerInscriptionSearch represents the model behind the search form about `app\models\VolunteerInscription`.
 */
class VolunteerInscriptionSearch extends VolunteerInscription
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'idEvent'], 'integer'],
            [['name', 'email', 'nameFacebook'], 'safe'],
            [['status'], 'boolean'],
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
	    $query = VolunteerInscription::find()->select ('cif_volunteer_inscriptions.*, cif_events.name eventName')->joinWith('idEvent0');

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
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'nameFacebook', $this->nameFacebook]);

        return $dataProvider;
    }
}
