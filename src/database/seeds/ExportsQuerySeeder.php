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
            ["slug" => "contact","query" => "SELECT JSON_VALUE(payload_slug, '$.ho_ten') as 'Họ tên', JSON_VALUE(payload_slug, '$.so_dien_thoai') as 'Số điện thoại', JSON_VALUE(payload_slug, '$.email') as 'Email', JSON_VALUE(payload_slug, '$.dia_chi') as 'Địa chỉ', JSON_VALUE(payload_slug, '$.noi_dung') as 'Nội dung', JSON_VALUE(payload_slug, '$.vi-tri-ung-tuyen') as 'Vị tri ứng tuyển' from contact_form_values where `contact_form_id`=:id"],
        ]);
    }
}
