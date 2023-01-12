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
            [['volunteerShift'], 'required'],
            [['idVolunteer', 'volunteerShift'], 'safe'],
            [['idVolunteer'], 'integer'],
            [['volunteerShift'], 'string', 'max' => 2],
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
            'volunteerShift' => 'Turno disponible',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdVolunteer0()
    {
        return $this->hasOne(VolunteerInscription::className(), ['id' => 'idVolunteer']);
    }


	public static function getShifts() {
		return [
			'JM' => 'Jueves (montaje mañana)',
			'JT' => 'Jueves (montaje tarde)',
			'JD' => 'Jueves (montaje todo el día)',
			'VM' => 'Viernes (mañana)',
			'VT' => 'Viernes (tarde)',
			'VD' => 'Viernes (todo el día)',
			'SM' => 'Sábado (mañana)',
            'SC' => 'Sábado (tarde - durante concurso cosplay)',
			'ST' => 'Sábado (tarde - después concurso cosplay)',
			'SD' => 'Sábado (todo el día)',
			'DM' => 'Domingo (mañana)',
			'DT' => 'Domingo (tarde)',
			'DD' => 'Domingo (todo el día)',
			'L' => 'Lunes (desmontaje)',
		];
	}

	public static function shortShiftName ($name) {
    	if (preg_match ("/\((.*)\)/", $name, $matches) ) {
			$insidetext = $matches[1];
			$words = explode(' ', $insidetext);
			$awords = [];
			foreach ($words as $word) {
				if ($word != 'el') {
					$awords[] = $word[0];
				}
			}
			$name = str_replace('('.$insidetext.')', '('.join('', $awords) . ')', $name);
		}
    	return $name;
	}
}
