<?php

namespace App\Http\Middleware;

use App\Utils\StatusCode;
use Closure;
use Illuminate\Support\Facades\Cache;

class Arduino
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $api_key = env('API_KEY', '123456789991aassvvzzsaq');
        $inputData = [
            'finger_id' => $request->get('finger_id', null),
        ];
        $data = [];
        $timestamp = $request->get('timestamp', null);
        $sign = $request->get('sign', null);
        if ($timestamp == null || $sign == null) {
            echo StatusCode::SIGN_ERROR . "-" . time();
            return \Response::noContent(400);
        }

        if (abs($timestamp - time()) > 30*60) {
            echo StatusCode::SIGN_TIMEOUT . "-" . time();
            return \Response::noContent(400);
        }

        $last_api_req_time = Cache::get('last_api_req_time', 0);
        if ($timestamp <= $last_api_req_time) {
            echo StatusCode::SIGN_TIMEOUT . "-" . time();
            return \Response::noContent(400);
        }
        Cache::put('last_api_req_time', $timestamp);

        foreach ($inputData as $key => $val) {
            if ($val != null) {
                $data[$key] = $val;
            }
        }
        $data['timestamp'] = $timestamp;
        ksort($data);
        $str = htmlspecialchars(http_build_query($data));
        $local_sign = strtolower(md5(md5($str) . $api_key));
        if ($local_sign != $sign) {
            echo StatusCode::SIGN_ERROR . "-" . time();
            return \Response::noContent(400);
        }

        return $next($request);
    }
}
