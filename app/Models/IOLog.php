<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\IOLog
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IOLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IOLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IOLog query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $uid 用户id
 * @property int $in_time 进入房间时的UNIX时间戳
 * @property int $out_time 离开房间时的UNIX时间戳
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IOLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IOLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IOLog whereInTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IOLog whereOutTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IOLog whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IOLog whereUpdatedAt($value)
 */
class IOLog extends Model
{
    protected $table = 'io_log';
}
