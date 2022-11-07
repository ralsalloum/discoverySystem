<?php

namespace App\Tests\Unit;

use App\Exception\InvalidCommandException;
use App\Exception\InvalidSurfaceFinalCoordinateException;
use App\Interface\Surface;
use App\CommandParser\CommandParser;
use App\Universe\Coordinate;
use App\Universe\Location;
use App\Universe\Direction\North;
use App\Universe\Surface\TargetArea;
use App\RoverManager;
use App\Vehicle\Rover;
use PHPUnit\Framework\TestCase;

class RoverManagerTest extends TestCase
{
    public RoverManager $roverManager;

    public Surface $surface;

    /**
     * @throws InvalidSurfaceFinalCoordinateException
     */
    public function setUp(): void
    {
        $this->surface = new TargetArea(new Coordinate(5, 5));

        $this->roverManager = new RoverManager($this->surface);
    }

    public function testShouldReturnTheSurface()
    {
        $this->assertEquals($this->surface, $this->roverManager->getSurface());
    }

    public function testShouldReturnTheAddedVehicles()
    {
        $this->assertEquals([], $this->roverManager->getVehicles());
    }

    /**
     * @throws InvalidCommandException
     */
    public function testShouldBeCapableToAddVehicles()
    {
        $rover = new Rover(
            $this->surface,
            new Location(
                new Coordinate(1, 2),
                new North()
            ),
            CommandParser::fromString('LM')
        );

        $this->roverManager->addVehicle($rover);

        $this->assertCount(1, $this->roverManager->getVehicles());
    }

    public function testShouldExecuteCommandsOfAVehicle()
    {
        $roverMock = $this->getMockBuilder(Rover::class)->disableOriginalConstructor()->getMock();

        $roverMock->expects($this->once())->method('executeCommands');

        $this->roverManager->addVehicle($roverMock);

        $this->roverManager->runInstructions();
    }

    public function testShouldGetPositionsOfVehicles()
    {
        $roverMock = $this->getMockBuilder(Rover::class)->disableOriginalConstructor()->getMock();

        $this->roverManager->addVehicle($roverMock);
        $this->roverManager->runInstructions();

        $locations = $this->roverManager->getVehiclesLocations();

        $this->assertCount(1, $locations);
    }
}
