<?php

require '../vendor/autoload.php';

use QL\QueryList;

$bweet = [1990, 2019];
$file  = 'sqlRes.php';
$data  = [];
if (!file_exists($file)) {
    touch($file, 0777, true);
}
$myfile = fopen($file, "w");
fwrite($myfile, '');
fclose($myfile);
for ($i = $bweet[0]; $i <= $bweet[1]; $i++) {
    $data[$i] = [];
    $html     = "http://www.6hbd.me/marksix/history/{$i}?type=1";
    $ql       = QueryList::get($html);
    $list     = $ql->find('tr:gt(0)')->map(
        function ($row) {
            return $row->find('td')->texts()->all();
        }
    )->reverse();
    foreach ($list as $k => $v) {
        $array = explode("  ", $v[0]);
        $res   = [
            'Period'    => $i . str_split($array[0], 3)[0],
            'time'      => $array[1],
            'Open_Time' => strtotime($array[1] . ' 0:0:0'),
        ];
        if (intval($array[0]) != 0) {
            $ot   = $res['Open_Time'];
            $p    = $res['Period'];
            $sql = "update h_lottery set Add_Time={$ot} where Period={$p};".PHP_EOL;
            $myfile = fopen($file, "a");
            fwrite($myfile, $sql);
            fclose($myfile);
        }
    }
}

die('数据采集完毕-' . date('Y-m-d H:i:s'));

