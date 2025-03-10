<?php

declare(strict_types=1);

namespace App\Enums;

use App\Attributes\Enums\Label;
use App\Traits\Enums\LabelEnum;
use App\Traits\Enums\EnumOptions;

// use App\Enums\Traits\EnumName;
// use App\Enums\Traits\EnumValue;
// use App\Contracts\HasEnumName;

enum OwnerShipEnum: int
{
    use LabelEnum, EnumOptions;

    #[Label('Физическое лицо')]
    case Individual = 0;

    #[Label('Юридическое лицо')]
    case LegalEntity = 1;

    // public static function getEnumName(): string
    // {
    //     return OwnerShipNameEnum::class;
    // }
}

// enum OwnerShipNameEnum: string
// {
//     use EnumName;

//     case Individual = 'Физическое лицо';
//     case LegalEntity = 'Юридическое лицо';
// }
