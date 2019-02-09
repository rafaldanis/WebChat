<?php
namespace ChatApp\PreparationMessage;

use ChatApp\PreparationMessage\Filter;

class Preparation
{
    public function start(string $msg):string
    {
        $filter = new Filter($msg);

        return $filter->getMsg();
    }
}