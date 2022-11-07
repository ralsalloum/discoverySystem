<?php

namespace App\Interface;

interface VehicleManager
{
    /**
     * Get all registered vehicles
     * @return Vehicle[]
     */
    public function getVehicles(): array;

    // Add a new vehicle to the Manager
    public function addVehicle(Vehicle $vehicle): self;

    /**
     * Deploy all the vehicles in order (FIFO)
     *
     * @return VehicleManager
     */
    public function runInstructions(): self;

    // Get the locations from all vehicles registered
    public function getVehiclesLocations(): array;

    // Return the surface that vehicle manager is working on
    public function getSurface(): Surface;
}
