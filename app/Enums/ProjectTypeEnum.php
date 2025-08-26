<?php

namespace App\Enums;

enum ProjectTypeEnum: string
{
    case title = 'title';
    case description = 'description';
    case gallery = 'gallery';

    public function toString(): ?string
    {
        return match ($this) {
            self::title => 'Заголовок',
            self::description => 'Описание',
            self::gallery => 'Галерея',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::title => 'blue',
            self::description => 'yellow',
            self::gallery => 'green',
        };
    }
}
