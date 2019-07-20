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

            echo StatusCode::SUCCESS.'-'.$user->name.'-'.$user->no.'-'.time();
            return \Response::noContent(200);
        } catch (Exception $e) {
            Log::error('指纹识别出错：' . StatusCode::STR[$e->getMessage()]);
            echo $e->getMessage().'-null-null-'.time();
            return \Response::noContent(400);
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

            echo StatusCode::SUCCESS.'-'.$user->name.'-'.$user->no.'-'.time();
            return \Response::noContent(200);
        } catch (Exception $e) {
            Log::error('指纹识别出错：' . StatusCode::STR[$e->getMessage()]);
            echo $e->getMessage().'-null-null-'.time();
            return \Response::noContent(400);
        }
    }

    // 获取可用的指纹ID
    public function getAvailableId (Request $request)
    {
        try {
            // 获取id
            $id = FingerManager::getAUseableFingerId();
            echo StatusCode::SUCCESS . '-'. $id .'-' .time();
            return \Response::noContent(200);
        } catch (Exception $e) {
            echo $e->getMessage() . '-0-' .time();
            return \Response::noContent(400);
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
            echo StatusCode::SUCCESS . '-' . time();
            return \Response::noContent(200);
        }catch (Exception $e) {
            Log::error('指纹写入错误：' . StatusCode::STR[$e->getMessage()]);
            echo $e->getMessage() . '-' . time();
            return \Response::noContent(400);
        }
    }

    public function getServerTime (Request $request)
    {
        echo StatusCode::SUCCESS . '-' . time();
        return \Response::noContent(400);
    }

    public function signTest(Request $request)
    {
        $api_key = env('API_KEY', '123456789991aassvvzzsaq');
        $inputData = [
            'finger_id' => $request->get('finger_id', null),
        ];
        $data = [];
        $timestamp = time();
        foreach ($inputData as $key => $val) {
            if ($val != null) {
                $data[$key] = $val;
            }
        }
        $data['timestamp'] = $timestamp;
        ksort($data);
        $str = htmlspecialchars(http_build_query($data));
        $data['sign'] = strtolower(md5(md5($str) . $api_key));
        echo htmlspecialchars(http_build_query($data));
        return \Response::noContent(200);
    }
}
