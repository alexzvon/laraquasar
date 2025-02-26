<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Traits\EnumName;
use App\Enums\Traits\EnumValue;
use App\Contracts\HasEnumName;

enum OwnerShipEnum: int
{
    use EnumValue;

    case Individual = 0;
    case LegalEntity = 1;

    public static function getEnumName(): string
    {
        return OwnerShipNameEnum::class;
    }
}

enum OwnerShipNameEnum: string
{
    use EnumName;

    case Individual = 'Физическое лицо';
    case LegalEntity = 'Юридическое лицо';
}
