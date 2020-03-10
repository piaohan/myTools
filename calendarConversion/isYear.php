<?php

use libs\Calendar;

require '../vendor/autoload.php';

//$timestamp = time();
$timestamp=strtotime('2020-1-23');
$calendar = new Calendar();
$solar    = $calendar->solar(date('Y', $timestamp), date('m', $timestamp), date('d', $timestamp));
var_dump($solar);
//$lunar    = $calendar->lunar(date('Y', $timestamp), date('m', $timestamp), date('d', $timestamp));
//var_dump([$solar,$lunar]);