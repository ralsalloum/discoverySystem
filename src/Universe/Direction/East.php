<?php

namespace App\Universe\Direction;

use App\Interface\Direction;

class East implements Direction
{
    /**
     * @return string
     */
    public static function getCharName(): string
    {
        return 'E';
    }

    /**
     * @return Direction
     */
    public function rotateToLeft(): Direction
    {
        return new North();
    }

    /**
     * @return Direction
     */
    public function rotateToRight(): Direction
    {
        return new South();
    }
}