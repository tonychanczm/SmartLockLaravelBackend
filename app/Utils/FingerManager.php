<?php
/**
 * Created by PhpStorm.
 * User: Tonychanczm
 * Date: 2019-07-13
 * Time: 22:29
 */

namespace App\Utils;


use App\Models\Finger;
use App\Models\User;
use Exception;

class FingerManager
{
    /**
     * 获取可用的指纹ID
     * @return int|mixed
     * @throws Exception
     */
    public static function getAUseableFingerId ()
    {
        try {
            $f = Finger::query()->where('uid', 0)->first();
            if (empty($f)) {
                if (Finger::query()->count() < 0) {
                    $id = 1;
                } else {
                    $id = Finger::query()->max('id') + 1;
                }
            } else {
                $id = $f->id;
            }
            return $id;
        } catch (Exception $e) {
            throw new Exception(StatusCode::DB_ERROR);
        }
    }

    /**
     * 检查指纹合法性
     * @param $finger_id
     * @return User|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null|object
     * @throws Exception
     */
    public static function checkFinger($finger_id)
    {
        // 查询指纹号
        try {
            $f = Finger::query()->where('id', $finger_id)->first();
        } catch (Exception $e) {
            throw new Exception(StatusCode::DB_ERROR);
        }

        // 当指纹号不存在
        if (empty($f)) {
            throw new Exception(StatusCode::ARDUINO_FINGER_NOT_EXSIT);
        }

        // 当指纹未被分配
        $uid = $f->uid;
        if ($uid == 0) {
            throw new Exception(StatusCode::ARDUINO_FINGER_NOT_REGISTERED);
        }

        try {
            // 获取用户信息
            $user = User::query()->where('id', $uid)->first();
        } catch (Exception $e) {
            throw new Exception(StatusCode::DB_ERROR);
        }
        return $user;
    }
}
