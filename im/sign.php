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



// /**
//  * ********
//  * 给某个指定的野火IM用户发送消息
//  *
//  * @param array $params
//  *            发送消息体
//  * @param string $uri
//  *            请求路径
//  * @param string $method
//  *            请求方式
//  *         $info = [
//  *         'sender' => '发送者ID，野火IM的UID',
//  *         'conv' => [
//  *         'type' => 0,// 消息类型 0是单聊 1是群聊 2是聊天室 3是频道 4是设备 5是其他
//  *         'target' => '接收者ID，野火IM的UID',
//  *         'line' => 0
//  *         ],
//  *         'payload' => [
//  *         'type' => 90,// 会话类型 详情请看 http://docs.wildfirechat.cn/base_knowledge/message_payload.html#####contentType
//  *         'searchableContent' => '',
//  *         'pushContent'=>'',
//  *         'content' => '你们已经成为好友了，现在可以开始聊天了'
//  *         ]
//  *         ];
//  *         ***************
//  */
// function send_im_msg($params, $uri, $method = 'POST')
// {
//     $nonce = random_int(1111111, 9999999);
//     $timestamp = msectime();
//     $secretKey = getenv("SECRET_KEY");
//     $sign = sha1($nonce . "|" . $secretKey . "|" . $timestamp);
//     $base_uri = getenv("IM_API_URL");
//     $param = [
//         'base_uri' => $base_uri
//     ];
//     $client = new GuzzleHttp\Client($param);
//     $headers = [
//         'headers' => [
//             'Content-Type' => 'application/json',
//             'nonce' => $nonce,
//             'timestamp' => $timestamp,
//             'sign' => $sign
//         ],
//         'timeout' => 8,
//         'decode_content' => false,
//         'allow_redirects' => false,
//         GuzzleHttp\RequestOptions::JSON => $params
//     ];
//     $response = $client->request($method, $uri, $headers);
//     $reason = json_decode($response->getBody(), true);
//     if ($reason['code'] === 0) {
//         // 发送成功
//         return true;
//     } else {
//         // 发送失败
//         /** @var \Mix\Log\Logger $log */
//         $log = context()->get("log");
//         $log->log("send_im_msg_error", json_encode($reason));
//         return false;
//     }
// }
