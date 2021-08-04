<?php

namespace HanhBT\HelloWorld\Model;

use HanhBT\HelloWorld\API\Color;

class Green implements Color
{
    public function getColor()
    {
        return 'Green';
    }
}
