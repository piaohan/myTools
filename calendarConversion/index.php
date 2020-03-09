<?php
require '../vendor/autoload.php';

use Carbon\Carbon;
use Overtrue\ChineseCalendar\Calendar;

$now =Carbon::now();
//$now =Carbon::parse('2020-03-05');
$calendar=new Calendar();

var_dump($calendar->solar($now->format('Y'),$now->format('m'),$now->format('d')));