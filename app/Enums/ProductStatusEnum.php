<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ProductStatusEnum extends Enum
{
    public const OPEN = 0;
    public const CLOSE = 1;
    public static function getProductStatus(): array{
        return [
            'Mở'    =>  self::OPEN,
            'Đóng'  =>  self::CLOSE,
        ];
    }
    public static function getProductStatusKeyByValue($value): string{
        return array_search($value,self::getProductStatus(),true);
    }
}
