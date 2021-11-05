<?php

namespace VCComponent\Laravel\Export\Entities;

class ExportExcel
{
    public $url;
    public function __construct($url)
    {
        $this->url = $url;
    }
}
