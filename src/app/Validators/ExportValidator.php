<?php

namespace VCComponent\Laravel\Export\Validators;

use VCComponent\Laravel\Vicoders\Core\Validators\AbstractValidator;

class ExportValidator extends AbstractValidator
{
    protected $rules = [
        'RULE_EXPORT' => [
            'extension' => ['required', 'regex:/(^xlsx$)|(^csv$)/'],
        ],
    ];
}
