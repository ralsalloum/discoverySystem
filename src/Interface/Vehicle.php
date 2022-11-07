<?php

namespace App\Interface;

use App\Universe\Location;

interface Vehicle
{
    // get current location of the vehicle
    public function getCurrentLocation(): Location;

    //Rotates the vehicle 90 degrees to the left
    public function rotateToLeft(): self;

    //Rotates the vehicle 90 degrees to the right
    public function rotateToRight(): self;

    // forward the vehicle one grid to the direction which it is facing
    public function move(): self;

    // run the defined commands on the vehicle
    public function executeCommands(): self;
}
