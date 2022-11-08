<?php

namespace App\Service;

use App\CommandParser\CommandParser;
use App\CommandParser\DirectionParser;
use App\Exception\InvalidCommandException;
use App\Exception\InvalidDirectionException;
use App\Exception\InvalidSurfaceFinalCoordinateException;
use App\Interface\Surface;
use App\Interface\VehicleManager;
use App\RoverManager;
use App\Universe\Coordinate;
use App\Universe\Location;
use App\Universe\Surface\TargetArea;
use App\Vehicle\Rover;

class ManageRoverService
{
    private Surface $surface;
    private VehicleManager $manager;
    private Coordinate $surfaceCoordinates;

    /**
     * @throws InvalidSurfaceFinalCoordinateException
     * @throws InvalidDirectionException|InvalidCommandException
     */
    public function manageRoversByAdmin(array $instructionsArray): array
    {
        $this->initializeTargetArea($instructionsArray['upperRightCoordinates']);

        $this->registerRovers($instructionsArray['rovers']);

        // Execute the commands of each registered rover
        $this->runRoversInstructions();

        return $this->getUpToDateRoversCoordinates();
    }

    /**
     * @throws InvalidSurfaceFinalCoordinateException
     */
    public function initializeTargetArea(string $upperRightCoordinates)
    {
        $upperRightCoordinates = str_split($upperRightCoordinates, 1);

        $this->surfaceCoordinates = new Coordinate($upperRightCoordinates[0], $upperRightCoordinates[2]);

        $this->surface = new TargetArea($this->surfaceCoordinates);

        $this->manager = new RoverManager($this->surface);
    }

    /**
     * @throws InvalidDirectionException
     * @throws InvalidCommandException
     */
    public function registerRovers(array $rovers): void
    {
        // save rovers information
        foreach ($rovers as $rover) {
            $location = new Location(new Coordinate($rover['location']['x'], $rover['location']['y']),
                DirectionParser::fromString($rover['location']['d']));

            $commandsArray = CommandParser::fromString($rover['movingInstructions']);

            $newRover = new Rover($this->surface, $location, $commandsArray);

            $this->manager->addVehicle($newRover);

        }
    }

    public function getUpToDateRoversCoordinates(): array|string
    {
        if (count($this->manager->getVehicles()) > 0)
        {
            $response = [];

            // Retrieve the new geo-coordinates of each rover
            $locations = $this->manager->getVehiclesLocations();

            foreach ($locations as $location) {
                $response[] = $location->__toString();
            }

            return $response;
        }

        return "No rovers are exists!";
    }

    public function runRoversInstructions(): void
    {
        $this->manager->runInstructions();
    }
}
