<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cif_volunteer_inscriptions_shifts".
 *
 * @property integer $idVolunteer
 * @property string $volunteerShift
 *
 * @property CifVolunteerInscriptions $idVolunteer0
 */
class VolunteerInscriptionShift extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cif_volunteer_inscriptions_shifts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idVolunteer', 'volunteerShift'], 'required'],
            [['idVolunteer'], 'integer'],
            [['volunteerShift'], 'string', 'max' => 2],
            [['idVolunteer'], 'exist', 'skipOnError' => true, 'targetClass' => CifVolunteerInscriptions::className(), 'targetAttribute' => ['idVolunteer' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idVolunteer' => 'Id Volunteer',
            'volunteerShift' => 'Volunteer Shift',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdVolunteer0()
    {
        return $this->hasOne(CifVolunteerInscriptions::className(), ['id' => 'idVolunteer']);
    }
}
