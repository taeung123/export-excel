<?php

namespace VCComponent\Laravel\Export\Http\Controllers\Api\Admin;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use VCComponent\Laravel\Export\Contracts\Exportable;
use VCComponent\Laravel\Vicoders\Core\Controllers\ApiController;
use VCComponent\Laravel\Export\Services\Export\Export;
use VCComponent\Laravel\Export\Traits\ExportTrait;
use VCComponent\Laravel\Export\Validators\ExportValidator;
use VCComponent\Laravel\Export\Repositories\ExportsQueryRepository;
class ExportController extends ApiController implements Exportable
{
    use ExportTrait;

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
    public function export($slug, $id, Request $request)
    {
        if($id == null){
            throw new Exception("id không hợp lệ");
        }
        $label = $request->label ? $request->label: "export";
        $data = $this->repository->findBySlug($slug);
        $trans = [":id" => "'" . $id . "'"];
        $tring_query = strtr($data->query, $trans);
        //$tring_query = "SELECT * FROM `contact_form_values` where `contact_form_id`='2'";
        $data_export  = $this->getDataExport($tring_query);
        if($data_export == null){
            throw new Exception("Dữ liệu không tồn tại");
        }
        $args            = [
            'data'      => $data_export,
            'label'     => $label,
            'extension' => "xlsx",
        ];
        $export = new Export($args);
        $url    = $export->export();
        return $this->response->array(['url' => $url]);
    }
}
