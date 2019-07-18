<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OPLog
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OPLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OPLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OPLog query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $type 操作类型ID
 * @property int $op_time 执行操作时的时间戳
 * @property string|null $data 执行操作时可能涉及到的数据(json格式)
 * @property string|null $msg 执行操作时可能涉及到的信息
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OPLog whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OPLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OPLog whereMsg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OPLog whereOpTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OPLog whereType($value)
 */
class OPLog extends Model
{
    protected $table = 'op_log';
    public $timestamps = false;
}
