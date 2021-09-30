<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AttendeeSale;
use webvimark\modules\UserManagement\models\User;

/**
 * AttendeeSaleSearch represents the model behind the search form of `app\models\AttendeeSale`.
 */
class AttendeeSaleSearch extends AttendeeSale
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $ret =  [
            [['id'], 'integer'],
            [['name', 'phone', 'ticketType', 'authorizedBy', 'authorizedReason'], 'safe'],
        ];
        if (!User::hasRole('desk', false)) {
            $ret[0][0] = array_merge($ret[0][0], ['idEvent']);
        }
        return $ret;
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
        $query = AttendeeSale::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!strlen ($this->idEvent)) $this->idEvent = Yii::$app->session->get('Attendee.idEvent');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'idEvent' => $this->idEvent,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'ticketType', $this->ticketType])
            ->andFilterWhere(['like', 'authorizedBy', $this->authorizedBy])
            ->andFilterWhere(['like', 'authorizedReason', $this->authorizedReason]);

        return $dataProvider;
    }
}
