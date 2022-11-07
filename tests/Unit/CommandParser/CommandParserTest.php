<?php

namespace App\Tests\Unit\CommandParser;

use App\Exception\InvalidCommandException;
use App\CommandParser\CommandParser;
use App\Vehicle\Command\MoveForwardCommand;
use App\Vehicle\Command\RotateLeftCommand;
use App\Vehicle\Command\RotateRightCommand;
use PHPUnit\Framework\TestCase;

class CommandParserTest extends TestCase
{
    /**
     * @throws InvalidCommandException
     */
    public function testShouldBreakWhenInvalidCommandCharNameIsProvided()
    {
        $this->expectException(InvalidCommandException::class);

        $stringCommand = 'LRMX';

        CommandParser::fromString($stringCommand);
    }

    /**
     * @throws InvalidCommandException
     */
    public function testShouldReturnArrayOfCommands()
    {
        $stringCommand = 'LRM';

        $commands = CommandParser::fromString($stringCommand);

        $this->assertTrue(is_array($commands));

        $this->assertInstanceOf(RotateLeftCommand::class, $commands[0]);

        $this->assertInstanceOf(RotateRightCommand::class, $commands[1]);

        $this->assertInstanceOf(MoveForwardCommand::class, $commands[2]);
    }
}
