<?php
/**
 * Created by PhpStorm.
 * User: Tonychanczm
 * Date: 2019-07-17
 * Time: 22:36
 */

namespace App\Utils;


use App\Models\IOLog;

class IOLogger
{
    /**
     * 进门记录器
     * @param $user_id
     * @throws \Exception
     */
    public static function in ($user_id)
    {
        try {
            $io = IOLog::query()->where('uid', $user_id)->where('out_time', 0)->first();
            if (!empty($io)) {
                $io->out_time = time();
                $io->save();
            }
            $io = new IOLog();
            $io->uid = $user_id;
            $io->in_time = time();
            $io->save();
        } catch (\Exception $e) {
            throw new \Exception(StatusCode::DB_ERROR);
        }
    }

    /**
     * 出门记录器
     * @param $user_id
     * @throws \Exception
     */
    public static function out ($user_id)
    {
        try {
            $io = IOLog::query()->where('uid', $user_id)->where('out_time', 0)->first();
            if (empty($io)) {
                $io = IOLog::query()->where('uid', $user_id)->orderBy('in_time', 'desc')->first();
            }
            $io->out_time = time();
            $io->save();
        } catch (\Exception $e) {
            throw new \Exception(StatusCode::DB_ERROR);
        }
    }
}
