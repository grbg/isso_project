<?php

namespace App\Enums;

enum ApartmentTypeEnum: string
{
    case one_room = '1_room';
    case two_room = '2_room';
    case three_room = '3_room';
    case studio = 'studio';

    public function toString(): ?string
    {
        return match ($this) {
            self::one_room => '1-км квартира',
            self::two_room => '2-км квартира',
            self::three_room => '3-кв квартира',
            self::studio => 'Студия',
        };
    }

}
