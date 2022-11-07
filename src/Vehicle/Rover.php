<?php

namespace App\Vehicle;

use App\Exception\InvalidPositionException;
use App\Interface\Command;
use App\Interface\Surface;
use App\Interface\Vehicle;
use App\Universe\Location;

class Rover implements Vehicle
{
    /**
     * @param Surface $surface
     * @param Location $location
     * @param Command[] $commands
     */
    public function __construct(private Surface $surface, private Location $location, private array $commands)
    {
    }

    public function getCurrentLocation(): Location
    {
        return $this->location;
    }

    public function rotateToLeft(): Vehicle
    {
        $this->location->rotateToLeft();

        return $this;
    }

    public function rotateToRight(): Vehicle
    {
        $this->location->rotateToRight();

        return $this;
    }

    /**
     * @throws InvalidPositionException
     */
    public function move(): Vehicle
    {
        $nextCoordinate = $this->location->getNextCoordinate();

        if (!$this->surface->checkIfLocationIsValid($nextCoordinate)) {
            throw new InvalidPositionException();
        }

        $this->location->updateCoordinate($nextCoordinate);

        return $this;
    }

    public function executeCommands(): Vehicle
    {
        foreach ($this->commands as $command) {
            $command->execute($this);
        }

        return $this;
    }
}
