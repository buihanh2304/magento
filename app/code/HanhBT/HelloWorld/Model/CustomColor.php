<?php

namespace HanhBT\HelloWorld\Model;

use HanhBT\HelloWorld\API\Color;

class CustomColor implements Color
{
    private $color;

    public function __construct(
        string $color
    ) {
        $this->color = $color;
    }

    public function getColor()
    {
        return $this->color;
    }
}
