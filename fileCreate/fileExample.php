<?php

namespace App\Api\Models\{namespace};



class {modelName}
{

    public $pool;
    public $tableName; //数据库表名{tableName};如果以_结尾的为增量表 需要手动调整或者增加方法

    public function __construct()
    {
        $this->pool      = context()->get('{pool}');
        $this->tableName = config()->get('{getTableName}');
    }

}