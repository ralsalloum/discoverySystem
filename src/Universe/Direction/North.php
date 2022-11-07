<?php

namespace App\Universe\Direction;

use App\Interface\Direction;

class North implements Direction
{
    /**
     * @return string
     */
    public static function getCharName(): string
    {
        return 'N';
    }

    /**
     * @return Direction
     */
    public function rotateToLeft(): Direction
    {
        return new West();
    }

    /**
     * @return Direction
     */
    public function rotateToRight(): Direction
    {
        return new East();
    }
}
