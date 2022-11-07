<?php

namespace App\Tests\Unit\Universe\Destination;

use App\Universe\Direction\East;
use App\Universe\Direction\South;
use App\Universe\Direction\West;
use PHPUnit\Framework\TestCase;

class SouthTest extends TestCase
{
    public South $south;

    public function setUp(): void
    {
        $this->south = new South();
    }

    public function testShouldSeeEastWhenRotateLeft()
    {
        $actual = $this->south->rotateToLeft();

        $this->assertInstanceOf(East::class, $actual);
    }

    public function testShouldSeeWestWhenRotateRight()
    {
        $actual = $this->south->rotateToRight();

        $this->assertInstanceOf(West::class, $actual);
    }

    public function testShouldReturnTheAbbreviationOfClassName()
    {
        $expected = 'S';

        $this->assertEquals($expected, $this->south->getCharName());
    }
}
