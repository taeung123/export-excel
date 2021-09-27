<?php

namespace VCComponent\Laravel\Export\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class Export implements FromCollection, WithHeadings
{

    public function __construct($data)
    {
        $this->data = $data;
    }
    public function collection()
    {

        return collect($this->data);
    }
    public function headings(): array
    {
        return array_keys((array)($this->collection()->first()));
    }
}
