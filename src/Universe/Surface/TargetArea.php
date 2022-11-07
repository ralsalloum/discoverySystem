<?php

namespace App\Universe\Surface;

use App\Exception\InvalidSurfaceFinalCoordinateException;
use App\Interface\Surface;
use App\Universe\Coordinate;

class TargetArea implements Surface
{
    private Coordinate $bottomLeftCoordinates;

    /**
     * @throws InvalidSurfaceFinalCoordinateException
     */
    public function __construct(private Coordinate $upperRightCoordinates)
    {
        // The surface needs to be at least 1x1
        if ($upperRightCoordinates->getX() < 1 || $upperRightCoordinates->getY() < 1) {
            throw new InvalidSurfaceFinalCoordinateException;
        }

        $this->bottomLeftCoordinates = new Coordinate(0, 0);
    }

    public function getXCoordinate(): int
    {
        return $this->upperRightCoordinates->getX();
    }

    public function getYCoordinate(): int
    {
        return $this->upperRightCoordinates->getY();
    }

    // Check if the coordinate is valid inside the surface square limits
    public function checkIfLocationIsValid(Coordinate $coordinate): bool
    {
        return ($coordinate->getX() >= 0 && $coordinate->getY() >= 0 && $coordinate->getX() <= $this->getXCoordinate()
            && $coordinate->getY() <= $this->getYCoordinate());
    }
}
