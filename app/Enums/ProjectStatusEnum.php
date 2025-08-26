<?php

namespace App\Enums;

enum ProjectStatusEnum: string
{
    case Uncompleted = 'Uncompleted';
    case InProcess = 'In process';
    case Complete = 'completed';

    public function toString(): ?string
    {
        return match ($this) {
            self::Uncompleted => 'Не завершен',
            self::InProcess => 'В процессе',
            self::Complete => 'Завершен',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::Uncompleted => 'gray',
            self::InProcess => 'yellow',
            self::Complete => 'success',
        };
    }
}
