<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;


final class UserStatusEnum extends Enum
{
    public const OPEN = 0;
    public const CLOSE = 1;
    public const BLOCK = 2;
    public static function getUserStatus(): array{
        return [
            'Mở'    =>  self::OPEN,
            'Đóng'  =>  self::CLOSE,
            'Chờ duyệt'  =>  self::BLOCK,
        ];
    }
    public static function getUserStatusKeyByValue($value): string{
        return array_search($value,self::getUserStatus(),true);
    }
}
