<?php

namespace HanhBT\HelloWorld\Model;

use HanhBT\HelloWorld\API\Color;
use HanhBT\HelloWorld\API\Size;

class Shorts
{
    private $color;
    private $size;

    public function __construct(
        Color $color,
        Size $size
    ) {
        $this->color = $color;
        $this->size = $size;
    }

    public function getType()
    {
        $color = $this->color->getColor();
        $size = $this->size->getSize();

        return "This shorts has {$size} size and {$color} color";
    }
}
