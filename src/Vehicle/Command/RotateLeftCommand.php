<?php

namespace App\Vehicle\Command;

use App\Interface\Command;
use App\Interface\Vehicle;

class RotateLeftCommand implements Command
{
    public function execute(Vehicle $vehicle): void
    {
        $vehicle->rotateToLeft();
    }
}
