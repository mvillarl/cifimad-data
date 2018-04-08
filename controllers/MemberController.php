<?php

namespace app\controllers;

use Yii;
use app\models\Member;
use app\models\MemberSearch;
use webvimark\components\BaseController;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\PS2Customer;
use app\models\PS2CustomerDP;
use app\models\WPUser;
use app\models\Attendee;

/**
 * MemberController implements the CRUD actions for Member model.
 */
class MemberController extends BaseController
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
     * Lists all Member models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MemberSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Member model.
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
     * Creates a new Member model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Member();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Member model.
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
            ]);
        }
    }

    /**
     * Deletes an existing Member model.
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
     * Finds the Member model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Member the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Member::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLoad() {
        $eventsd = Attendee::getEvents(true);
        $events[''] = '-- Evento --';
        //$events = array_merge ($events, $eventsd);
        $events = $events + $eventsd;

        $sourcesd = Attendee::getSources(true);
        $sources[''] = '-- Procedencia --';
        //$sources = array_merge ($sources, $sourcesd);
	    $sources = $sources + $sourcesd;

        $tickettypes = Attendee::getTicketTypes();
        $tickettypes[''] = '-- Tipo de entrada --';

        $memberdata = Yii::$app->request->post( 'memberdata' );
        if ( strlen( $memberdata ) ) {
            //echo ord($sources[24]).'<pre>'.str_replace ('\n', '<br>', $sources); die;
            //echo str_replace ('\n', '<br>', $sources); die;
            $memberlines = explode( "\n", str_replace( "\r", '', $memberdata ) );
            $ok          = true;
	        $models = [];
            foreach ( $memberlines as $line ) {
                if ( strlen( $line ) ) {
                    $fieldvalues    = explode( "\t", $line );
                    $model          = new Member();
                    $model->name    = $fieldvalues[0];
                    $model->surname = $fieldvalues[1];
                    $model->email   = $fieldvalues[2];
                    $model->nif     = $fieldvalues[3];
                    $ok             = $model->save();
	                $models[] = $model;
                    if ( ! $ok ) {
                        break;
                    }
                }
            }
            if ( $ok ) {
	            $idEvent = Yii::$app->request->post( 'idEvent' );
	            $idSource = Yii::$app->request->post( 'idSource' );
	            $idTicketType = Yii::$app->request->post( 'idTicketType' );

	            if (strlen ($idEvent) && strlen ($idSource) && strlen ($idTicketType)) {
		            foreach ($models as $model) {
	            		$modelattendee = new Attendee();
			            $modelattendee->idMember = $model->id;
			            $modelattendee->status = '1';
			            $modelattendee->idEvent = $idEvent;
			            $modelattendee->idSource = $idSource;
			            $modelattendee->ticketType = $idTicketType;
			            $ok = $modelattendee->save();
			            if ( ! $ok ) {
				            break;
			            }
		            }
	            }
            }
            if ( $ok ) {
                return $this->redirect( [ 'index' ] );
            } else {
                return $this->render( 'load', ['events' => $events, 'sources' => $sources, 'tickettypes' => $tickettypes, 'model' => $model,  'error' => $model->getErrors()] );
            }
        } else {
            return $this->render( 'load', ['events' => $events, 'sources' => $sources, 'tickettypes' => $tickettypes] );
        }
    }

    public function actionLoadfromwp ($filter = '') {
		return $this->_loadfromshop('WP', $filter, 'Wordpress', 'loadfromwp', WPUser::find(), 'user_email');
    }

    public function actionLoadfromps($filter = '') {
	    return $this->_loadfromshop('PS', $filter, 'Prestashop', 'loadfromps', PS2Customer::find(), 'email');
    }

    protected function _loadfromshop ($part, $filter, $shop, $command, $aq, $emfield) {
        $date = Member::getLastLoadFrom($part);
        if (strlen ($date) ) {
            $tdate = Yii::$app->formatter->asDatetime($date);
        }
        $qcustomers = $aq->modifiedAfter($date)->indexBy($emfield);
        $customers = $qcustomers->all();
        $ncustomers = $qcustomers->count();
        Member::membersMatchCustomers(Member::find()->indexBy('email')->all(), $customers, $matching, $nomatch);
        //die('<pre>'.print_R($customers,true));
        $matchingDP = new PS2CustomerDP($matching);
        $numberNoMatch = count ($nomatch);

        if ( ($filter == 'n') || ($filter == 'a') ) {
            $customerstoupsert = ($filter == 'n')? $nomatch: $customers;
	        /*echo "<li>".$customerstoupsert[0]->dni;
	        echo "<li>".$customerstoupsert[0]->phone_mobile;
	        die;
	        echo "<pre>"; print_r($customerstoupsert); die;*/
            Member::upsertMembersFromCustomers($customerstoupsert, $stats, $errors);
            Member::setLastLoadFrom($part);
        }

        return $this->render( 'loadfromps', [
        	'shop' => $shop,
            'command' => $command,
            'tdate' => $tdate,
            'ncustomers' => $ncustomers,
            'newcustomers' => $numberNoMatch,
            'existingcustomers' => $matchingDP->getTotalCount(),
            'filter' => $filter,
            'matching' => $matchingDP,
            'upsertTotal' => $stats['total'],
            'upsertInserted' => $stats['inserted'],
            'upsertModified' => $stats['modified'],
            'upsertWithErrors' => $stats['witherrors'],
            'errors' => $errors,
            'model' => new Member(),
        ]);
    }

    public function actionExport($onlydni = false) {
        $q = Member::find()->orderBy(['surname' => 'ASC', 'name' => 'ASC']);
        if ($onlydni == 'O') $q->where('nif IS NOT NULL');
        if ($onlydni == 'M') $q->where('email IS NOT NULL');
	    $q->where('status = true');
        $members = $q->all();
        $filename = "SociosCifimad".date("Ymd").".xls";
        Yii::$app->response->setDownloadHeaders($filename, "application/vnd.ms-excel");
        return $this->render( 'export',[
            'members' => $members,
        ] );
    }

    public function actionAjaxsearch ($term) {
        $memberresult = Member::termSearch ($term);
        return Json::encode($memberresult);
    }
}
