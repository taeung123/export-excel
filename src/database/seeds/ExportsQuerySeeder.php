<?php
use Illuminate\Database\Seeder;
use VCComponent\Laravel\Export\Entities\ExportsQuery;
class ExportsQuerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExportsQuery::insert([
            ["slug" => "contact","query" => "SELECT JSON_VALUE(payload_slug, '$.ho_ten') AS 'Họ tên',JSON_VALUE(payload_slug, '$.so_dien_thoai') AS 'Số điện thoại',JSON_VALUE(payload_slug, '$.email') AS 'Email',JSON_VALUE(payload_slug, '$.dia_chi') AS 'Địa chỉ',JSON_VALUE(payload_slug, '$.noi_dung') AS 'Nội dung',JSON_VALUE(payload_slug, '$.vi_tri_ung_tuyen') AS 'Vị tri ứng tuyển' FROM contact_form_values WHERE `contact_form_id`=:id AND DATE(created_at) :from_date_condition ':from_date' AND DATE(created_at) :to_date_condition ':to_date' AND status :status_condition ':status' AND JSON_VALUE(payload_slug, '$.vi_tri_ung_tuyen') :position_condition ':position' AND (JSON_VALUE(payload_slug, '$.ho_ten') like '%:search%' OR JSON_VALUE(payload_slug, '$.email') like '%:search%')"],
        ]);
    }
}
