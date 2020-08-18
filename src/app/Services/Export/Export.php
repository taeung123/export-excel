<?php

namespace VCComponent\Laravel\Export\Services\Export;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Export
{
    protected $data;
    protected $label;
    protected $extension;

    public function __construct($argument)
    {

        $this->data      = $argument['data'];
        $this->label     = Str::snake($argument['label']);
        $this->extension = strtolower($argument['extension']);
    }

    public function export($is_relative_path = false)
    {
        $file_name      = $this->label;
        $file_extension = $this->extension;
        $data           = $this->data;
        $relative_path  = '/exports/' . time() . '_' . $file_name . '.' . $file_extension;
        $file_path      = config('filesystems.disks.local.root') . $relative_path;

        Storage::disk('local')->put($relative_path, '');

        if (count($data)) {
            $keys = array_keys($data[0]);
        } else {
            $keys = [];
        }

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->fromArray($keys, null, 'A1');
        $spreadsheet->getActiveSheet()->fromArray($data, null, 'A2');
        switch ($file_extension) {
            case 'xlsx':
                $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
                break;
            case 'csv':
                $writer = IOFactory::createWriter($spreadsheet, 'Csv');
                $writer->setUseBOM(true);
                break;
        }
        $writer->save($file_path);

        return $is_relative_path === true ? $relative_path : url($relative_path);
    }
}
