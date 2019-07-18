<?php
/**
 * Created by PhpStorm.
 * User: Tonychanczm
 * Date: 2019-07-18
 * Time: 09:35
 */

namespace App\Utils;


use App\Models\OPLog;

class OPLogger
{
    /**
     * 操作记录器
     * @param $opType
     * @param array $dataArr
     */
    public static function log ($opType, array $dataArr)
    {
        $op = new OPLog();
        $op->type = $opType;
        $op->msg = OPTypes::STR[$opType];
        $op->data = json_encode($dataArr);
    }
}
