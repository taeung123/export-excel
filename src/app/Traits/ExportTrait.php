<?php
namespace VCComponent\Laravel\Export\Traits;

use Illuminate\Support\Facades\DB;

trait ExportTrait
{
    public function getDataExport($export)
    {
    	$exports = DB::select($export);
        $export_payload = collect($exports)->map(function ($item) {
            return json_decode($item->payload);
        })->toArray();
        return json_decode(json_encode($export_payload), true);
    }
}
