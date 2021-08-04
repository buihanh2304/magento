<?php

namespace HanhBT\HelloWorld\Model;

use HanhBT\HelloWorld\API\Size;

class M implements Size
{
    public function getSize()
    {
        return 'M';
    }
}
