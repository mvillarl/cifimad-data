<?php

namespace app\models;

use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use Yii;
use yii\base\BaseObject;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cif_polls".
 *
 * @property int $id
 * @property string|null $pkey
 * @property string|null $title
 *
 * @property PollAnswer[] $pollAnswers
 */
class Poll extends \yii\db\ActiveRecord
{
    public function behaviors() {
        $b = parent::behaviors();
        $b['saveRelations'] = [
            'class'     => SaveRelationsBehavior::className(),
            'relations' => [
                'pollAnswers' => ['cascadeDelete' => true],
            ],
        ];
        return $b;
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cif_polls';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pkey'], 'string', 'max' => 25],
            [['title'], 'string', 'max' => 100],
            [['pkey'], 'unique'],
            [['pollAnswers'], 'safe'],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Identificador',
            'pkey' => 'Clave',
            'title' => 'Título',
            'pollAnswers' => 'Respuestas',
        ];
    }

    /**
     * Gets query for [[PollAnswer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPollAnswers()
    {
        return $this->hasMany(PollAnswer::className(), ['idPoll' => 'id']);
    }

    public function load($request, $formName = null) {
        //print_r($request);die;
        $ret = parent::load($request, $formName);
        if($ret && $request['answers']) {
            $ret = $this->_populateAnswers ($request['answers']);
            //$this->dateSentInfoHotel = date ('Y-m-d H:i:s');
        }
        return $ret;
    }

    protected function _populateAnswers ($answers) {
        // Cambiarlo por variable miembro con sufijo ToSave
        $pollAnswers = [];
        foreach ($answers as $answer) {
            $answ = new PollAnswer();
            $answ->idPoll = $this->id;
            $answ->answerText = $answer;
            $pollAnswers[] = $answ;
        }
        $this->pollAnswers = $pollAnswers;
        return true;
    }

    public static function getPolls($map = true) {
        $polls = Poll::find()->all();
        if ($map) $polls = ArrayHelper::map($polls, 'id', 'pkey');
        return $polls;
    }

    public static function findByKey ($key) {
        $poll = Poll::findOne(['pkey' => $key]);
        return $poll;
    }

    public function readVotes() {
        foreach ($this->pollAnswers as $pollAnswer) {
            $pollAnswer->readVotes();
        }
        $total = $this->getTotalVotes();
        foreach ($this->pollAnswers as $pollAnswer) {
            $pollAnswer->setVotesPercentage($total > 0? $pollAnswer->votes / $total * 100: 0);
        }
    }

    public function getTotalVotes() {
        $total = 0;
        foreach ($this->pollAnswers as $pollAnswer) {
            $total += $pollAnswer->votes;
        }
        return $total;
    }
}
