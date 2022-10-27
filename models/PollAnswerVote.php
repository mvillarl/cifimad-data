<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cif_polls_answers_votes".
 *
 * @property int $id
 * @property int $idPollAnswer
 * @property string|null $cookieValue
 * @property string|null $ipAddresses
 *
 * @property PollsAnswer $idPollAnswer0
 */
class PollAnswerVote extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cif_polls_answers_votes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idPollAnswer'], 'required'],
            [['idPollAnswer'], 'integer'],
            [['cookieValue', 'ipAddresses'], 'string', 'max' => 100],
            [['idPollAnswer'], 'exist', 'skipOnError' => true, 'targetClass' => PollAnswer::className(), 'targetAttribute' => ['idPollAnswer' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Identificador',
            'idPollAnswer' => 'Respuesta',
            'cookieValue' => 'Valor de cookie',
            'ipAddresses' => 'Direcciones IP',
        ];
    }

    /**
     * Gets query for [[IdPollAnswer0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdPollAnswer0()
    {
        return $this->hasOne(PollAnswer::className(), ['id' => 'idPollAnswer']);
    }


    public static function getAlreadyVotedAnswer ($idPoll, $cookie) {
        $query = PollAnswerVote::find()->select ('cif_polls_answers_votes.id, cif_polls_answers.id')->joinWith('idPollAnswer0');
        $query->andFilterWhere([
            'idPoll' => $idPoll,
            'cookieValue' => $cookie,
        ]);
        $answer = $query->all();
        return $answer;
    }
}
