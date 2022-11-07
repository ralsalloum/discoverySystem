<?php

namespace App\Tests\Unit\Universe\Destination;

use App\Universe\Direction\North;
use App\Universe\Direction\South;
use App\Universe\Direction\West;
use PHPUnit\Framework\TestCase;

class WestTest extends TestCase
{
    public West $west;

    public function setUp(): void
    {
        $this->west = new West();
    }

    public function testShouldSeeSouthWhenRotateLeft()
    {
        $actual = $this->west->rotateToLeft();

        $this->assertInstanceOf(South::class, $actual);
    }

    public function testShouldSeeNorthWhenRotateRight()
    {
        $actual = $this->west->rotateToRight();

        $this->assertInstanceOf(North::class, $actual);
    }

    public function testShouldReturnTheAbbreviationOfClassName()
    {
        $expected = 'W';

        $this->assertEquals($expected, $this->west->getCharName());
    }
}
