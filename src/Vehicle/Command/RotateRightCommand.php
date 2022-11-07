<?php

namespace App\Vehicle\Command;

use App\Interface\Command;
use App\Interface\Vehicle;

class RotateRightCommand implements Command
{
    public function execute(Vehicle $vehicle): void
    {
        $vehicle->rotateToRight();
    }
}
