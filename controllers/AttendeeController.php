<?php

namespace app\controllers;

use app\models\Event;
use Yii;
use app\models\Attendee;
use app\models\AttendeeSearch;
use webvimark\components\BaseController;
use webvimark\modules\UserManagement\models\User;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use app\components\DateFunctions;

/**
 * AttendeeController implements the CRUD actions for Attendee model.
 */
class AttendeeController extends BaseController
{
    /*public function __construct( $id, Module $module, array $config ) {
        parent::__construct( $id, $module, $config );
    }*/

    protected function getCurrentEvent() {
        $idEvent = Yii::$app->session->get('Attendee.idEvent');
        if (!strlen ($idEvent)) $idEvent = Event::getIdNextEvent();
        if (!strlen ($idEvent)) $idEvent = Event::getIdLastEvent();
        return $idEvent;
    }

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
     * Lists all Attendee models.
     * @return mixed
     */
    public function actionIndex()
    {
        // id evento: de form búsqueda, si no sesión, si no el primero a futuro
        // guardar en sesión
        $idEvent = Yii::$app->request->get('AttendeeSearch')['idEvent'];
        if (!strlen ($idEvent)) $idEvent = $this->getCurrentEvent();
        Yii::$app->session->set('Attendee.idEvent', $idEvent);

        $guests = Attendee::getGuests($idEvent);
        $products = Attendee::getProducts($idEvent);

        $searchModel = new AttendeeSearch();
        $searchModel->setEvent($idEvent, $guests, $products);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

	    $errors = Attendee::checkErrors($idEvent);

	    $view = User::hasRole ('desk', false)? 'indexdesk': 'index';

        return $this->render($view, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'ticketTypes' => Attendee::getTicketTypes(),
            'status' => Attendee::getStatusMap(),
            'events' => Attendee::getEvents(true),
            'sources' => Attendee::getSources(true),
	        'errors' => $errors,
        ]);
    }

    /**
     * Displays a single Attendee model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $idEvent = $this->getCurrentEvent();
        $guests = Attendee::getGuests($idEvent);
	    $products = Attendee::getProducts($idEvent);
        $model = $this->findModel($id);
        $model->setEvent($idEvent, $guests, $products);

	    $view = User::hasRole ('desk', false)? 'viewdesk': 'view';

        return $this->render($view, [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Attendee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $idEvent = $this->getCurrentEvent();
        $guests = Attendee::getGuests($idEvent);
	    $products = Attendee::getProducts($idEvent);
        $model = new Attendee();
	    //$model->setUpdatedFlag();
        $model->setEvent($idEvent, $guests, $products);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'events' => Attendee::getEvents(true),
                'sources' => Attendee::getSources(true),
            ]);
        }
    }

    /**
     * Updates an existing Attendee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $idEvent = $this->getCurrentEvent();
        $guests = Attendee::getGuests($idEvent);
	    $products = Attendee::getProducts($idEvent);
        $model = $this->findModel($id);
        $model->setEvent($idEvent, $guests, $products);

	    $post = Yii::$app->request->post();
	    if ($post['updateFlag']) {
		    $model->setUpdatedFlag();
	    }
	    if ($post['updateHotelFlag']) {
		    $model->setUpdatedHotelFlag();
	    }
	    if ($post['updateBadgesFlag']) {
		    $model->setUpdatedBadgesFlag();
	    }
	    if ($post['updateBadgesTicketsFlag']) {
		    $model->setUpdatedBadgesTicketsFlag();
	    }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'events' => Attendee::getEvents(true),
                'sources' => Attendee::getSources(true),
            ]);
        }
    }

    /**
     * Deletes an existing Attendee model.
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
     * Finds the Attendee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Attendee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Attendee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAjaxsearch ($term) {
	    $idEvent = $this->getCurrentEvent();
        $attendeeresult = Attendee::termSearch ($term, $idEvent);
        return Json::encode($attendeeresult);
    }

    public function actionReportbadgelabels($afterprint = false, $showinfotickets = false) {
	    $idEvent = $this->getCurrentEvent();
        $attq = Attendee::find()->andFilterEvent($idEvent);
	    /*if ($afterprint) $attq->notCanceled();
        else $attq->confirmed();*/
	    $attq->notCanceled();
	    $attq->orderBadgeLabelReport();
        if ($afterprint) {
        	$part = $showinfotickets? 'BadgesTickets': 'Badges';
            $event   = Event::findOne( $idEvent );
            $attq->afterDate( $event->dateBadgesPrinted, $part);
        }
        $attendees = $attq->all();
        $guests = Attendee::getGuests($idEvent);
        $extraproducts = Attendee::getProducts($idEvent);

        return $this->render('reportbadgelabels', [
            'attendees' => $attendees,
            'subtitle' => 'Etiquetas para acreditaciones',
            'afterprint' => $afterprint,
            'showinfotickets' => $showinfotickets,
            'idEvent' => $idEvent,
            'guests' => $guests,
            'extraproducts' => $extraproducts,
        ]);
        
    }

    public function actionReportbadges($detailed = false) {
	    $idEvent = $this->getCurrentEvent();
        $attq = Attendee::find()->andFilterEvent($idEvent)->orderBadgeReport($detailed);
        $attendees = $attq->all();

        switch ($detailed) {
            case 'A':
                $view = 'reportbadgesclubs';
                $subtitle = 'Listas de asociaciones';
                break;
            case 'D':
                $view = 'reportbadgesdet';
                $subtitle = 'Reservas - fotos, firmas, cartones';
                break;
            case 'M':
                $view = 'reportbadgesmealstable';
                $subtitle = 'Reservas - cenas y comidas';
                break;
            default:
                $view = 'reportbadges';
                $subtitle = 'Reservas';
                break;
        }
	    //$view = $detailed? 'reportbadgesdet': 'reportbadges';
	    //$subtitle = $detailed? 'Reservas - fotos, firmas, cartones': 'Reservas';

        $guests = Attendee::getGuests($idEvent);
        $extraproducts = Attendee::getProducts($idEvent);
        $model = new Attendee();
        $model->setEvent($idEvent, $guests, $extraproducts);
        $fields = $model->getGuestFields();
        $pfields = $model->getExtraProductFields();

        return $this->render($view, [
            'attendees' => $attendees,
            'subtitle' => $subtitle,
            'guests' => $guests,
            'extraproducts' => $extraproducts,
            'model' => $model,
            'fields' => $fields,
            'pfields' => $pfields,
        ]);
    }

    public function actionReporthotel($aftersend = false) {
    	$meals = false;
    	if ($aftersend == 'M') {
    		$aftersend = false;
		    $meals = true;
	    }

	    $idEvent = $this->getCurrentEvent();
	    $guests = Attendee::getGuests($idEvent);

	    $mindate = $guests[0]->dateArrival;
	    $maxdate = $guests[0]->dateDeparture;
	    foreach ($guests as $guest) {
	        if ($guest->dateArrival < $mindate) $mindate = $guest->dateArrival;
	        if ($guest->dateDeparture > $maxdate) $maxdate = $guest->dateDeparture;
	    }

	    $attendeerooms = Attendee::getAttendeeRooms( $idEvent, $aftersend, $numattendees );

	    $numattendees += count ($guests);

	    $fridayDinner = Attendee::find()->andFilterEvent($idEvent)->andCocktail()->notCanceled()->all();
	    $saturdayDinner = Attendee::find()->andFilterEvent($idEvent)->andGala()->notCanceled()->all();

	    $event   = Event::findOne( $idEvent );
	    $friday = $event->dateStart;
	    $saturday = DateFunctions::dateAdd($friday, 1);
	    foreach ($guests as $guest) {
		    $companions = $guest->getCompanions();
		    /*if (count ($companions)) {
		    	echo "<pre>"; print_r($companions); die;
		    }*/
		    foreach ($companions as $companion) {
		    	$attComp = new \stdClass();
			    $attComp->attendeeName = $companion->fullname;
			    $attComp->memberName = '';
			    $attComp->remarksMeals = $companion->remarksMeals;
			    if ( ($guest->dateArrival <= $friday) && ($friday <= $guest->dateDeparture) ) {
				    array_unshift($fridayDinner, $attComp);
			    }
			    if ( ($guest->dateArrival <= $saturday) && ($saturday <= $guest->dateDeparture) ) {
				    array_unshift( $saturdayDinner, $attComp );
			    }
		    }
		    $attGuest = new \stdClass();
		    $attGuest->attendeeName = $guest->fullname;
		    $attGuest->memberName = '';
		    $attGuest->remarksMeals = $guest->remarksMeals;
		    //$attGuest->remarksMealSaturday = $guest->remarksMealSaturday;
		    if ( ($guest->dateArrival <= $friday) && ($friday <= $guest->dateDeparture) ) {
			    //echo "<li>Incluyo a " . $guest->name . " en viernes pq " . $event->dateStart . " <= " . $guest->dateArrival;
			    array_unshift($fridayDinner, $attGuest);
		    }
		    if ( ($guest->dateArrival <= $saturday) && ($saturday <= $guest->dateDeparture) ) {
			    //echo "<li>Incluyo a " . $guest->name . " en sábado pq " . $event->dateStart . " < " . $guest->dateArrival;
			    array_unshift( $saturdayDinner, $attGuest );
		    }
	    }

	    $saturdayLunch = Attendee::find()->andFilterEvent($idEvent)->andSaturdayLunch()->notCanceled()->all();
	    $sundayLunch = Attendee::find()->andFilterEvent($idEvent)->andSundayLunch()->notCanceled()->all();
	    $sundayDinner = Attendee::find()->andFilterEvent($idEvent)->andSundayDinner()->notCanceled()->all();

	    $view = $meals? 'reporthotelmeals': 'reporthotel';
        $mealsummary = array (
            'fridayDN' => count ($fridayDinner),
		    'fridayRemarks' => [],
            'saturdayDN' => count ($saturdayDinner),
		    'saturdayRemarks' => [],
		    'saturdayLN' => count($saturdayLunch),
		    'sundayLN' => count($sundayLunch),
		    'sundayDN' => count($sundayDinner),
	    );
	    foreach ($fridayDinner as $fd) {
	        if (!strlen ($fd->remarksMeals)) continue;
		    if (isset ($mealsummary['fridayRemarks'][$fd->remarksMeals]) ) $mealsummary['fridayRemarks'][$fd->remarksMeals]++;
		    else $mealsummary['fridayRemarks'][$fd->remarksMeals] = 1;
	    }

	    //echo "<pre>"; print_r($saturdayDinner); echo "</pre>";
	    foreach ($saturdayDinner as $sd) {
		    if (!strlen ($sd->remarksMeals) && !strlen ($sd->remarksMealSaturday)) continue;
		    if (strlen ($sd->remarksMeals) ) {
		    	if (isset ($mealsummary['saturdayRemarks'][$sd->remarksMeals]) ) $mealsummary['saturdayRemarks'][$sd->remarksMeals]++;
			    else $mealsummary['saturdayRemarks'][$sd->remarksMeals] = 1;
		    }
		    if (strlen ($sd->remarksMealSaturday) ) {
			    if ( isset ( $mealsummary['saturdayRemarks'][ $sd->remarksMealSaturday ] ) ) $mealsummary['saturdayRemarks'][$sd->remarksMealSaturday]++;
			    else $mealsummary['saturdayRemarks'][ $sd->remarksMealSaturday ] = 1;
		    }
	    }

	    return $this->render($view, [
		    'attendeerooms' => $attendeerooms,
		    'guests' => $guests,
		    'guestsmindate' => $mindate,
		    'guestsmaxdate' => $maxdate,
		    'totallodged' => $numattendees,
		    'totalrooms' => count ($attendeerooms),
		    'fridayDinner' => $fridayDinner,
		    'saturdayDinner' => $saturdayDinner,
		    'saturdayLunch' => $saturdayLunch,
		    'sundayLunch' => $sundayLunch,
		    'sundayDinner' => $sundayDinner,
		    'mealsummary' => $mealsummary,
	    ]);

    }

	public function actionReportincomes() {
		$idEvent = $this->getCurrentEvent();

		$guests = Attendee::getGuests($idEvent);
		$attendeeincomes = Attendee::getAttendeeIncomes ($idEvent);
		return $this->render('reportincomes', [
			'incomes' => $attendeeincomes,
			'guests' => $guests,
		]);
	}
}
