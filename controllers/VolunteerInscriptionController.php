<?php

namespace app\controllers;

use Yii;
use app\models\VolunteerInscription;
use app\models\VolunteerInscriptionSearch;
use app\models\VolunteerInscriptionFunction;
use app\models\VolunteerInscriptionShift;
use app\models\Event;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VolunteerInscriptionController implements the CRUD actions for VolunteerInscription model.
 */
class VolunteerInscriptionController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all VolunteerInscription models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VolunteerInscriptionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'events' => VolunteerInscription::getEvents(true),
        ]);
    }

    /**
     * Displays a single VolunteerInscription model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new VolunteerInscription model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VolunteerInscription();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'events' => VolunteerInscription::getEvents(true),
	            'computersLevels' => VolunteerInscription::getComputersLevels(),
            ]);
        }
    }

    /**
     * Updates an existing VolunteerInscription model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'events' => VolunteerInscription::getEvents(true),
                'computersLevels' => VolunteerInscription::getComputersLevels(),
            ]);
        }
    }

    /**
     * Deletes an existing VolunteerInscription model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the VolunteerInscription model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VolunteerInscription the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
	    $model = VolunteerInscription::find()->select ('cif_volunteer_inscriptions.*, cif_events.name eventName')->joinWith('idEvent0')->where (['cif_volunteer_inscriptions.id' => $id])->one();
        if ($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

	public function getFreeAccessActions() {
		return ['signup'];
	}

	public function actionSignup() {
		$idEvent = $this->_getEventId(true);
		$show = strlen ($idEvent);
		$model = new VolunteerInscription();
		$model->idEvent = $idEvent;
		$created = false;
		/*echo "<li>$show";
		echo "<li>".$model->load(Yii::$app->request->post(), '');
		die;*/
		$errors = '';
		if ($show && $model->load(Yii::$app->request->post(), '') && $model->save()) {
			$created = true;
		}
		$err = $model->getErrors();
		if (!empty ($err)) $errors = print_r($err,true);
		return $this->render('signup', [
			'show' => $show,
			'created' => $created,
			'csrfName' => Yii::$app->request->csrfParam,
			'csrfValue' => Yii::$app->request->getCsrfToken(),
			'functions' => VolunteerInscriptionFunction::getFunctions(),
			'shifts' => VolunteerInscriptionShift::getShifts(),
			'errors' => $errors,
		]);
	}

	protected function _getEventId($checkdate) {
		$idEvent = Event::getIdNextEvent();
		if (!strlen ($idEvent)) $idEvent = Event::getIdLastEvent();
		if (strlen ($idEvent)) {
			$event = Event::findOne ($idEvent);
			// Pendiente: decidir cuándo es la fecha de corte para voluntarios
			if ($checkdate && ($event->dateEndCosplaySignup < date ('Y-m-d') ) ) {
				$idEvent = null;
			}
		}
		return $idEvent;
	}

	public function actionReport() {
		$idEvent       = $this->_getEventId( false );
		$inscriptionsq = VolunteerInscription::find()->andFilterEvent( $idEvent )->active()->orderByName();
		$inscriptions  = $inscriptionsq->all();

		return $this->render( 'report', [
			'inscriptions' => $inscriptions,
			'functions'    => VolunteerInscriptionFunction::getFunctions(),
			'shifts'       => VolunteerInscriptionShift::getShifts(),
		] );
	}

	public function getReportTitle() {
		return 'Inscripciones de voluntarios';
	}
}
