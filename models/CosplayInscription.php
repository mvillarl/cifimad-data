<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cif_cosplay_inscriptions".
 *
 * @property int $id
 * @property int $idEvent
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $category
 * @property string $characterName
 * @property string|null $remarks
 * @property string $createdAt
 * @property string $updatedAt
 * @property boolean $hasPerformance
 * @property string $hasSoundtrack
 * @property string $soundtrack
 * @property boolean $status
 *
 * @property Event $idEvent0
 */
class CosplayInscription extends \yii\db\ActiveRecord
{
    public $eventName;

    public function behaviors() {
        $b = parent::behaviors();
        $b[] = [
            'class' => TimestampBehavior::className(),
            'attributes' => [
                ActiveRecord::EVENT_BEFORE_INSERT => ['createdAt', 'updatedAt'],
                ActiveRecord::EVENT_BEFORE_UPDATE => ['updatedAt'],
            ],
            // if you're using datetime instead of UNIX timestamp:
            'value' => new Expression('NOW()'),
        ];
        return $b;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cif_cosplay_inscriptions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idEvent', 'name', 'surname', 'email', 'category', 'characterName'], 'required'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['idEvent'], 'integer'],
            [['remarks'], 'string'],
            [['hasPerformance', 'status'], 'boolean'],
            [['name', 'surname', 'email', 'characterName'], 'string', 'max' => 100],
            [['category'], 'string', 'max' => 2],
            [['hasSoundtrack'], 'string', 'max' => 1],
            [['soundtrack'], 'string', 'max' => 150],
            [['idEvent'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['idEvent' => 'id']],
            [['createdAt', 'updatedAt'], 'date', 'format' => 'yyyy-MM-dd HH:mm:ss'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idEvent' => 'Evento',
            'eventName' => 'Evento',
            'name' => 'Nombre',
            'surname' => 'Apellidos',
            'email' => 'Email',
            'category' => 'Categoría',
            'characterName' => 'Personaje',
            'remarks' => 'Notas de elaboración',
            'createdAt' => 'Fecha de creación',
            'updatedAt' => 'Fecha de modificación',
            'hasPerformance' => '¿Actuación?',
            'hasSoundtrack' => '¿Banda sonora?',
            'soundtrack' => 'Tema a buscar',
	        'status' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEvent0()
    {
        return $this->hasOne(Event::className(), ['id' => 'idEvent']);
    }

    public function getEvents($map = false) {
        $events = Event::find()->all();
        if ($map) $events = ArrayHelper::map($events, 'id', 'name');

        return $events;
    }

    /**
     * @inheritdoc
     * @return AttendeeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CosplayInscriptionQuery(get_called_class());
    }

    public function getFullname() {
        return $this->name . ' ' . $this->surname;
    }

    public function getCategoryValue() {
        $categories = $this->getCategories (true);
        return $categories[$this->category];
    }

	public function getStatusValue() {
		return $this->status? 'Sí': 'No';
	}

    public function getSoundtrackValue() {
        $soundtrackvalues = $this->getSoundtrackValues();
        return $soundtrackvalues[$this->hasSoundtrack];
    }

    public static function getCategories ($old = false) {
        if ($old) {
            $cats = [
                '' => '',
                'N1' => 'Niños (0-6)',
                'N2' => 'Niños (7-12)',
                /*'N1' => 'Niños (0-4)',
                'N2' => 'Niños (5-9)',
                'N3' => 'Niños (10-14)',*/
                'ST' => 'Star Trek',
                'SW' => 'Star Wars',
                'CS' => 'Cómic / superhéroes',
                'SP' => 'Steampunk',
                'G' => 'Grupal',
                'O' => 'Otros',
            ];
        } else {
            $cats = [
                'N1' => 'Niños (0-6)',
                'N2' => 'Niños (7-12)',
                'I' => 'Individual',
                'G' => 'Grupal',
            ];
        }
        return $cats;
    }

    public static function getSoundtrackValues() {
        $values = [
            '' => 'Nada',
            'P' => 'Pendrive',
            'C' => 'Tema elegido por Control',
            'S' => 'Buscar tema',
        ];
        return $values;
    }
}
