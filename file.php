<?php

require 'vendor/autoload.php';
$table = include 'dbTableName.php';
foreach ($table as $kk => $vv) {
    $dirPath = 'files' . DIRECTORY_SEPARATOR . ucfirst($kk);
    if (!is_dir($dirPath)) {
        mkdir($dirPath);
    }
    $namespace =  ucfirst($kk);
    $pool =  $kk;
    foreach ($table[$kk] as $k => $v) {
        $modelName = ucfirst($k);
        $tableName = $v;
        $getTableName = 'app.' . $k;
        $path = $dirPath. DIRECTORY_SEPARATOR . ucfirst($k) . '.php';

        $fp = fopen("fileExample.php", "r");
        $str = fread($fp, filesize("fileExample.php"));
        $str = str_replace("{namespace}", $namespace, $str);
        $str = str_replace("{modelName}", $modelName, $str);
        $str = str_replace("{tableName}", $tableName, $str);
        $str = str_replace("{pool}", $pool, $str);
        $str = str_replace("{getTableName}", $getTableName, $str);
        fclose($fp);

        $handle = fopen($path, "w");
        fwrite($handle, $str);
        fclose($handle);

    }
}
