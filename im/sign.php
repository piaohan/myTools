<?php

$url = 'http://47.89.44.219:18080/admin/user/get_info';

$data = json_encode([
    'userId' => 'AJArArtt',
]);

$res = curlRequest($url, $data);
var_dump($res);

function curlRequest($url, $data)
{
    $secret_key = 123456;

    $nonce = mt_rand();
    $timestamp = getMillisecond();
    $sign = sha1("{$nonce}|{$secret_key}|{$timestamp}");

    $header = ([
        'nonce:' . $nonce,
        'timestamp:'. $timestamp,
        'sign:' . $sign,
    ]);
    
    $ch = curl_init(); //初始化curl
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);


    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $response;
}
function getMillisecond()
{
    list($msec, $sec) = explode(' ', microtime());
    $msectime = (float) sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
    return $msectimes = substr($msectime, 0, 13);
}
