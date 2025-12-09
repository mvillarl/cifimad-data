<?php

namespace app\controllers;

use Yii;
use app\models\Attendee;
use app\models\AttendeeSale;
use app\models\AttendeeSaleSearch;
use app\models\Event;
use app\models\Member;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AttendeeSaleController implements the CRUD actions for AttendeeSale model.
 */
class AttendeeSaleController extends Controller
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
     * Lists all AttendeeSale models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchData = Yii::$app->request->get('AttendeeSaleSearch');
        $idEvent = isset ($searchData['idEvent'])? $searchData['idEvent']: null;
        if (!strlen ($idEvent)) $idEvent = $this->getCurrentEvent();
        Yii::$app->session->set('Attendee.idEvent', $idEvent);

        $searchModel = new AttendeeSaleSearch();
        $searchModel->setEvent($idEvent);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

	    $isPandemic = Event::findOne($idEvent)->isPandemic;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'events' => Attendee::getEvents(true),
            'ticketTypes' => Attendee::getTicketTypes(),
            'vaccineOptions' => Member::getVaccineOptions(),
	        'isPandemic' => $isPandemic,
        ]);
    }

    /**
     * Displays a single AttendeeSale model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $idEvent = $this->getCurrentEvent();
        $model = $this->findModel($id);
        $model->setEvent($idEvent);
	    $isPandemic = Event::findOne($idEvent)->isPandemic;
        return $this->render('view', [
            'model' => $model,
            'isPandemic' => $isPandemic,
        ]);
    }

    /**
     * Creates a new AttendeeSale model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $idEvent = $this->getCurrentEvent();
        $model = new AttendeeSale();
        $model->setEvent($idEvent);
	    $isPandemic = Event::findOne($idEvent)->isPandemic;

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'events' => Attendee::getEvents(true),
            'isPandemic' => $isPandemic,
        ]);
    }

    /**
     * Updates an existing AttendeeSale model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $idEvent = $this->getCurrentEvent();
        $model = $this->findModel($id);
        $model->setEvent($idEvent);
	    $isPandemic = Event::findOne($idEvent)->isPandemic;

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'events' => Attendee::getEvents(true),
            'ticketTypes' => Attendee::getTicketTypes(),
            'isPandemic' => $isPandemic,
        ]);
    }

    /**
     * Deletes an existing AttendeeSale model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AttendeeSale model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return AttendeeSale the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = AttendeeSale::find()->select ('cif_attendee_sales.*, cif_events.name eventName')->joinWith('idEvent0')->where (['cif_attendee_sales.id' => $id])->one();
        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getCurrentEvent() {
        $idEvent = Yii::$app->session->get('Attendee.idEvent');
        if (!strlen ($idEvent)) $idEvent = Event::getIdNextEvent();
        if (!strlen ($idEvent)) $idEvent = Event::getIdLastEvent();
        return $idEvent;
    }
}
