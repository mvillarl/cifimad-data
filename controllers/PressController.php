<?php

namespace app\controllers;

use Yii;
use app\models\Press;
use app\models\PressSearch;
use webvimark\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PressController implements the CRUD actions for Press model.
 */
class PressController extends BaseController
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
     * Lists all Press models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PressSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'sources' => Press::getSources(true),
        ]);
    }

    /**
     * Displays a single Press model.
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
     * Creates a new Press model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Press();
	    $model->setKey();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'sources' => Press::getSources(true),
            ]);
        }
    }

    /**
     * Updates an existing Press model.
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
                'sources' => Press::getSources(true),
            ]);
        }
    }

    /**
     * Deletes an existing Press model.
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
     * Finds the Press model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Press the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
	    $model = Press::find()->select ('cif_press.*, cif_sources.name sourceName')->joinWith('idSource0')->where (['cif_press.id' => $id])->one();
        if ($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionExport($consent = '1') {
	    $models = Press::find()->select ('cif_press.*, cif_sources.name sourceName')->joinWith('idSource0')->where ('status = true AND consent = :consent', ['consent' => $consent])->all();
	    $filename = "PrensaCifimad".date("Ymd").".xls";
	    Yii::$app->response->setDownloadHeaders($filename, "application/vnd.ms-excel");
	    return $this->render( 'export',[
		    'press' => $models,
	    ] );
    }

	public function actionConsent($key, $email) {
		$q = Press::find()->where (['and', 'keyCheck = :key', 'email = :email'], ['key' => $key, 'email' => $email]);
		$members = $q->all();
		if (count ($members)) {
			$members[0]->consent = true;
			$members[0]->save();
			$ok = true;
		} else {
			$ok = false;
		}
		return $this->render( 'consent',[
			'ok' => $ok
		]);
	}

	public function getFreeAccessActions() {
		return ['consent'];
	}
}
