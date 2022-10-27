<?php

namespace app\controllers;

use app\models\Poll;
use app\models\PollAnswer;
use app\models\PollAnswerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PollAnswerController implements the CRUD actions for PollAnswer model.
 */
class PollAnswerController extends Controller
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
     * Lists all PollAnswer models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PollAnswerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'polls' => Poll::getPolls(),
        ]);
    }

    /**
     * Displays a single PollAnswer model.
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
     * Creates a new PollAnswer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new PollAnswer();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'polls' => Poll::getPolls(),
        ]);
    }

    /**
     * Updates an existing PollAnswer model.
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
            'polls' => Poll::getPolls(),
        ]);
    }

    /**
     * Deletes an existing PollAnswer model.
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
     * Finds the PollAnswer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id Identificador
     * @return PollAnswer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = PollAnswer::find()->select ('cif_polls_answers.*, cif_polls.pkey pollKey')->joinWith('idPoll0')->where (['cif_polls_answers.id' => $id])->one();
        //if (($model = PollAnswer::findOne(['id' => $id])) !== null) {
        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
