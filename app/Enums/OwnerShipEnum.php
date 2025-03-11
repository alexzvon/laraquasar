<?php

declare(strict_types=1);

namespace App\Enums;

use App\Attributes\Enums\Label;
use App\Traits\Enums\LabelEnum;
use App\Traits\Enums\EnumOptions;

enum OwnerShipEnum: int
{
    use LabelEnum, EnumOptions;

    #[Label('Физическое лицо')]
    case Individual = 0;

    #[Label('Юридическое лицо')]
    case LegalEntity = 1;
}
