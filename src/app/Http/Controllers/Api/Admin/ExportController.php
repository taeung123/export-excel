<?php

namespace VCComponent\Laravel\Export\Http\Controllers\Api\Admin;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use VCComponent\Laravel\Export\Contracts\Exportable;
use VCComponent\Laravel\Vicoders\Core\Controllers\ApiController;
//use VCComponent\Laravel\Export\Services\Export\Export;
use VCComponent\Laravel\Export\Traits\ExportTrait;
use VCComponent\Laravel\Export\Validators\ExportValidator;
use VCComponent\Laravel\Export\Repositories\ExportsQueryRepository;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use VCComponent\Laravel\Export\Exports\Export;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ExportController extends ApiController
{

    protected $validator;

    public function __construct(ExportValidator $validator, ExportsQueryRepository $repository)
    {
        $this->repository  = $repository;
        $this->validator = $validator;
        if (config('exports_query.auth_middleware.admin.middleware') !== '') {
            $this->middleware(
                config('exports_query.auth_middleware.admin.middleware'),
                ['except' => config('exports_query.auth_middleware.admin.except')]
            );
        }
    }
    public function export($slug, Request $request)
    {
        $export_query = $this->repository->findBySlug($slug);
        if ($export_query == null) {
            throw new Exception("Dữ liệu không tồn tại");
        }
        $data_request = $request->all();
        $trans = [];
        foreach ($data_request as $item => $val) {
            $trans[":" . $item] = $val;
        }
        $tring_query = strtr($export_query->query, $trans); //dd($tring_query);
        try {
            $data = DB::select($tring_query);
        } catch (Exception $e) {
            throw new Exception("Dữ liệu không tồn tại");
        }
        if ($data == null) {
            throw new Exception("Dữ liệu không tồn tại");
        }
        $label = "export_".$slug."_".date('Y_m_d');
        return Excel::download(new Export($data), $label.'.xlsx');
    }
}
