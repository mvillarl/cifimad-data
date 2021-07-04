<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cif_volunteer_inscriptions_functions".
 *
 * @property integer $idVolunteer
 * @property string $volunteerFunction
 *
 * @property CifVolunteerInscriptions $idVolunteer0
 */
class VolunteerInscriptionFunction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cif_volunteer_inscriptions_functions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idVolunteer', 'volunteerFunction'], 'required'],
            [['idVolunteer'], 'integer'],
            [['volunteerFunction'], 'string', 'max' => 2],
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
            'volunteerFunction' => 'Volunteer Function',
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
