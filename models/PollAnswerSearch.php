<?php

namespace app\models;

use app\models\PollAnswer;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PollAnswerSearch represents the model behind the search form of `app\models\PollAnswer`.
 */
class PollAnswerSearch extends PollAnswer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idPoll'], 'integer'],
            [['answerText'], 'safe'],
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
        $query = PollAnswer::find()->select ('cif_polls_answers.*, cif_polls.pkey pollKey')->joinWith('idPoll0');

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
            'idPoll' => $this->idPoll,
        ]);

        $query->andFilterWhere(['like', 'answerText', $this->answerText]);

        return $dataProvider;
    }
}
