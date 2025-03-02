<?php

declare(strict_types=1);

namespace App\Enums;

use App\Contracts\HasEnumName;
use App\Enums\Traits\EnumValue;
use App\Enums\Traits\EnumName;

enum TypeEnum: int implements HasEnumName
{
  use EnumValue;

  case Boolean = 1;
  case Integer = 2;
  case Brand = 3;
  case Color = 4;
  case Dimension = 5;

  public static function getEnumName(): string
  {
      return TypeNameEnum::class;
  }
}

enum TypeNameEnum: string
{
    use EnumName;

    case Boolean = 'Булево';
    case Integer = 'Число';
    case Brand = 'Справочник Брэнд';
    case Color = 'Справочник Цвет';
    case Dimension = 'Справочник Размер';
}

enum TypeTableEnum: string
{
  use EnumName;

  case Boolean = '';
  case Integer = '';
  case Brand = 'brands';
  case Color = 'colors';
  case Dimension = 'dimensions';
}