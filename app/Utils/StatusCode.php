<?php
/**
 * Created by PhpStorm.
 * User: Tonychanczm
 * Date: 2019-07-17
 * Time: 21:47
 */

namespace App\Utils;


class StatusCode
{
    // 公共状态码
    public const SUCCESS                            = 00000; // 成功
    public const SIGN_ERROR                         = 00001; // 不合法的签名
    public const SIGN_TIMEOUT                       = 00002; // 签名已超时
    public const DB_ERROR                           = 00003; // 数据库查询出错
    // 指纹用户Api状态码
    public const ARDUINO_FINGER_NOT_EXSIT           = 10001; // 指纹不存在于数据库中
    public const ARDUINO_FINGER_SUSPEND             = 10002; // 该指纹被暂停使用
    public const ARDUINO_FINGER_BANNED              = 10003; // 该指纹被禁止使用
    public const ARDUINO_FINGER_NOT_REGISTERED      = 10004; // 该指纹未被注册到任何用户上
    public const ARDUINO_FINGER_NOT_SERVICE_TIME    = 10005; // 目前是非服务时间，不得刷指纹进入
    // 指纹管理员Api状态码
    public const ARDUINO_FINGER_ADMIN_NOT_ENABLE    = 20000; // 未开启管理员模式，不得使用管理员API
    public const ARDUINO_FINGER_EXIST               = 20001; // 该指纹ID已被其他用户占用

    public const STR = [
        self::SUCCESS                           => '成功',
        self::SIGN_ERROR                        => '不合法的签名',
        self::SIGN_TIMEOUT                      => '签名已超时',
        self::ARDUINO_FINGER_NOT_EXSIT          => '指纹不存在于数据库中',
        self::ARDUINO_FINGER_SUSPEND            => '该指纹被暂停使用',
        self::ARDUINO_FINGER_BANNED             => '该指纹被禁止使用',
        self::ARDUINO_FINGER_NOT_REGISTERED     => '该指纹未被注册到任何用户上',
        self::ARDUINO_FINGER_NOT_SERVICE_TIME   => '目前是非服务时间，不得刷指纹进入',
        self::ARDUINO_FINGER_ADMIN_NOT_ENABLE   => '未开启管理员模式，不得使用管理员API',
        self::ARDUINO_FINGER_EXIST              => '该指纹ID已被其他用户占用',
    ];
}
