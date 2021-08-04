<?php

namespace HanhBT\HelloWorld\Model;

use HanhBT\HelloWorld\API\Color;
use HanhBT\HelloWorld\API\Size;

class Short
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
}
