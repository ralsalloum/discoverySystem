<?php

namespace App\Tests\Unit\CommandParser;

use App\Exception\InvalidDirectionException;
use App\CommandParser\DirectionParser;
use App\Universe\Direction\North;
use PHPUnit\Framework\TestCase;

class DestinationTest extends TestCase
{
    /**
     *
     * @throws InvalidDirectionException
     */
    public function testShouldBreakWhenInvalidDirectionCharNameIsProvided()
    {
        $this->expectException(InvalidDirectionException::class);

        DirectionParser::fromString('X');
    }

    /**
     * @throws InvalidDirectionException
     */
    public function testShouldReturnNorthWhenNCharIsProvided()
    {
        $expected = North::class;

        $actual = DirectionParser::fromString('N');

        $this->assertInstanceOf($expected, $actual);
    }
}
