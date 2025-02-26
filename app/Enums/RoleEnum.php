<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Traits\EnumName;
use App\Enums\Traits\EnumValue;
use App\Contracts\HasEnumName;

enum RoleEnum: int implements HasEnumName
{
    use EnumValue;

    case Supervisor = 0;
    case Admin = 1;
    case Manager = 2;
    case Advertiser = 3;
    case Content = 4;
    case Client = 5;
    case Guest = 6;

    public static function getEnumName(): string
    {
        return RoleNameEnum::class;
    }
}

enum RoleNameEnum: string
{
    use EnumName;

    case Supervisor = 'Супервизор';
    case Admin = 'Администратор';
    case Manager = 'Менеджер';
    case Advertiser = 'Рекламодатель';
    case Content = 'Контент';
    case Client = 'Клиент';
    case Guest = 'Гость';

}
