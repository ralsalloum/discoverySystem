<?php

namespace App\Tests\Unit\Universe\Surface;

use App\Exception\InvalidSurfaceFinalCoordinateException;
use App\Universe\Coordinate;
use App\Universe\Surface\TargetArea;
use PHPUnit\Framework\TestCase;

class TargetAreaTest extends TestCase
{
    public int $x;

    public int $y;

    public TargetArea $object;

    public Coordinate $coordinate;

    /**
     * @throws InvalidSurfaceFinalCoordinateException
     */
    public function setUp(): void
    {
        $this->x = 1;
        $this->y = 1;

        $this->coordinate = new Coordinate($this->x, $this->y);
        $this->object = new TargetArea($this->coordinate);
    }

    public function testShouldBreakWhenXIsLowerThenOne()
    {
        $this->expectException(InvalidSurfaceFinalCoordinateException::class);

        $coordinate = new Coordinate(0, 1);

        $object = new TargetArea($coordinate);
    }

    public function testShouldBreakWhenYIsLowerThenOne()
    {
        $this->expectException(InvalidSurfaceFinalCoordinateException::class);

        $coordinate = new Coordinate(1, 0);

        $object = new TargetArea($coordinate);
    }

    public function testShouldReturnTheXCoordinate()
    {
        $this->assertEquals($this->x, $this->object->getXCoordinate());
    }

    public function testShouldReturnTheYCoordinate()
    {
        $this->assertEquals($this->x, $this->object->getYCoordinate());
    }

    public function testShouldValidateCoordinatesOnSurfaceSquare()
    {
        $expectedFalse = new Coordinate(2, 2);
        $expectedTrue = new Coordinate(1, 1);

        $this->assertTrue($this->object->checkIfLocationIsValid($expectedTrue));

        $this->assertFalse($this->object->checkIfLocationIsValid($expectedFalse));
    }
}
