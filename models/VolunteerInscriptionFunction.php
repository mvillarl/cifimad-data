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
            [['volunteerFunction'], 'required'],
            [['idVolunteer', 'volunteerFunction'], 'safe'],
            [['idVolunteer'], 'integer'],
            [['volunteerFunction'], 'string', 'max' => 2],
            [['idVolunteer'], 'exist', 'skipOnError' => true, 'targetClass' => VolunteerInscription::className(), 'targetAttribute' => ['idVolunteer' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idVolunteer' => 'Voluntario',
            'volunteerFunction' => 'Área',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdVolunteer0()
    {
        return $this->hasOne(VolunteerInscription::className(), ['id' => 'idVolunteer']);
    }

	public static function getFunctions() {
		return [
			'AC' => 'Acreditaciones',
			'MO' => 'Montaje',
			'PR' => 'Prensa',
			'CO' => 'Comunicaciones',
			'CK' => 'CifiKids',
			'AA' => 'Asistente de actores',
			'FT' => 'Fotografía y vídeo',
			'PR' => 'Presentador cosplay',
			'TR' => 'Tramoyista',
			'CC' => 'Control cosplay',
			'DM' => 'Desmontaje',
			'TA' => 'Traductor para actores',
		];
	}
}
