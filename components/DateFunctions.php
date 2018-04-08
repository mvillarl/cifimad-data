<?php
namespace app\components;

class DateFunctions {
	protected static $_shortmonths = [
		'01' => 'Ene',
		'02' => 'Feb',
		'03' => 'Mar',
		'04' => 'Abr',
		'05' => 'May',
		'06' => 'Jun',
		'07' => 'Jul',
		'08' => 'Ago',
		'09' => 'Sep',
		'10' => 'Oct',
		'11' => 'Nov',
		'12' => 'Dic',
	];

	public static function sql2timestamp ($date) {
		if (strlen ($date) == 10) $date .= ' 00:00:00';
		$datetime = explode (" ", $date);
		$dateparts = explode ("-", $datetime[0]);
		$timeparts = explode (":", $datetime[1]);
		return mktime($timeparts[0],$timeparts[1],$timeparts[2],$dateparts[1],$dateparts[2],$dateparts[0]);
	}

	public static function dateAdd ($date, $days) {
		$ts = self::sql2timestamp($date);
		$ts2 = mktime(date("H",$ts),date("i",$ts),date("s",$ts),date("m",$ts),date("d",$ts)+$days,date("Y",$ts));
		return self::sqlDate ($ts2);
	}

	public static function sqlDate ($date) {
		return date ("Y-m-d", $date);
	}

	public function dateText ($date) {
		$dateparts = explode ("-", $date);
		return $dateparts[2] . ' ' . self::$_shortmonths[$dateparts[1] ];
	}
}
