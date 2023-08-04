<?php

namespace app\controllers;

use app\models\Poll;
use app\models\PollAnswer;
use app\models\PollAnswerVote;
use app\models\PollSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Cookie;
use yii\filters\VerbFilter;

/**
 * PollController implements the CRUD actions for Poll model.
 */
class PollController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Poll models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PollSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Poll model.
     * @param int $id Identificador
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Poll model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Poll();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Poll model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id Identificador
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Poll model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id Identificador
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Poll model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id Identificador
     * @return Poll the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Poll::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function getFreeAccessActions() {
        return ['vote', 'result'];
    }

    public function getSignupTitle() {
        return 'Encuesta - CifiMad';
    }

    public function actionVote ($key) {
        $voted = false;
        $model = Poll::findByKey ($key);
        if ($model != null) {
            if ($this->_hasAlreadyVoted ($model->id) ) {
                $voted = true;
            } else {
                $idPollAnswer = $this->request->post('idPollAnswer');
                if (!empty ($idPollAnswer)) {
                    if ($idPollAnswer == '_new') {
                        $idPollAnswer = $this->_saveNewAnswer();
                    }
                    $vote = $this->_makePollAnswerVote($model->id, $idPollAnswer);
                    if ($vote->save()) {
                        return $this->actionResult($key, true);
                    }
                }
            }
        }
        return $this->render('vote', [
            'model' => $model,
            'csrfName' => $this->request->csrfParam,
            'csrfValue' => $this->request->getCsrfToken(),
            'voted' => $voted,
        ]);
    }

    protected function _saveNewAnswer() {
        $answer = new PollAnswer();
        $answer->idPoll = $this->request->post('idPoll');
        $answer->answerText = $this->request->post('newAnswerText');
        $answer->save();
        return $answer->id;
    }

    protected function _makePollAnswerVote ($idPoll, $idPollAnswer) {
        $vote = new PollAnswerVote();
        $vote->idPollAnswer = $idPollAnswer;
        $vote->cookieValue = $this->_makeCookieGetValue ($idPoll);
        $vote->ipAddresses = $this->_getIpAddresses();
        return $vote;
    }

    protected function _hasAlreadyVoted ($idPoll) {
        $cookie = $this->_makeCookieGetValue ($idPoll);
        $answers = PollAnswerVote::getAlreadyVotedAnswer ($idPoll, $cookie);
        return !empty ($answers);
    }

    protected function _makeCookieGetValue ($idPoll) {
        $cookieName = 'CifiMadPoll' . $idPoll;
        $cookieValue = $this->request->cookies->getValue($cookieName);
        if (empty ($cookieValue)) {
            $cookieValue = 'CFM' . uniqid('pl');
            $expire = strtotime('+1 month');
            $this->response->cookies->add (new Cookie (['name' => $cookieName, 'value' => $cookieValue, 'expire' => $expire]));
        }
        return $cookieValue;
    }

    protected function _getIpAddresses() {
        return $this->request->getRemoteIP();
    }

    public function actionResult ($key, $votedok = false) {
        $model = Poll::findByKey ($key);
        if ($model != null) {
            $model->readVotes();
        }
        return $this->render('result', [
            'model' => $model,
            'votedok' => $votedok,
        ]);
    }
}
