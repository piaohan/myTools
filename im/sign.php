<?php

$SECRET_KEY = 123456;

$nonce     = mt_rand();
$timestamp = getMillisecond();
$sign      = sha1("{$nonce}|{$SECRET_KEY}|{$timestamp}");

var_dump($nonce,$timestamp,$sign);

function getMillisecond(){
    list($msec, $sec) = explode(' ', microtime());
    $msectime =  (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
    return $msectimes = substr($msectime,0,13);
}
