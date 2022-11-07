<?php

namespace App\Tests\Unit\Universe;

use App\Universe\Coordinate;
use PHPUnit\Framework\TestCase;

class CoordinateTest extends TestCase
{
    private int $x;
    private int $y;

    /**
     * @var Coordinate
     */
    private $object;

    public function setUp(): void
    {
        $this->x = 1;
        $this->y = 1;

        $this->object = new Coordinate($this->x, $this->y);
    }

    public function testShouldReturnXAndYPoints()
    {
        $this->assertEquals($this->x, $this->object->getX());
        $this->assertEquals($this->y, $this->object->getY());
    }
}
