<?php

namespace App\CommandParser;

use App\Exception\InvalidCommandException;
use App\Vehicle\Command\MoveForwardCommand;
use App\Vehicle\Command\RotateLeftCommand;
use App\Vehicle\Command\RotateRightCommand;

class CommandParser
{
    private static array $allowedCommands = [
        'L' => RotateLeftCommand::class,
        'R' => RotateRightCommand::class,
        'M' => MoveForwardCommand::class
    ];

    /**
     * Parse the string commands to commands objects
     *
     * @param $stringCommands
     * @return array
     * @throws InvalidCommandException
     */
    public static function fromString($stringCommands): array
    {
        $commands = [];

        $inArray = str_split($stringCommands);

        foreach ($inArray as $charName) {
            if (!self::isValidChar($charName)) {
                throw new InvalidCommandException();
            }

            $commands[] = new self::$allowedCommands[$charName];
        }

        return $commands;
    }

    /**
     * Check if the char name of a command is valid
     *
     * @param $charName
     * @return bool
     */
    private static function isValidChar($charName): bool
    {
        return array_key_exists($charName, self::$allowedCommands);
    }
}
