<?php

namespace Ehub\Views;

class ViewHandler
{
    public function __construct($file)
    {
        echo file_get_contents(__DIR__."/../../../public/{$file}");
    }
}