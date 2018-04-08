<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Attendee;

/**
 * AttendeeSearch represents the model behind the search form about `app\models\Attendee`.
 */
class AttendeeSearch extends Attendee
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'idEvent', 'idMember', 'guest1Photoshoot', 'guest1Autograph', 'guest2Photoshoot', 'guest2Autograph', 'guest2Vintage', 'guest3Photoshoot', 'guest3Autograph', 'guest3Vintage', 'idSource', 'idAttendeeRoommate1', 'idAttendeeRoommate2'], 'integer'],
            [['status', 'ticketType', 'roomType', 'dateStartLodging', 'dateEndLodging', 'remarks', 'remarksRegistration', 'remarksMeals', 'orders', 'createdAt', 'updatedAt', 'memberName'], 'safe'],
            [['mealFridayDinner', 'mealSaturdayLunch', 'mealSaturdayDinner', 'mealSundayLunch', 'mealSundayDinner', 'isSpecial'], 'boolean'],
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
        $query = Attendee::find();

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

	    $dataProvider->sort->attributes['memberName'] = [
		    // The tables are the ones our relation are configured to
		    // in my case they are prefixed with "tbl_"
		    'asc' => ['cif_members.badgeSurname' => SORT_ASC, 'cif_members.badgeName' => SORT_ASC],
		    'desc' => ['cif_members.badgeSurname' => SORT_DESC, 'cif_members.badgeName' => SORT_DESC],
	    ];

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'cif_attendees.idEvent' => $this->idEvent,
            'idMember' => $this->idMember,
            /*'mealFridayDinner' => $this->mealFridayDinner,
            'mealSaturdayLunch' => $this->mealSaturdayLunch,
            'mealSaturdayDinner' => $this->mealSaturdayDinner,
            'mealSundayLunch' => $this->mealSundayLunch,
            'mealSundayDinner' => $this->mealSundayDinner,
            'guest1Photoshoot' => $this->guest1Photoshoot,
            'guest1Autograph' => $this->guest1Autograph,
            'guest2Photoshoot' => $this->guest2Photoshoot,
            'guest2Autograph' => $this->guest2Autograph,
            'guest2Vintage' => $this->guest2Vintage,
            'guest3Photoshoot' => $this->guest3Photoshoot,
            'guest3Autograph' => $this->guest3Autograph,
            'guest3Vintage' => $this->guest3Vintage,*/
            'cif_attendees.idSource' => $this->idSource,
            'cif_attendees.isSpecial' => $this->isSpecial,
            /*'dateStartLodging' => $this->dateStartLodging,
            'dateEndLodging' => $this->dateEndLodging,
            'idAttendeeRoommate1' => $this->idAttendeeRoommate1,
            'idAttendeeRoommate2' => $this->idAttendeeRoommate2,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,*/
            'cif_attendees.status' => $this->status,
            'cif_attendees.ticketType' => $this->ticketType,
            'roomType' => $this->roomType,
	        'orders' => $this->orders,
        ]);

        $query/*->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'remarksRegistration', $this->remarksRegistration])
            ->andFilterWhere(['like', 'remarksMeals', $this->remarksMeals])*/
            ->andFilterSearchMember($this->memberName);

        return $dataProvider;
    }

    public function setMemberName ($name) {
        $this->memberName = $name;
    }
}
