<?php

namespace App\Tests\Unit\Universe\Destination;

use App\Universe\Direction\East;
use App\Universe\Direction\North;
use App\Universe\Direction\West;
use PHPUnit\Framework\TestCase;

class NorthTest extends TestCase
{
    public $north;

    public function setUp(): void
    {
        $this->north = new North();
    }

    public function testShouldSeeWestWhenRotateLeft()
    {
        $actual = $this->north->rotateToLeft();

        $this->assertInstanceOf(West::class, $actual);
    }

    public function testShouldSeeEastWhenRotateRight()
    {
        $actual = $this->north->rotateToRight();

        $this->assertInstanceOf(East::class, $actual);
    }

    public function testShouldReturnTheAbbreviationOfClassName()
    {
        $expected = 'N';

        $this->assertEquals($expected, $this->north->getCharName());
    }
}
