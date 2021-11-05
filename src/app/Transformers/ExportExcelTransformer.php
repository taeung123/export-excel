<?php

namespace VCComponent\Laravel\Export\Transformers;

use League\Fractal\TransformerAbstract;

class ExportExcelTransformer extends TransformerAbstract
{
    public function __construct(){}

    public function transform($model)
    {
        return [
            "url" => $model->url
        ];
    }
}
