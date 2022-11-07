<?php

namespace App\Tests\Unit\Vehicle\Command;

use App\Exception\InvalidCommandException;
use App\Exception\InvalidSurfaceFinalCoordinateException;
use App\CommandParser\CommandParser;
use App\Universe\{ Coordinate, Location };
use App\Universe\Direction\North;
use App\Universe\Surface\TargetArea;
use App\Vehicle\Command\MoveForwardCommand;
use App\Vehicle\Rover;
use PHPUnit\Framework\TestCase;

class MoveForwardCommandTest extends TestCase
{
    private Rover $rover;

    /**
     * @throws InvalidCommandException
     * @throws InvalidSurfaceFinalCoordinateException
     */
    public function setUp(): void
    {
        $surface = new TargetArea(new Coordinate(5, 5));

        $this->rover = new Rover(
            $surface,
            new Location(
                new Coordinate(1 , 2),
                new North()
            ),
            CommandParser::fromString('M')
        );
    }

    public function testShouldMoveRover()
    {
        $command = new MoveForwardCommand();
        $command->execute($this->rover);

        $expected = new Location(new Coordinate(1, 3), new North());

        $this->assertEquals($expected, $this->rover->getCurrentLocation());
    }
}
