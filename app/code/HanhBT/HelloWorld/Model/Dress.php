<?php

namespace HanhBT\HelloWorld\Model;

use HanhBT\HelloWorld\API\DressInterface;
use HanhBT\HelloWorld\API\Color;
use HanhBT\HelloWorld\API\Size;

class Dress implements DressInterface
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

    public function getDressType()
    {
        $color = $this->color->getColor();
        $size = $this->size->getSize();

        return "This dress has {$size} size and {$color} color";
    }
}
