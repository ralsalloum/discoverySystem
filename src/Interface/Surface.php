<?php

namespace App\Interface;

use App\Universe\Coordinate;

interface Surface
{
    /**
     * Get the coordinate on axis x
     * @return int
     */
    public function getXCoordinate(): int;

    /**
     * Get the coordinate on axis y
     * @return int
     */
    public function getYCoordinate(): int;

    /**
     * @param Coordinate $coordinate
     * @return bool
     */
    public function checkIfLocationIsValid(Coordinate $coordinate): bool;
}
