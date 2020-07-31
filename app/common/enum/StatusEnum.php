<?php
namespace app\common\enum;

/**
 * 状态 枚举
 */

class StatusEnum
{
    const STATUS_ACTIVE = 1;
    const STATUS_ISACTIVE = 0;
    const STATUS_DELETE = -1;

    public static $listStatus = [
        self::STATUS_ACTIVE => '正常',
        self::STATUS_ISACTIVE => '停用',
        self::STATUS_DELETE => '封号',
    ];
    public static $statusClass = [
        self::STATUS_ACTIVE => 'success',
        self::STATUS_ISACTIVE => 'warning',
        self::STATUS_DELETE => 'danger',
    ];
}