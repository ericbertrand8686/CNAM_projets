<?php
class Temps
{
    public static function getDateTime() {
        ini_set('date.timezone', 'Europe/Brussels');
		$date1 = new DateTime('now');
        return $date1->format('Y-m-d H:i:s');
    }

}