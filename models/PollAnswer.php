<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cif_polls_answers".
 *
 * @property int $id
 * @property int $idPoll
 * @property string|null $answerText
 *
 * @property PollAnswerVote[] $pollAnswerVotes
 * @property Poll $idPoll0
 */
class PollAnswer extends \yii\db\ActiveRecord
{

    public $pollKey;
    public $votes;
    public $votesPercentage;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cif_polls_answers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idPoll'], 'required'],
            [['idPoll'], 'integer'],
            [['answerText'], 'string', 'max' => 255],
            [['idPoll'], 'exist', 'skipOnError' => true, 'targetClass' => Poll::className(), 'targetAttribute' => ['idPoll' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Identificador',
            'idPoll' => 'Encuesta',
            'pollKey' => 'Encuesta',
            'answerText' => 'Texto de la respuesta',
        ];
    }

    /**
     * Gets query for [[PollAnswerVote]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPollAnswerVotes()
    {
        return $this->hasMany(PollAnswerVote::className(), ['idPollAnswer' => 'id']);
    }

    /**
     * Gets query for [[IdPoll0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdPoll0()
    {
        return $this->hasOne(Poll::className(), ['id' => 'idPoll']);
    }

    public function readVotes() {
        $votes = $this->getPollAnswerVotes()->all();
        $this->votes = count ($votes);
    }

    public function setVotesPercentage($percentage) {
        $this->votesPercentage = number_format ($percentage, 2, ',', '.');
    }
}
