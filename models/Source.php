<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "cif_sources".
 *
 * @property integer $id
 * @property string $name
 * @property string $imageFile
 * @property string $separateList
 * @property int $blankBadges
 * @property boolean $isVolunteer
 * @property boolean $status
 *
 * @property CifAttendees[] $cifAttendees
 */
class Source extends \yii\db\ActiveRecord
{
	/**
	 * @var UploadedFile
	 */
	public $imageFileObj;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cif_sources';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 60],
            [['separateList'], 'boolean'],
	        [['blankBadges'], 'integer'],
	        [['imageFileObj'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, gif'],
            [['status', 'isVolunteer'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nombre',
            'imageFileObj' => 'Logo',
            'separateList' => 'Lista separada',
            'blankBadges' => 'Acreditaciones en blanco',
            'status' => 'Activa',
            'isVolunteer' => 'Es staff',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCifAttendees()
    {
        return $this->hasMany(CifAttendees::className(), ['idSource' => 'id']);
    }

	public function upload()
	{
		$hasFile = strlen ($this->imageFileObj->baseName);
		if ($hasFile) $this->imageFile = $this->imageFileObj->baseName . '.' . $this->imageFileObj->extension;
		if ($hasFile && $this->validate() )
			$this->imageFileObj->saveAs('img/logos/' . $this->imageFile);
	}

    public function getStatusValue() {
        $yesno = ['0' => 'No', '1' => 'Sí'];
        return $yesno[$this->status];
    }

    public function getVolunteerValue() {
        $yesno = ['0' => 'No', '1' => 'Sí'];
        return $yesno[$this->isVolunteer];
    }
}
