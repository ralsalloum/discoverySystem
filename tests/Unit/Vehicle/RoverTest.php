<?php

namespace App\Tests\Unit\Vehicle;

use App\Exception\InvalidCommandException;
use App\Exception\InvalidSurfaceFinalCoordinateException;
use App\CommandParser\CommandParser;
use App\Universe\{ Coordinate, Location};
use App\Universe\Direction\{ East, North, West};
use App\Universe\Surface\TargetArea;
use App\Vehicle\Rover;
use Exception;
use PHPUnit\Framework\TestCase;

class RoverTest extends TestCase
{
    public Rover $rover;

    public Location $location;

    /**
     * @throws InvalidSurfaceFinalCoordinateException
     * @throws InvalidCommandException
     */
    public function setUp(): void
    {
        $surface = new TargetArea(new Coordinate(5, 5));

        $coordinate = new Coordinate(1, 3);

        $this->location = new Location($coordinate, new North());

        $this->rover = new Rover($surface, $this->location, CommandParser::fromString('LMR'));
    }

    public function testShouldBeCapableOfGetTheCurrentLocation()
    {
        $actual = $this->rover->getCurrentLocation();

        $this->assertEquals($this->location, $actual);
    }

    public function testShouldRotateToLeft()
    {
        $this->rover->rotateToLeft();

        $expected = new Location(new Coordinate(1, 3), new West());

        $actual = $this->rover->getCurrentLocation();

        $this->assertEquals($expected, $actual);
    }

    public function testShouldRotateToRight()
    {
        $this->rover->rotateToRight();

        $expected = new Location(new Coordinate(1, 3), new East());

        $actual = $this->rover->getCurrentLocation();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
    public function testShouldBreakWhenMoveToAInvalidCoordinate()
    {
        $this->expectException(Exception::class);

        $this->rover->rotateToLeft()->move()->move();
    }

    public function testShouldMoveToNextCoordinate()
    {
        $expected = new Location(new Coordinate(0, 3), new West());

        $this->rover->rotateToLeft()->move();

        $actual = $this->rover->getCurrentLocation();

        $this->assertEquals($expected, $actual);
    }

    public function testShouldExecuteVehicleCommands()
    {
        $this->rover->executeCommands();

        $expected = new Location(new Coordinate(0, 3), new North());

        $actual = $this->rover->getCurrentLocation();

        $this->assertEquals($expected, $actual);
    }
}
