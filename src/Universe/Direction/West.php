<?php

namespace App\Universe\Direction;

use App\Interface\Direction;

class West implements Direction
{
    /**
     * @return string
     */
    public static function getCharName(): string
    {
        return 'W';
    }

    /**
     * @return Direction
     */
    public function rotateToLeft(): Direction
    {
        return new South();
    }

    /**
     * @return Direction
     */
    public function rotateToRight(): Direction
    {
        return new North();
    }
}
