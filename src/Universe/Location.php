<?php

namespace App\Universe;

use App\Interface\Direction;
use App\Universe\Direction\East;
use App\Universe\Direction\North;
use App\Universe\Direction\South;
use App\Universe\Direction\West;

class Location
{
//    const ROTATE_LEFT = 1;
//    const ROTATE_RIGHT = 2;

    /**
     * Location constructor.
     * $coordinate represents the current coordinates of the location on X and Y axis
     * $direction represent the current direction of the location
     *
     * @param Coordinate $coordinate
     * @param Direction $direction
     */
    public function __construct(private Coordinate $coordinate, private  Direction $direction)
    {
    }

    // return current coordinates
    public function getCurrentCoordinates(): Coordinate
    {
        return $this->coordinate;
    }

    // return current direction
    public function getCurrentDirection(): Direction
    {
        return $this->direction;
    }

    /**
     * Rotate to left
     * Change the orientation for the new one in accord of what is defined inside of the orientation itself
     *
     * @return self
     */
    public function rotateToLeft(): self
    {
        $this->direction = $this->direction->rotateToLeft();

        return $this;
    }

    /**
     * Rotate to right
     * Change the orientation for the new one in accord of what is defined inside of the orientation itself
     *
     * @return self
     */
    public function rotateToRight(): self
    {
        $this->direction = $this->direction->rotateToRight();

        return $this;
    }

    /**
     * Get the next coordinate looking for the current orientation
     *
     * @return Coordinate
     */
    public function getNextCoordinate(): Coordinate
    {
        $x = $this->coordinate->getX();
        $y = $this->coordinate->getY();

        switch ($this->direction->getCharName()) {
            case North::getCharName():
                $y += 1;
                break;
            case East::getCharName():
                $x += 1;
                break;
            case South::getCharName():
                $y -= 1;
                break;
            case West::getCharName():
                $x -= 1;
                break;
        }

        return new Coordinate($x, $y);
    }

    /**
     * @param Coordinate $coordinate
     */
    public function updateCoordinate(Coordinate $coordinate): void
    {
        $this->coordinate = $coordinate;
    }

    /**
     * Used when someone try to print this class
     * @return string
     */
    public function __toString(): string
    {
        return "{$this->coordinate->getX()} {$this->coordinate->getY()} {$this->direction->getCharName()}";
    }
}
