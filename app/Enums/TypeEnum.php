<?php

declare(strict_types=1);

namespace App\Enums;

use App\Attributes\Enums\Label;
use App\Attributes\Enums\Table;
use App\Traits\Enums\LabelEnum;
use App\Traits\Enums\TableEnum;

// use App\Contracts\HasEnumName;
// use App\Enums\Traits\EnumValue;
// use App\Enums\Traits\EnumName;

enum TypeEnum: int  // implements HasEnumName
{
  // use EnumValue;
    use LabelEnum, TableEnum;

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

    public static function getOptions(): array
    {
        $options = [];

        foreach(self::cases() as $item) {
            $options[] = [ 'label' => $item->label(), 'value' => $item->value ];
        }

        return $options;
    }

    public function getOption(): array
    {
        return [ 'label' => $this->label(), 'value' => $this->value ];
    }
}

// enum TypeNameEnum: string
// {
//     use EnumName;

//     case Boolean = 'Булево';
//     case Integer = 'Число';
//     case Brand = 'Справочник Брэнд';
//     case Color = 'Справочник Цвет';
//     case Dimension = 'Справочник Размер';
// }

// enum TypeTableEnum: string
// {
//   use EnumName;

//   case Boolean = '';
//   case Integer = '';
//   case Brand = 'brands';
//   case Color = 'colors';
//   case Dimension = 'dimensions';
// }