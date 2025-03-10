<?php

declare(strict_types=1);

namespace App\Enums;

use App\Attributes\Enums\Label;
use App\Traits\Enums\LabelEnum;
use App\Traits\Enums\EnumOptions;

// use App\Enums\Traits\EnumName;
// use App\Enums\Traits\EnumValue;
// use App\Contracts\HasEnumName;

enum RoleEnum: int  //implements HasEnumName
{
    use LabelEnum, EnumOptions;

    #[Label('Супервизор')]
    case Supervisor = 0;

    #[Label('Администратор')]
    case Admin = 1;

    #[Label('Менеджер')]
    case Manager = 2;

    #[Label('Рекламодатель')]
    case Advertiser = 3;

    #[Label('Контент')]
    case Content = 4;

    #[Label('Клиент')]
    case Client = 5;

    #[Label('Гость')]
    case Guest = 6;

    // public static function getEnumName(): string
    // {
    //     return RoleNameEnum::class;
    // }
}

// enum RoleNameEnum: string
// {
//     use EnumName;

//     case Supervisor = 'Супервизор';
//     case Admin = 'Администратор';
//     case Manager = 'Менеджер';
//     case Advertiser = 'Рекламодатель';
//     case Content = 'Контент';
//     case Client = 'Клиент';
//     case Guest = 'Гость';

// }
