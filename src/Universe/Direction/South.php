<?php

namespace App\Universe\Direction;

use App\Interface\Direction;

class South implements Direction
{
    /**
     * @return string
     */
    public static function getCharName(): string
    {
        return 'S';
    }

    /**
     * @return Direction
     */
    public function rotateToLeft(): Direction
    {
        return new East();
    }

    /**
     * @return Direction
     */
    public function rotateToRight(): Direction
    {
        return new West();
    }
}