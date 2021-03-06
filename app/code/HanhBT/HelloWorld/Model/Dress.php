<?php

namespace HanhBT\HelloWorld\Model;

use HanhBT\HelloWorld\API\DressInterface;
use HanhBT\HelloWorld\API\Color;
use HanhBT\HelloWorld\API\Size;

class Dress implements DressInterface
{
    private $color;
    private $size;
    protected $name = 'dress';

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

        return "This {$this->name} has {$size} size and {$color} color";
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}
