<?php

namespace App\Tests\Unit\Universe\Destination;

use App\Universe\Direction\East;
use App\Universe\Direction\North;
use App\Universe\Direction\South;
use PHPUnit\Framework\TestCase;

class EastTest extends TestCase
{
    public East $east;

    public function setUp(): void
    {
        $this->east = new East();
    }

    public function testShouldReturnNorthWhenRotateLeft()
    {
        $actual = $this->east->rotateToLeft();

        $this->assertInstanceOf(North::class, $actual);
    }

    public function testShouldReturnSouthWhenRotateRight()
    {
        $actual = $this->east->rotateToRight();

        $this->assertInstanceOf(South::class, $actual);
    }

    public function testShouldReturnTheAbbreviationOfClassName()
    {
        $expected = 'E';

        $this->assertEquals($expected, $this->east->getCharName());
    }
}
