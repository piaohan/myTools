<?php

require '../vendor/autoload.php';

use QL\QueryList;

$bweet = [1976, 2020];
$file  = 'sqlResV2.php';
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
            return $row->find('td')->remove('span')->texts()->all();
        }
    )->reverse();
    $ress     = [];
    foreach ($list as $k => $v) {
        $array = explode("  ", $v[0]);
        $t     = preg_replace('# #', '', $v[1]);
        $str   = str_replace(["\r\n", "\r", "\n"], "", $t);
        $str   = preg_replace('/[\W]/', ',', $str);
        list($V1, $V2, $V3, $V4, $V5, $V6) = explode(",,,", $str);
        $t     = preg_replace('# #', '', $v[2]);
        $tema1 = str_replace(["\r\n", "\r", "\n"], "", $t);
        $tema2 = preg_replace('/[\W]/', ',', $tema1);
        $tema  = explode(",,,", $tema2);
        $p     = $i . str_split($array[0], 3)[0];
//        $res   = [
//            'Period1'   => $i,
//            'Period'    => $i . str_split($array[0], 3)[0],
//            'time'      => $array[1] . ' 0:0:0',
//            'Open_Time' => strtotime($array[1] . ' 0:0:0'),
//            'V1'        => $V1,
//            'V2'        => $V2,
//            'V3'        => $V3,
//            'V4'        => $V4,
//            'V5'        => $V5,
//            'V6'        => $V6,
//            'tema'      => $tema[0],
//        ];
        if (intval($array[0]) != 0) {
            $ot    = strtotime($array[1] . ' 0:0:0')?:'null';
            $sql    =
                "insert into `h_lottery`(`Year`, `V1`, `V2`, `V3`, `V4`, `V5`, `V6`, `V7`, `Open_Time`, `Add_Time`, `Period`) values ( $i, '$V1', '$V2', '$V3', '$V4', '$V5', '$V6', '$tema[0]', $ot, null, $p);" . PHP_EOL;
//            var_dump($sql);
//            exit();
            $myfile = fopen($file, "a");
            fwrite($myfile, $sql);
            fclose($myfile);
        }
    }
}

die('数据采集完毕-' . date('Y-m-d H:i:s'));

