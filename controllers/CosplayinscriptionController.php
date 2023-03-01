<?php

namespace app\controllers;

use app\models\Event;
use Yii;
use app\models\CosplayInscription;
use app\models\CosplayInscriptionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CosplayinscriptionController implements the CRUD actions for CosplayInscription model.
 */
class CosplayinscriptionController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CosplayInscription models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CosplayInscriptionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'events' => CosplayInscription::getEvents(true),
            'categories' => CosplayInscription::getCategories(),
        ]);
    }

    /**
     * Displays a single CosplayInscription model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CosplayInscription model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CosplayInscription();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'events' => CosplayInscription::getEvents(true),
            'categories' => CosplayInscription::getCategories(),
            'soundtrackvalues' => CosplayInscription::getSoundtrackValues(),
        ]);
    }

    /**
     * Updates an existing CosplayInscription model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'events' => CosplayInscription::getEvents(true),
            'categories' => CosplayInscription::getCategories(),
            'soundtrackvalues' => CosplayInscription::getSoundtrackValues(),
        ]);
    }

    /**
     * Deletes an existing CosplayInscription model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CosplayInscription model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CosplayInscription the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = CosplayInscription::find()->select ('cif_cosplay_inscriptions.*, cif_events.name eventName')->joinWith('idEvent0')->where (['cif_cosplay_inscriptions.id' => $id])->one();
        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function getFreeAccessActions() {
        return ['signup'];
    }

    public function actionSignup() {
        $idEvent = $this->_getEventId(true);
        $show = strlen ($idEvent);
        $model = new CosplayInscription();
        $model->idEvent = $idEvent;
        $created = false;
        /*echo "<li>$show";
        echo "<li>".$model->load(Yii::$app->request->post(), '');
        die;*/
        if ($show && $model->load(Yii::$app->request->post(), '') && $model->save()) {
            $created = true;
        }
        return $this->render('signup', [
            'show' => $show,
            'created' => $created,
            'categories' => CosplayInscription::getCategories(),
            'soundtrackvalues' => CosplayInscription::getSoundtrackValues(),
            'csrfName' => Yii::$app->request->csrfParam,
            'csrfValue' => Yii::$app->request->getCsrfToken(),
            ]);
    }

    protected function _getEventId($checkdate) {
	    $idEvent = Yii::$app->session->get('Attendee.idEvent');
	    if (!strlen ($idEvent)) $idEvent = Event::getIdNextEvent();
        if (!strlen ($idEvent)) $idEvent = Event::getIdLastEvent();
        if (strlen ($idEvent)) {
            $event = Event::findOne ($idEvent);
            if ($checkdate && ($event->dateEndCosplaySignup < date ('Y-m-d') ) ) {
                $idEvent = null;
            }
        }
        return $idEvent;
    }

    public function actionReport() {
        $idEvent = $this->_getEventId(false);
        $inscriptionsq = CosplayInscription::find()->andFilterEvent($idEvent)->active()->orderByCat();
        $inscriptions = $inscriptionsq->all();

        return $this->render ('report', [
            'inscriptions' => $inscriptions,
        ]);
    }

    public function getReportTitle() {
        return 'Inscripciones al concurso de cosplay';
    }

    public function getSignupTitle() {
        return 'Cosplay - ¡Apúntate al concurso! - CifiMad';
    }
}
