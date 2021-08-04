<?php

namespace HanhBT\HelloWorld\Model;

use HanhBT\HelloWorld\API\Size;

class S implements Size
{
    public function getSize()
    {
        return 'S';
    }
}
