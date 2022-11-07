<?php

namespace App\Interface;

interface Direction
{
    // Get the character that represent the direction
    public static function getCharName(): string;

    public function rotateToLeft(): self;

    public function rotateToRight(): self;
}
