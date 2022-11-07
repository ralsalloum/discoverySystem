<?php

namespace App\Interface;

interface Command
{
    // Run a command on the vehicle
    public function execute(Vehicle $vehicle): void;
}
