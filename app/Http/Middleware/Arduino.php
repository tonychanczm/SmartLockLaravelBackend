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
            return StatusCode::SIGN_ERROR . "-" . time();
        }

        if (abs($timestamp - time()) > 30*60) {
            return StatusCode::SIGN_TIMEOUT . "-" . time();
        }

        $last_api_req_time = Cache::get('last_api_req_time', 0);
        if ($timestamp == $last_api_req_time) {
            return StatusCode::SIGN_TIMEOUT . "-" . time();
        }
        foreach ($inputData as $key => $val) {
            $data[$key] = $val;
        }
        $data['timestamp'] = $timestamp;
        ksort($data);
        $str = http_build_query($data);
        $local_sign = strtolower(md5(md5($str) . $api_key));
        if ($local_sign != $sign) {
            return StatusCode::SIGN_ERROR . "-" . time();
        }

        return $next($request);
    }
}
