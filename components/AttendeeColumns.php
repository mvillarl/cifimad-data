<?php
namespace app\components;

use app\models\Attendee;

define('ONLINESTORE_BASEHREF', 'https://www.cifimad.es/wp-admin/post.php?action=edit&post=');

class AttendeeColumns {
	public static function mealsCol ($model, $key, $index, $col, $small = false) {
		$suf = $small? '10': '';
		$content  = '<img src="/img/' . ($model->mealFridayDinner? 'tick': 'x') . $suf . '.gif" title="Cena Cocktail"/> ';
		$content .= '<img src="/img/' . ($model->mealSaturdayLunch? 'tick': 'x') . $suf . '.gif" title="Comida sábado"/> ';
		$content .= '<img src="/img/' . ($model->mealSaturdayDinner? 'tick': 'x') . $suf . '.gif" title="Cena de Gala - '.$model->remarksMealSaturday.'"/> ';
		$content .= '<img src="/img/' . ($model->mealSundayLunch? 'tick': 'x') . $suf . '.gif" title="Comida domingo"/> ';
		$content .= '<img src="/img/' . ($model->mealSundayDinner? 'tick': 'x') . $suf . '.gif" title="Cena de los Valientes"/> ';
		return $content;
	}

	public static function photosCol ($model, $key, $index, $col, $small = false) {
		$suf = $small? '10': '';
		$idEvent = \Yii::$app->session->get('Attendee.idEvent');
		$guests = Attendee::getGuests($idEvent);
		$products = Attendee::getProducts($idEvent);
		$model->setEvent($idEvent, $guests, $products);

		$fields = $model->getGuestFields();
		$content = '';
		for ($i = 0, $ct = count ($fields); $i < $ct; $i++)
			$content .= '<img src="/img/' . ($model->{$fields[$i]}? 'tick': 'x') . $suf . '.gif" title="'. $model->getAttributeLabel ($fields[$i]) .'"/> ';
		return $content;
	}

	public static function productsCol ($model, $key, $index, $col, $small = false) {
		$suf = $small? '10': '';
		$idEvent = \Yii::$app->session->get('Attendee.idEvent');
		$guests = Attendee::getGuests($idEvent);
		$products = Attendee::getProducts($idEvent);
		$model->setEvent($idEvent, $guests, $products);

		$fields = $model->getExtraProductFields();
		$content = '';
		for ($i = 0, $ct = count ($fields); $i < $ct; $i++)
			$content .= '<img src="/img/' . ($model->{$fields[$i]}? 'tick': 'x') . $suf . '.gif" title="'. $model->getAttributeLabel ($fields[$i]) .'"/> ';
		return $content;
	}

	public static function orderNumbersCol ($model, $key, $index, $col, $small = false) {
		$ret = '';
		if (strlen ($model->orders) ) {
			$orderparts = explode (',', $model->orders);
			for ($i = 0, $ct = count ($orderparts); $i < $ct; $i++) {
				if ($i > 0) $ret .= ', ';
				$ret .= '<a target="_blank" href="' . ONLINESTORE_BASEHREF . trim ($orderparts[$i]) . '">' . $orderparts[$i] . '</a>';
			}
		}
		return $ret;
	}

	public static function remarksCol ($model, $key, $index, $col, $small = false) {
		$ret = '';
		if (strlen ($model->remarksRegistration) ) {
			$color = $model->status == '0'? 'darkorange': '#00C1C1';
			$ret = '<span style="background-color: ' . $color . ';" title="' . htmlspecialchars($model->remarksRegistration). '">' . substr($model->remarksRegistration, 0, 10) . (strlen ($model->remarksRegistration) > 10? '...': '') . '</span>';
		}
		return $ret;
	}

	public static function rowOptions ($model, $key, $index, $grid, $isdesk) {
		$ret = [];
		if ( (strlen ($model->remarks) && !$isdesk) || strlen ($model->remarksRegistration)) {
			$ret['style'] = 'background-color: #00DADA;';
		} elseif (strlen ($model->status == '0')) {
			$ret['style'] = 'background-color: orange;';
		}
		return $ret;
	}
}