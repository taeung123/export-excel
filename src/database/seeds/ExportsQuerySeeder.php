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
            ["slug" => "contact","query" => "SELECT `payload` FROM `contact_form_values` where `contact_form_id`=:id"],
        ]);
    }
}
