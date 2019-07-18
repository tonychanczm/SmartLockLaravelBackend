<?php

namespace App\Http\Controllers\Apis;

use App\Models\Finger;
use App\Utils\FingerManager;
use App\Utils\IOLogger;
use App\Utils\OPLogger;
use App\Utils\OPTypes;
use App\Utils\StatusCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Log;

class LockController extends Controller
{
    // 扫指纹进入
    public function fingerLogin (Request $request)
    {
        try {
            // 检查指纹并尝试获取user对象
            $user = FingerManager::checkFinger($request->get('finger_id'));

            // 可以开锁
            IOLogger::in($user->id);
            OPLogger::log(OPTypes::PERSON_IN_ROOM_UNLOCK, ['user_id'=>$user->id, 'username' => $user->name, 'user_number' => $user->no]);

            return StatusCode::SUCCESS.'-'.$user->name.'-'.$user->no.'-'.time();
        } catch (Exception $e) {
            Log::error('指纹识别出错：' . StatusCode::STR[$e->getMessage()]);
            return $e->getMessage().'-null-null-'.time();
        }

    }

    // 扫指纹离开
    public function fingerLogout (Request $request)
    {
        try {
            // 检查指纹并尝试获取user对象
            $user = FingerManager::checkFinger($request->get('finger_id'));

            // 可以开锁
            IOLogger::out($user->id);
            OPLogger::log(OPTypes::PERSON_OUT_ROOM_UNLOCK, ['user_id' => $user->id, 'username' => $user->name, 'user_number' => $user->no]);

            return StatusCode::SUCCESS.'-'.$user->name.'-'.$user->no.'-'.time();
        } catch (Exception $e) {
            Log::error('指纹识别出错：' . StatusCode::STR[$e->getMessage()]);
            return $e->getMessage().'-null-null-'.time();
        }
    }

    // 获取可用的指纹ID
    public function getAvailableId (Request $request)
    {
        try {
            // 获取id
            $id = FingerManager::getAUseableFingerId();
            return StatusCode::SUCCESS . '-'. $id .'-' .time();
        } catch (Exception $e) {
            return $e->getMessage() . '-0-' .time();
        }
    }

    // 新指纹录入
    public function newFingerInput (Request $request)
    {
        try {
            // 查找是否有对应的指纹号
            $finger_id = $request->get('finger_id');
            try {
                $f = Finger::query()->where('id', $finger_id)->first();
            } catch (Exception $e) {
                throw new Exception(StatusCode::DB_ERROR);
            }
            if (!empty($f)) { // 如果有
                if ($f->uid > 0) { //如果已被占用就boom
                    throw new Exception(StatusCode::ARDUINO_FINGER_EXIST);
                }
                $f->uid = 0; // 待分配
            } else {
                $f = new Finger();
                $f->id = $finger_id;
                $f->uid = 0; // 待分配
            }

            try {
                $f->save(); // 保存
            } catch (Exception $e) {
                throw new Exception(StatusCode::DB_ERROR);
            }
            return StatusCode::SUCCESS . '-' . time();
        }catch (Exception $e) {
            Log::error('指纹写入错误：' . StatusCode::STR[$e->getMessage()]);
            return $e->getMessage() . '-' . time();
        }
    }

    public function getServerTime (Request $request)
    {
        return StatusCode::SUCCESS . '-' . time();
    }
}
