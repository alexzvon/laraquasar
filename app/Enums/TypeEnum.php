<?php

declare(strict_types=1);

namespace App\Enums;

use App\Attributes\Enums\Label;
use App\Attributes\Enums\Table;
use App\Traits\Enums\LabelEnum;
use App\Traits\Enums\TableEnum;
use App\Traits\Enums\EnumOptions;

enum TypeEnum: int
{
    use LabelEnum, TableEnum, EnumOptions;

    #[Table('')]
    #[Label('Булево')]
    case Boolean = 1;

    #[Table('')]
    #[Label('Число')]
    case Integer = 2;
  
    #[Table('brands')]
    #[Label('Справочник Брэнд')]
    case Brand = 3;

    #[Table('colors')]
    #[Label('Справочник Цвет')]
    case Color = 4;

    #[Table('dimensions')]
    #[Label('Справочник Размер')]
    case Dimension = 5;
}
