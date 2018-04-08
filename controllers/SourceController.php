<?php

namespace app\controllers;

use Yii;
use app\models\Source;
use app\models\SourceSearch;
//use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use webvimark\components\BaseController;

/**
 * SourceController implements the CRUD actions for Source model.
 */
class SourceController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $b = parent::behaviors();
        $b['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'delete' => ['POST'],
            ]
        ];
        return $b;
    }

    /**
     * Lists all Source models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SourceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Source model.
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
     * Creates a new Source model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Source();

	    if (Yii::$app->request->isPost) {
		    $model->imageFileObj = UploadedFile::getInstance( $model, 'imageFileObj' );
		    $model->upload();
	    }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Source model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

	    if (Yii::$app->request->isPost) {
		    $model->imageFileObj = UploadedFile::getInstance( $model, 'imageFileObj' );
		    $model->upload();
	    }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Source model.
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
     * Finds the Source model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Source the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Source::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLoad() {
        $sources = Yii::$app->request->post('sources');
        if (strlen ($sources)) {
            //echo ord($sources[24]).'<pre>'.str_replace ('\n', '<br>', $sources); die;
            //echo str_replace ('\n', '<br>', $sources); die;
            $asources = explode("\n", str_replace ("\r", '', $sources));
            $ok = true;
            foreach ($asources as $sname) {
                if (strlen ($sname)) {
                    $model = new Source();
                    $model->name = $sname;
                    $ok = $model->save();
                    if (!$ok) break;
                }
            }
            if ($ok) return $this->redirect(['index']);
            else return $this->render( 'load', ['error' => 'Err: '.print_r ($asources, true).print_r ($model->getErrors(), true) ] );
        } else {
            return $this->render( 'load' );
        }
    }
}
