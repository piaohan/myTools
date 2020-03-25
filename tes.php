<?php
require_once 'vendor\autoload.php';
var_dump(11111111111);
$a = ['1', '3', '55', '99'];
$pos = array_search(min($a), $a);
echo $a[$pos]; //1

$a=[
    [
        'a'=>1,
        'b'=>11111111,
        'c'=>'啊啊1',
    ],
    [
        'a'=>2,
        'b'=>22221,
        'c'=>'啊啊2',
    ],
    [
        'a'=>3,
        'b'=>33331,
        'c'=>'啊啊3',
    ],
];
$pos=array_search(max($a),$a);
var_dump($pos);