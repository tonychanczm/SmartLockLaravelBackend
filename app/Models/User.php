<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\User
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @mixin \Eloquent
 * @property int $id uid
 * @property string $name 名字
 * @property string $pass 密码hash
 * @property string $no 用户号码（学号或工号）
 * @property int $level 用户等级
 * @property int $totalTime 统计在线时间
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereTotalTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 */
class User extends Model
{
    protected $table = 'user';
}
