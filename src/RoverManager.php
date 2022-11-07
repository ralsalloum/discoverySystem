<?php

namespace App;

use App\Interface\Surface;
use App\Interface\Vehicle;
use App\Interface\VehicleManager;

class RoverManager implements VehicleManager
{
    /**
     * @var Vehicle[]
     */
    private array $vehicles = [];

    public function __construct(private Surface $surface)
    {
    }

    // return the surface that the rover will work on
    public function getSurface(): Surface
    {
        return $this->surface;
    }

    /**
     * @return Vehicle[]
     */
    public function getVehicles(): array
    {
        return $this->vehicles;
    }

    /**
     * Add a rover to the manager
     *
     * @param Vehicle $vehicle
     * @return VehicleManager
     */
    public function addVehicle(Vehicle $vehicle): VehicleManager
    {
        $this->vehicles[] = $vehicle;

        return $this;
    }

    public function runInstructions(): VehicleManager
    {
        for ($i=0; $i<count($this->vehicles); $i++) {
            $this->vehicles[$i]->executeCommands();
        }

        return $this;
    }

    // return the locations of all rovers
    public function getVehiclesLocations(): array
    {
        $locations = [];

        foreach ($this->vehicles as $vehicle) {
            $locations[] = $vehicle->getCurrentLocation();
        }

        return $locations;
    }
}
