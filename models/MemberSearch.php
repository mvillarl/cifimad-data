<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Member;
use app\components\QuerySearchBuilder;

/**
 * MemberSearch represents the model behind the search form about `app\models\Member`.
 */
class MemberSearch extends Member
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'surname', 'badgeName', 'badgeSurname', 'email', 'nif', 'phone', 'createdAt', 'updatedAt'], 'safe'],
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
        $query = Member::find();

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
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ]);

        QuerySearchBuilder::makeSearch($query,'name', $this->name);
        QuerySearchBuilder::makeSearch($query,'surname', $this->surname);
        QuerySearchBuilder::makeSearch($query,'badgeName', $this->badgeName);
        QuerySearchBuilder::makeSearch($query,'badgeSurname', $this->badgeSurname);
        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'nif', $this->nif])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        // Default sort?
        $query->orderBy(['surname' => 'ASC', 'name' => 'ASC']);

        return $dataProvider;
    }
}
