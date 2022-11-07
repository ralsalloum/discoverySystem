<?php

namespace App\Tests\Unit\Universe;

use App\Interface\Direction;
use App\Universe\Coordinate;
use App\Universe\Location;
use App\Universe\Direction\East;
use App\Universe\Direction\North;
use App\Universe\Direction\West;
use PHPUnit\Framework\TestCase;

class LocationTest extends TestCase
{
    public Coordinate $coordinate;

    public Direction $direction;

    public Location $location;

    public function setUp(): void
    {
        $this->coordinate = new Coordinate(1, 2);

        $this->direction = new North();

        $this->location = new Location($this->coordinate, $this->direction);
    }

    public function testShouldReturnCurrentCoordinate()
    {
        $this->assertEquals($this->coordinate, $this->location->getCurrentCoordinates());
    }

    public function testShouldReturnCurrentDirection()
    {
        $this->assertEquals($this->direction, $this->location->getCurrentDirection());
    }

    public function testShouldHaveStringFormat()
    {
        $expected = '1 2 N';

        $actual = (string) $this->location;

        $this->assertEquals($expected, $actual);
    }

    public function testShouldSeeWestWhenRotateLeftFromNorth()
    {
        $this->location->rotateToLeft();

        $this->assertInstanceOf(West::class, $this->location->getCurrentDirection());
    }

    public function testShouldSeeEastWhenRotateRightFromNorth()
    {
        $this->location->rotateToRight();

        $this->assertInstanceOf(East::class, $this->location->getCurrentDirection());
    }

    public function testShouldUpdateCoordinate()
    {
        $coordinate = new Coordinate(1, 5);

        $this->location->updateCoordinate($coordinate);

        $this->assertEquals($coordinate, $this->location->getCurrentCoordinates());
    }

    public function testShouldGetNextCoordinateWhenFacingNorth()
    {
        $coordinate = $this->location->getNextCoordinate();

        $this->assertEquals(new Coordinate(1, 3), $coordinate);
    }

    public function testShouldGetNextCoordinateWhenFacingSouth()
    {
        // Turn to South
        $this->location->rotateToLeft()->rotateToLeft();

        $coordinate = $this->location->getNextCoordinate();

        $this->assertEquals(new Coordinate(1, 1), $coordinate);
    }

    public function testShouldGetNextCoordinateWhenFacingEast()
    {
        // Turn to East
        $this->location->rotateToRight();

        $coordinate = $this->location->getNextCoordinate();

        $this->assertEquals(new Coordinate(2, 2), $coordinate);
    }

    public function testShouldGetNextCoordinateWhenFacingWest()
    {
        // Turn to West
        $this->location->rotateToLeft();

        $coordinate = $this->location->getNextCoordinate();

        $this->assertEquals(new Coordinate(0, 2), $coordinate);
    }
}
