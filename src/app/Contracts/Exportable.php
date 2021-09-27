<?php
namespace VCComponent\Laravel\Export\Contracts;

interface Exportable
{
    public function getDataExport($export);
}
