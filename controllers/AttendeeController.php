<?php

namespace app\controllers;

use app\models\Event;
use Yii;
use app\models\Attendee;
use app\models\AttendeeSearch;
use app\models\Source;
use app\models\Member;
use webvimark\components\BaseController;
use webvimark\modules\UserManagement\models\User;
use yii\console\Application;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use app\components\DateFunctions;

/**
 * AttendeeController implements the CRUD actions for Attendee model.
 */
class AttendeeController extends BaseController
{
    protected $_reportTitle;

    public function getReportTitle() {
        return $this->_reportTitle;
    }

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
            'vaccineOptions' => Member::getVaccineOptions(),
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
            $view = User::hasRole ('desk', false)? 'updatedesk': 'update';
            return $this->render($view, [
                'model' => $model,
                'events' => Attendee::getEvents(true),
                'sources' => Attendee::getSources(true, $model->idSource),
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

    public function actionReporttickets ($afterprint = false) {
        $idEvent = $this->getCurrentEvent();
        $attq = Attendee::find()->andFilterEvent($idEvent);
        $attq->notCanceled();
        $attq->orderBadgeReport('T');
        if ($afterprint) {
            $event   = Event::findOne( $idEvent );
            $attq->afterDate( $event->dateBadgesPrinted, 'BadgesTickets');
        }

        $attendees = $attq->all();
        $guests = Attendee::getGuests($idEvent);
        $extraproducts = Attendee::getProducts($idEvent);
        if (!$afterprint) {
            foreach ( $guests as $guest ) {
                $companions = $guest->getCompanions();
                foreach ( $companions as $companion ) {
                    $compatt             = new \stdClass();
                    $compatt->idSource   = 'C';
                    $compatt->memberName = $companion->fullBadgeName;
                    array_unshift( $attendees, $compatt );
                }
            }
        }

        $model = new Attendee();
        $model->setEvent($idEvent, $guests,$extraproducts);
        $fields = $model->getGuestFields();
        $pfields = $model->getExtraProductFields();

        $this->_reportTitle = 'Informe asistentes - Tickets';
        return $this->render('reporttickets', [
            'attendees' => $attendees,
            'afterprint' => $afterprint,
            'idEvent' => $idEvent,
            //'guests' => $guests,
            //'extraproducts' => $extraproducts,
            'fields' => $fields,
            'pfields' => $pfields,
            'model' => $model,
        ]);
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

	    if (!$afterprint) {
		    foreach ( $guests as $guest ) {
			    $companions = $guest->getCompanions();
			    foreach ( $companions as $companion ) {
				    $compatt             = new \stdClass();
				    $compatt->idSource   = 'C';
				    $compatt->memberName = $companion->fullBadgeName;
				    array_unshift( $attendees, $compatt );
			    }
		    }
	    }

	    $blankBadges = Source::find()->andWhere ('blankBadges > 0')->all();

	    $badgesCifiKidsq = Attendee::find()->andFilterEvent($idEvent);
        $badgesCifiKidsq->andCifiKidsParticipantOrVolunteer();
        $badgesCifiKidsq->notCanceled();
        if ($afterprint) {
            $event   = Event::findOne( $idEvent );
            $badgesCifiKidsq->afterDate( $event->dateBadgesPrinted, 'Badges');
        }
        $badgesCifiKidsq->orderBadgeLabelReport();
        $badgesCifiKids = $badgesCifiKidsq->all();

	    $this->_reportTitle = 'Informe asistentes - Etiquetas para acreditaciones';

        return $this->render('reportbadgelabels', [
            'attendees' => $attendees,
            'afterprint' => $afterprint,
            'showinfotickets' => $showinfotickets,
            'idEvent' => $idEvent,
            'guests' => $guests,
            'extraproducts' => $extraproducts,
	        'blankBadges' => $blankBadges,
            'badgesCifiKids' => $badgesCifiKids,
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
        $this->_reportTitle = 'Informe asistentes - ' . $subtitle;
	    //$view = $detailed? 'reportbadgesdet': 'reportbadges';
	    //$subtitle = $detailed? 'Reservas - fotos, firmas, cartones': 'Reservas';

        $guests = Attendee::getGuests($idEvent);
        $extraproducts = Attendee::getProducts($idEvent);
        $model = new Attendee();
        $model->setEvent($idEvent, $guests, $extraproducts);
        $fields = $model->getGuestFields();
        $pfields = $model->getExtraProductFields();

        if ($detailed == 'M') {
        	$any = false;
	        foreach ( $guests as $guest ) {
		        $companions = $guest->getCompanions();
		        foreach ( $companions as $companion ) {
			        $compatt = new Attendee;
			        $compatt->name = $companion->name;
			        $compatt->surname = $companion->surname;
			        $compatt->badgeName = $companion->badgeName;
			        if (empty ($compatt->badgeName)) $compatt->badgeName = $companion->name;
			        $compatt->badgeSurname = $companion->badgeSurname;
			        if (empty ($compatt->badgeSurname)) $compatt->badgeSurname = $companion->surname;
			        $compatt->ticketType = 'F';
			        $compatt->remarksMeals = $companion->remarksMeals;
			        $compatt->remarksMealSaturday = $companion->remarksMealsSaturday;
			        $compatt->mealFridayDinner = !$companion->excludeFridayDinner;
			        $compatt->mealSaturdayLunch = true;
			        $compatt->mealSaturdayDinner = true;
			        $compatt->mealSundayLunch = true;
			        $any = true;
			        $attendees[] = $compatt;
		        }
	        }
	        if ($any) {
	        	usort ($attendees, [$this, 'sortAttendeesBadgesMeals']);
	        }
        }

        return $this->render($view, [
            'attendees' => $attendees,
            'guests' => $guests,
            'extraproducts' => $extraproducts,
            'model' => $model,
            'fields' => $fields,
            'pfields' => $pfields,
        ]);
    }

    public function actionReportreservations() {
        $idEvent = $this->getCurrentEvent();
        $attq = Attendee::find()->andFilterEvent($idEvent)->notCanceled();
        $attendees = $attq->all();

        $fridayDinner = 0;
        $saturdayDinner = 0;
        $saturdayLunch = 0;
        $sundayLunch = 0;
        $sundayDinner = 0;
        $lodgingSuites = 0;
        $lodgingSingles = 0;
        $lodgingDoubles = 0;
        $lodgingTriples = 0;
        $lodgingQuadruples = 0;
        $ticketsFriday = 0;
        $ticketsSaturday = 0;
        $ticketsSunday = 0;
        $ticketsWeekend = 0;
        $parking = 0;

        $attendeesRoomsCounted = [];
        foreach ($attendees as $attendee) {
            if ($attendee->mealFridayDinner) $fridayDinner++;
            if ($attendee->mealSaturdayDinner) $saturdayDinner++;
            if ($attendee->mealSaturdayLunch) $saturdayLunch++;
            if ($attendee->mealSundayLunch) $sundayLunch++;
            if ($attendee->mealSundayDinner) $sundayDinner++;
            if ($attendee->status != '2') {
                switch ($attendee->roomType) {
                    case 'U':
                        $lodgingSuites++;
                        break;
                    case 'I':
                    case '1':
                        $lodgingSingles++;
                        break;
                    case 'S':
                        if (!isset ($attendeesRoomsCounted[$attendee->id]) && !isset($attendeesRoomsCounted[$attendee->idAttendeeRoommate1])) {
                            $lodgingSuites++;
                            $attendeesRoomsCounted[$attendee->id] = true;
                            $attendeesRoomsCounted[$attendee->idAttendeeRoommate1] = true;
                        }
                    case 'D':
                    case '2':
                        if (!isset ($attendeesRoomsCounted[$attendee->id]) && !isset($attendeesRoomsCounted[$attendee->idAttendeeRoommate1])) {
                            $lodgingDoubles++;
                            $attendeesRoomsCounted[$attendee->id] = true;
                            $attendeesRoomsCounted[$attendee->idAttendeeRoommate1] = true;
                        }
                        break;
                    case 'N':
                        if (!isset ($attendeesRoomsCounted[$attendee->id]) && !isset($attendeesRoomsCounted[$attendee->idAttendeeRoommate1]) && !isset($attendeesRoomsCounted[$attendee->idAttendeeRoommate2])) {
                            $lodgingDoubles++;
                            $attendeesRoomsCounted[$attendee->id] = true;
                            $attendeesRoomsCounted[$attendee->idAttendeeRoommate1] = true;
                            $attendeesRoomsCounted[$attendee->idAttendeeRoommate2] = true;
                        }
                        break;
                    case 'T':
                        if (!isset ($attendeesRoomsCounted[$attendee->id]) && !isset($attendeesRoomsCounted[$attendee->idAttendeeRoommate1]) && !isset($attendeesRoomsCounted[$attendee->idAttendeeRoommate2])) {
                            $lodgingTriples++;
                            $attendeesRoomsCounted[$attendee->id] = true;
                            $attendeesRoomsCounted[$attendee->idAttendeeRoommate1] = true;
                            $attendeesRoomsCounted[$attendee->idAttendeeRoommate2] = true;
                        }
                        break;
                    case '4':
                        if (!isset ($attendeesRoomsCounted[$attendee->id]) && !isset($attendeesRoomsCounted[$attendee->idAttendeeRoommate1]) && !isset($attendeesRoomsCounted[$attendee->idAttendeeRoommate2]) && !isset($attendeesRoomsCounted[$attendee->idAttendeeRoommate3])) {
                            $lodgingTriples++;
                            $attendeesRoomsCounted[$attendee->id] = true;
                            $attendeesRoomsCounted[$attendee->idAttendeeRoommate1] = true;
                            $attendeesRoomsCounted[$attendee->idAttendeeRoommate2] = true;
                            $attendeesRoomsCounted[$attendee->idAttendeeRoommate3] = true;
                        }
                        break;
                    case 'Q':
                        if (!isset ($attendeesRoomsCounted[$attendee->id]) && !isset($attendeesRoomsCounted[$attendee->idAttendeeRoommate1]) && !isset($attendeesRoomsCounted[$attendee->idAttendeeRoommate2]) && !isset($attendeesRoomsCounted[$attendee->idAttendeeRoommate3])) {
                            $lodgingQuadruples++;
                            $attendeesRoomsCounted[$attendee->id] = true;
                            $attendeesRoomsCounted[$attendee->idAttendeeRoommate1] = true;
                            $attendeesRoomsCounted[$attendee->idAttendeeRoommate2] = true;
                            $attendeesRoomsCounted[$attendee->idAttendeeRoommate3] = true;
                        }
                        break;
                }
            }
            switch ($attendee->ticketType) {
                case 'V':
                    $ticketsFriday++;
                    break;
                case 'S':
                    $ticketsSaturday++;
                    break;
                case 'D':
                    $ticketsSunday++;
                    break;
                case 'F':
                    $ticketsWeekend++;
                    break;
            }
            if (!empty ($attendee->parkingReservation) ) $parking++;
        }

        $event   = Event::findOne( $idEvent );
        $friday = $event->dateStart;
        $saturday = DateFunctions::dateAdd($friday, 1);

        $guests = Attendee::getGuests($idEvent);
        foreach ($guests as $guest) {
            $guestFridayDinner = ($guest->dateArrival <= $friday) && ($friday <= $guest->dateDeparture);
            $guestSaturdayDinner = ($guest->dateArrival <= $saturday) && ($saturday <= $guest->dateDeparture);
            $companions = $guest->getCompanions();
            foreach ($companions as $companion) {
                if ($guestFridayDinner && !$companion->excludeFridayDinner) {
                    $fridayDinner++;
                }
                if ($guestSaturdayDinner) {
                    $saturdayDinner++;
                }
                if (!$companion->excludeLodging && $companion->separateRoom) {
                    $lodgingSingles++;
                }
            }
            if ($guestFridayDinner) $fridayDinner++;
            if ($guestSaturdayDinner) $saturdayDinner++;
            $lodgingSuites++;
        }

        $this->_reportTitle = 'Informe reservas a ' . date('d/m/Y');
        return $this->render('reportreservations', [
            'fridayDinner' => $fridayDinner,
            'saturdayDinner' => $saturdayDinner,
            'saturdayLunch' => $saturdayLunch,
            'sundayLunch' => $sundayLunch,
            'sundayDinner' => $sundayDinner,
            'lodgingSuites' => $lodgingSuites,
            'lodgingSingles' => $lodgingSingles,
            'lodgingDoubles' => $lodgingDoubles,
            'lodgingTriples' => $lodgingTriples,
            'lodgingQuadruples' => $lodgingQuadruples,
            'ticketsFriday' => $ticketsFriday,
            'ticketsSaturday' => $ticketsSaturday,
            'ticketsSunday' => $ticketsSunday,
            'ticketsWeekend' => $ticketsWeekend,
            'parking' => $parking,
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

	    $attendeerooms = Attendee::getAttendeeRooms( $idEvent, $aftersend, $numattendees);
	    $roomdays = Attendee::getRoomDays( $attendeerooms );

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
			    if ( ($guest->dateArrival <= $friday) && ($friday <= $guest->dateDeparture) && !$companion->excludeFridayDinner) {
				    //echo "<li>Sumo cena viernes para acompañante " . $companion->fullname;
				    array_unshift($fridayDinner, $attComp);
			    }
			    if ( ($guest->dateArrival <= $saturday) && ($saturday <= $guest->dateDeparture) ) {
			    	//echo "<li>Sumo cena sábado para acompañante " . $companion->fullname;
				    $attComp->remarksMealSaturday = $companion->remarksMealsSaturday;
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
			    $attGuest->remarksMealSaturday = $guest->remarksMealsSaturday;
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
		    /* Mejor que salga sólo lo del sábado, ya lo ponemos "mascado"
		    if (strlen ($sd->remarksMeals) ) {
		    	if (isset ($mealsummary['saturdayRemarks'][$sd->remarksMeals]) ) $mealsummary['saturdayRemarks'][$sd->remarksMeals]++;
			    else $mealsummary['saturdayRemarks'][$sd->remarksMeals] = 1;
		    }*/
		    if (strlen ($sd->remarksMealSaturday) ) {
			    if ( isset ( $mealsummary['saturdayRemarks'][ $sd->remarksMealSaturday ] ) ) $mealsummary['saturdayRemarks'][$sd->remarksMealSaturday]++;
			    else $mealsummary['saturdayRemarks'][ $sd->remarksMealSaturday ] = 1;
		    }
	    }

        $this->_reportTitle = 'Informe asistentes - Reservas hotel';

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
	        'roomdays' => $roomdays,
	    ]);

    }

	public function actionReportcifikids() {
		$idEvent = $this->getCurrentEvent();
		$attq = Attendee::find()->andFilterEvent($idEvent)->andCifiKids();
		$attendees = $attq->all();

		$data = [
			['title' => 'Sábado', 'children' => [] ],
			['title' => 'Domingo', 'children' => [] ],
		];

		foreach ($attendees as $attendee) {
			if (in_array ($attendee->cifiKidsDay, ['S', 'B'])) {
				$data[0]['children'][] = $attendee;
			}
			if (in_array ($attendee->cifiKidsDay, ['D', 'B'])) {
				$data[1]['children'][] = $attendee;
			}
		}

		//$params = Yii::$app->params;
		$maxChildrenCifiKids = Yii::$app->params['maxChildrenCifiKids'];
		return $this->render('reportcifikids', [
			'data' => $data,
			'maxChildrenCifiKids' => $maxChildrenCifiKids,
		]);
	}

	public function actionReportparking() {
		$idEvent = $this->getCurrentEvent();
		$attq = Attendee::find()->andFilterEvent($idEvent)->andParking();
		$attendees = $attq->all();

		return $this->render('reportparking', [
			'attendees' => $attendees,
		]);
	}

		/**
     * @deprecated
     * @return string
     */
	public function actionReportincomes() {
		$idEvent = $this->getCurrentEvent();

		$guests = Attendee::getGuests($idEvent);
		$attendeeincomes = Attendee::getAttendeeIncomes ($idEvent);
		return $this->render('reportincomes', [
			'incomes' => $attendeeincomes,
			'guests' => $guests,
		]);
	}

	protected function sortAttendeesBadgesMeals ($att1, $att2) {
		$ret = strcasecmp ($att1->badgeName, $att2->badgeName);
		if ($ret == 0) $ret = strcasecmp ($att1->badgeSurname, $att2->badgeSurname);
		return $ret;
	}
}
