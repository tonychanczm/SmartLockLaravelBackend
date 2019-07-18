<?php
/**
 * Created by PhpStorm.
 * User: Tonychanczm
 * Date: 2019-07-06
 * Time: 01:33
 */

namespace App\Utils;


class OPTypes
{
    public const PERSON_IN_ROOM_UNLOCK = 1001;
    public const PERSON_OUT_ROOM_UNLOCK = 1002;
    public const ADMIN_ADD_FINGER = 2001;
    public const ADMIN_REMOVE_FINGER = 2002;
    public const ADMIN_ADD_USER = 2003;
    public const ADMIN_REMOVE_USER = 2004;

    public const STR = [
        self::PERSON_IN_ROOM_UNLOCK => '人员进入房间解锁房门',
        self::PERSON_OUT_ROOM_UNLOCK => '人员离开房间解锁房门',
        self::ADMIN_ADD_USER => '管理员添加用户',
        self::ADMIN_REMOVE_USER => '管理员删除用户',
        self::ADMIN_ADD_FINGER => '管理员添加用户指纹',
        self::ADMIN_REMOVE_FINGER => '管理员删除用户指纹',
    ];
}
