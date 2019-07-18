<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Finger
 *
 * @property int $id
 * @property int $uid 用户id，若为0则表示空
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Finger newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Finger newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Finger query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Finger whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Finger whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Finger whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Finger whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Finger extends Model
{
    protected $table = 'finger';
}
