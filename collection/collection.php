<?php

require '../vendor/autoload.php';

use QL\QueryList;

$bweet = [1990, 1990];
$file  = 'res.php';
$data  = [];
if (!file_exists($file)) {
    touch($file, 0777, true);
}
$myfile = fopen($file, "w") or die("文件打开失败!");
$txt = "<?php\n return [";
fwrite($myfile, $txt);
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
            array_push($data[$i], $res);
        }
    }
    $myfile = fopen($file, "a") or die("数据增加失败!");
    fwrite($myfile, "'" . $i . "'=>");
    fwrite($myfile, var_export(($data[$i]), true));
    fwrite($myfile, ",\n");
    fclose($myfile);
}
$myfile = fopen($file, "a");
$txt    = "];";
fwrite($myfile, $txt);
fclose($myfile);
die('数据采集完毕-'.date('Y-m-d H:i:s'));



