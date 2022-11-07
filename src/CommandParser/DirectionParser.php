<?php

namespace App\CommandParser;

use App\Exception\InvalidDirectionException;
use App\Interface\Direction;
use App\Universe\Direction\East;
use App\Universe\Direction\North;
use App\Universe\Direction\South;
use App\Universe\Direction\West;

class DirectionParser
{
    private static array $directions = [
        'N' => North::class,
        'E' => East::class,
        'S' => South::class,
        'W' => West::class
    ];

    /**
     * @param $charName
     * @return Direction
     * @throws InvalidDirectionException
     */
    public static function fromString($charName): Direction
    {
        if (!array_key_exists($charName, self::$directions)) {
            throw new InvalidDirectionException();
        }

        return new self::$directions[$charName];
    }
}
