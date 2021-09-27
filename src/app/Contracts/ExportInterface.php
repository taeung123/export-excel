<?php

namespace VCComponent\Laravel\Export\Contracts;

use Illuminate\Http\Request;
use Vicoders\Export\Validators\ExportValidator;

interface ExportInterface
{
    public function export($slug, $id, Request $request);
}
